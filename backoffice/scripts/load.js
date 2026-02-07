document.addEventListener('DOMContentLoaded', () => {
  const messageTable = document.getElementById('message-container');
  const tokenField = document.querySelector('input[name="token"]');
  const panels = document.querySelectorAll('[data-panel]');
  const tabButtons = document.querySelectorAll('[data-tab]');

  if (!messageTable || !tokenField) {
    return;
  }

  initialiseTabs(tabButtons, panels);
  initialiseReactionControls();

  document.querySelectorAll('.data-container').forEach((container) => {
    container.insertAdjacentHTML('afterbegin', loaderTemplate());
  });

  const payload = new FormData();
  payload.append('token', tokenField.value);

  fetch('./backend/allData.php', {
    method: 'POST',
    body: payload,
  })
    .then((res) => res.json())
    .then((response) => {
      if (response.status !== 'ok') {
        throw new Error(response.message || 'Unable to fetch data.');
      }

      sessionStorage.setItem('data', JSON.stringify(response.data));
      renderMessages(response.data.messages || []);
      setReactions(response.data.reactions || []);
      renderUsage(response.data.usage || []);

      document.querySelectorAll('.data-container .loader').forEach((loader) => {
        loader.remove();
      });
    })
    .catch((error) => {
      console.error('Dashboard data error:', error);
      document.querySelectorAll('.data-container').forEach((container) => {
        container.innerHTML = `<div class="loader error">${escapeHtml(error.message)}</div>`;
      });
    });
});

let allReactions = [];
let currentReactionFilter = 'all';
let selectedReactionIds = new Set();
let reactionsBusy = false;

function initialiseReactionControls() {
  const selectAll = document.getElementById('reactions-select-all');
  const deleteSelected = document.getElementById('reactions-delete-selected');
  const filterSelect = document.getElementById('reactions-filter');

  if (selectAll) {
    selectAll.addEventListener('change', () => toggleSelectAll(selectAll.checked));
  }

  if (filterSelect) {
    filterSelect.value = currentReactionFilter;
    filterSelect.addEventListener('change', () => setReactionFilter(filterSelect.value));
  }

  if (deleteSelected) {
    deleteSelected.addEventListener('click', () => {
      const ids = Array.from(selectedReactionIds);
      deleteReactions(ids);
    });
  }

  updateReactionsSelectionUI();
}

function setReactions(reactions) {
  allReactions = Array.isArray(reactions) ? reactions : [];
  applyReactionFilter();
}

function setReactionFilter(value) {
  currentReactionFilter = value || 'all';
  selectedReactionIds = new Set();
  applyReactionFilter();
}

function applyReactionFilter() {
  const filtered = filterReactions(allReactions, currentReactionFilter);
  renderReactions(filtered);
}

function filterReactions(reactions, filter) {
  if (!Array.isArray(reactions) || filter === 'all') {
    return reactions;
  }

  const normalizedFilter = String(filter).toLowerCase();
  const known = ['love', 'like', 'dislike'];

  return reactions.filter((reaction) => {
    const value = String(reaction.reaction || '').toLowerCase();
    if (normalizedFilter === 'unknown') {
      return !known.includes(value);
    }
    return value === normalizedFilter;
  });
}

function renderMessages(messages) {
  const messageTable = document.getElementById('message-container');
  const detailsPanel = document.getElementById('message-details');
  const emptyState = document.getElementById('messages-empty');
  const tbody = messageTable?.querySelector('tbody');

  if (!messageTable || !tbody) {
    return;
  }

  if (!Array.isArray(messages) || messages.length === 0) {
    tbody.innerHTML = '';
    if (emptyState) {
      emptyState.hidden = false;
    }
    if (detailsPanel) {
      detailsPanel.innerHTML = `
        <h2>No messages yet</h2>
        <p>When someone sends a message from the site, it will show up here.</p>
      `;
    }
    return;
  }

  if (emptyState) {
    emptyState.hidden = true;
  }

  const rows = messages.map((message) => {
    const preview = createPreview(message.message || '');
    const date = formatDate(message.date);
    return `
      <tr class="clickable" data-message-id="${escapeHtml(message.id)}">
        <td>${escapeHtml(message.email || 'Unknown')}</td>
        <td>${escapeHtml(preview)}</td>
        <td>${escapeHtml(date)}</td>
      </tr>`;
  }).join('');

  tbody.innerHTML = rows;

  messageTable.querySelectorAll('tr[data-message-id]').forEach((row) => {
    row.addEventListener('click', () => openMsg(row.dataset.messageId));
  });
}

function createPreview(text) {
  if (!text) {
    return '';
  }
  return text.length > 60 ? `${text.substring(0, 57)}...` : text;
}

