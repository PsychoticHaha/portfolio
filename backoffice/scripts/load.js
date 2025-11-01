document.addEventListener('DOMContentLoaded', () => {
  const dataContainer = document.querySelector('.data-container');
  const messageTable = document.getElementById('message-container');
  const tokenField = document.querySelector('input[name="token"]');

  if (!dataContainer || !messageTable || !tokenField) {
    return;
  }

  dataContainer.insertAdjacentHTML('afterbegin', loaderTemplate());

  const token = tokenField.value;
  const payload = new FormData();
  payload.append('token', token);

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
      dataContainer.querySelector('.loader')?.remove();
    })
    .catch((error) => {
      console.error('Dashboard data error:', error);
      dataContainer.innerHTML = `<div class="loader error">${error.message}</div>`;
    });
})

function renderMessages(messages) {
  const messageTable = document.getElementById('message-container');
  if (!messageTable) {
    return;
  }

  const rows = messages.map((message) => {
    const preview = createPreview(message.message || '');
    const date = message.date ? new Date(message.date).toLocaleString() : '—';
    return `
      <tr data-message-id="${message.id}">
        <td>${message.email || 'Unknown'}</td>
        <td>${preview}</td>
        <td>${date}</td>
      </tr>`;
  }).join('');

  const headerRow = messageTable.querySelector('tr');
  const headerHtml = headerRow ? headerRow.outerHTML : '';
  messageTable.innerHTML = headerHtml + rows;

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
    <h2>Message from ${message.fullname || 'Unknown sender'}</h2>
    <p><strong>Email:</strong> ${message.email || '—'}</p>
    <p><strong>Date:</strong> ${message.date ? new Date(message.date).toLocaleString() : '—'}</p>
    <article>${(message.message || '').replace(/\n/g, '<br>')}</article>
  `;
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