function openMsg(id) {
  const storedData = sessionStorage.getItem('data');
  if (!storedData) {
    return;
  }

  const parsed = JSON.parse(storedData);
  const messages = parsed.messages || [];
  const message = messages.find((entry) => String(entry.id) === String(id));

  if (!message) {
    return;
  }

  document.querySelectorAll('#message-container tr.selected').forEach((row) => {
    row.classList.remove('selected');
  });

  const currentRow = document.querySelector(`#message-container tr[data-message-id="${id}"]`);
  currentRow?.classList.add('selected');

  const detailsPanel = document.getElementById('message-details');
  if (!detailsPanel) {
    alert(message.message);
    return;
  }

  detailsPanel.innerHTML = `
    <h2>Message from ${escapeHtml(message.fullname || 'Unknown sender')}</h2>
    <p><strong>Email:</strong> ${escapeHtml(message.email || '—')}</p>
    <p><strong>Date:</strong> ${escapeHtml(formatDate(message.date))}</p>
    <article>${formatMultiline(message.message || '')}</article>
  `;
}

function renderReactions(reactions) {
  const table = document.getElementById('reaction-container');
  const tbody = table?.querySelector('tbody');
  const emptyState = document.getElementById('reactions-empty');

  if (!table || !tbody) {
    return;
  }

  selectedReactionIds = new Set();

  if (!Array.isArray(reactions) || reactions.length === 0) {
    tbody.innerHTML = '';
    if (emptyState) {
      emptyState.hidden = false;
    }
    renderReactionStats([]);
    updateReactionsSelectionUI();
    return;
  }

  if (emptyState) {
    emptyState.hidden = true;
  }

  const rows = reactions.map((reaction) => {
    const date = formatDate(reaction.date);
    const id = reaction.id ?? '';
    return `
      <tr>
        <td>
          <input type="checkbox" class="row-select" data-reaction-id="${escapeHtml(id)}" aria-label="Select reaction ${escapeHtml(id)}">
        </td>
        <td>${escapeHtml(id || '—')}</td>
        <td>${escapeHtml(reaction.reaction || '—')}</td>
        <td>${escapeHtml(date)}</td>
        <td>
          <button type="button" class="row-delete" data-reaction-id="${escapeHtml(id)}">Delete</button>
        </td>
      </tr>`;
  }).join('');

  tbody.innerHTML = rows;
  renderReactionStats(reactions);

  tbody.querySelectorAll('.row-select').forEach((checkbox) => {
    checkbox.addEventListener('change', () => toggleReactionSelection(checkbox));
  });

  tbody.querySelectorAll('.row-delete').forEach((button) => {
    button.addEventListener('click', () => deleteReactions([button.dataset.reactionId]));
  });

  updateReactionsSelectionUI();
  setReactionsBusy(reactionsBusy);
}

function toggleReactionSelection(checkbox) {
  const id = checkbox.dataset.reactionId;
  if (!id) {
    return;
  }

  if (checkbox.checked) {
    selectedReactionIds.add(String(id));
  } else {
    selectedReactionIds.delete(String(id));
  }

  updateReactionsSelectionUI();
}

function toggleSelectAll(checked) {
  document.querySelectorAll('#reaction-container .row-select').forEach((checkbox) => {
    checkbox.checked = checked;
    const id = checkbox.dataset.reactionId;
    if (!id) {
      return;
    }
    if (checked) {
      selectedReactionIds.add(String(id));
    } else {
      selectedReactionIds.delete(String(id));
    }
  });

  updateReactionsSelectionUI();
}

function updateReactionsSelectionUI() {
  const countEl = document.getElementById('reactions-selection-count');
  const deleteSelected = document.getElementById('reactions-delete-selected');
  const selectAll = document.getElementById('reactions-select-all');
  const totalRows = document.querySelectorAll('#reaction-container .row-select').length;
  const selectedCount = selectedReactionIds.size;

  if (countEl) {
    countEl.textContent = `${selectedCount} selected`;
  }

  if (deleteSelected) {
    deleteSelected.disabled = selectedCount === 0 || reactionsBusy;
  }

  if (selectAll) {
    if (totalRows === 0) {
      selectAll.checked = false;
      selectAll.indeterminate = false;
      selectAll.disabled = true;
    } else {
      selectAll.disabled = reactionsBusy;
      selectAll.checked = selectedCount === totalRows;
      selectAll.indeterminate = selectedCount > 0 && selectedCount < totalRows;
    }
  }
}

function deleteReactions(ids) {
  if (!Array.isArray(ids) || ids.length === 0) {
    return;
  }

  const message = ids.length === 1
    ? 'Delete this reaction? This cannot be undone.'
    : `Delete ${ids.length} reactions? This cannot be undone.`;

  if (!window.confirm(message)) {
    return;
  }

  const tokenField = document.querySelector('input[name="token"]');
  if (!tokenField) {
    return;
  }

  setReactionsBusy(true);

  const payload = new FormData();
  payload.append('token', tokenField.value);
  payload.append('ids', JSON.stringify(ids));

  fetch('./backend/deleteReactions.php', {
    method: 'POST',
    body: payload,
  })
    .then((res) => res.json())
    .then((response) => {
      if (response.status !== 'ok') {
        throw new Error(response.message || 'Unable to delete reactions.');
      }

      removeReactionsFromStore(ids);
    })
    .catch((error) => {
      console.error('Delete reactions error:', error);
      alert(error.message || 'Unable to delete reactions.');
    })
    .finally(() => {
      setReactionsBusy(false);
    });
}

function setReactionsBusy(isBusy) {
  reactionsBusy = isBusy;
  document.querySelectorAll('#reaction-container .row-select').forEach((checkbox) => {
    checkbox.disabled = isBusy;
  });
  document.querySelectorAll('#reaction-container .row-delete').forEach((button) => {
    button.disabled = isBusy;
  });
  updateReactionsSelectionUI();
}

function removeReactionsFromStore(ids) {
  const storedData = sessionStorage.getItem('data');
  if (!storedData) {
    return;
  }

  const parsed = JSON.parse(storedData);
  const toRemove = new Set(ids.map((id) => String(id)));
  const reactions = Array.isArray(parsed.reactions) ? parsed.reactions : [];

  parsed.reactions = reactions.filter((reaction) => !toRemove.has(String(reaction.id)));
  sessionStorage.setItem('data', JSON.stringify(parsed));

  setReactions(parsed.reactions);
}

function renderReactionStats(reactions) {
  const statsContainer = document.getElementById('reaction-stats');
  if (!statsContainer) {
    return;
  }

  if (!Array.isArray(reactions) || reactions.length === 0) {
    statsContainer.innerHTML = '';
    return;
  }

  const counts = {};
  reactions.forEach((reaction) => {
    const key = reaction.reaction || 'unknown';
    counts[key] = (counts[key] || 0) + 1;
  });

  const total = reactions.length;
  const sorted = Object.entries(counts).sort((a, b) => b[1] - a[1]);

  statsContainer.innerHTML = sorted.map(([label, count]) => {
    const percentage = total > 0 ? Math.round((count / total) * 100) : 0;
    return `
      <div class="stat-card">
        <div class="stat-label">${escapeHtml(label)}</div>
        <div class="stat-value">${escapeHtml(count)}</div>
        <div class="stat-sub">${escapeHtml(percentage)}% of total</div>
      </div>
    `;
  }).join('');
}

function renderUsage(usage) {
  const table = document.getElementById('usage-container');
  const emptyState = document.getElementById('usage-empty');
  const thead = table?.querySelector('thead');
  const tbody = table?.querySelector('tbody');

  if (!table || !thead || !tbody) {
    return;
  }

  if (!Array.isArray(usage) || usage.length === 0) {
    thead.innerHTML = '';
    tbody.innerHTML = '';
    if (emptyState) {
      emptyState.hidden = false;
    }
    return;
  }

  if (emptyState) {
    emptyState.hidden = true;
  }

  const columns = Object.keys(usage[0]);
  thead.innerHTML = `
    <tr>
      ${columns.map((col) => `<th>${escapeHtml(formatHeader(col))}</th>`).join('')}
    </tr>
  `;

  tbody.innerHTML = usage.map((row) => {
    const cells = columns.map((col) => {
      const value = row[col];
      return `<td>${escapeHtml(value ?? '—')}</td>`;
    }).join('');
    return `<tr>${cells}</tr>`;
  }).join('');
}

function initialiseTabs(tabButtons, panels) {
  if (!tabButtons.length || !panels.length) {
    return;
  }

  const activateTab = (tabName) => {
    tabButtons.forEach((button) => {
      const isActive = button.dataset.tab === tabName;
      button.classList.toggle('active', isActive);
      button.setAttribute('aria-selected', isActive ? 'true' : 'false');
    });

    panels.forEach((panel) => {
      const isActive = panel.dataset.panel === tabName;
      panel.classList.toggle('active', isActive);
      panel.setAttribute('aria-hidden', isActive ? 'false' : 'true');
    });
  };

  tabButtons.forEach((button) => {
    button.addEventListener('click', () => activateTab(button.dataset.tab));
    button.addEventListener('keydown', (event) => {
      if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        activateTab(button.dataset.tab);
      }
    });
  });
}

function loaderTemplate() {
  return `
  <div class="loader">
   <div class="text">Fetching data...</div>
    <div class="dots">
      <div class="dot" style="animation-delay:none;">.</div>
      <div class="dot" style="animation-delay:500ms;">.</div>
      <div class="dot" style="animation-delay:1000ms;">.</div>
    </div>
  </div>`;
}

function formatDate(value) {
  if (!value) {
    return '—';
  }
  const parsed = new Date(value);
  if (Number.isNaN(parsed.getTime())) {
    return String(value);
  }
  return parsed.toLocaleString();
}

function escapeHtml(value) {
  return String(value)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}

function formatMultiline(value) {
  return escapeHtml(value).replace(/\n/g, '<br>');
}

function formatHeader(value) {
  return String(value)
    .replace(/_/g, ' ')
    .replace(/\b\w/g, (match) => match.toUpperCase());
}
