export function setupReactions({ reactionEndpoint, messages, popup, feedbackControls }) {
  const reactionButtons = document.querySelectorAll('.reactions .icon');
  if (!reactionButtons.length) {
    return;
  }

  const showPopup = popup?.show ?? (() => {});
  const openFeedback = feedbackControls?.open ?? (() => {});

  const reactionCounters = Array.from(document.querySelectorAll('[data-reaction-count]')).reduce((acc, element) => {
    const reactionType = element.getAttribute('data-reaction-count');
    if (reactionType) {
      acc[reactionType] = element;
    }
    return acc;
  }, {});

  const setActiveReaction = (type) => {
    reactionButtons.forEach((button) => {
      button.classList.toggle('clicked', button.dataset.reaction === type);
    });
  };

  const storedReaction = localStorage.getItem('reaction');
  if (storedReaction) {
    setActiveReaction(storedReaction);
  }

  const renderStats = (stats) => {
    if (!stats) {
      return;
    }

    const total = typeof stats.total === 'number' ? stats.total : 0;

    ['love', 'like', 'dislike'].forEach((type) => {
      const counter = reactionCounters[type];
      if (!counter) return;

      const values = stats[type];
      if (total === 0) {
        counter.textContent = '--%';
        return;
      }

      if (values && typeof values.percentage === 'number') {
        counter.textContent = `${values.percentage}%`;
      } else {
        counter.textContent = '0%';
      }
    });
  };

  const fetchStats = async () => {
    try {
      const response = await fetch(`${reactionEndpoint}?stats=1`);
      if (!response.ok) {
        throw new Error(`HTTP ${response.status}`);
      }
      const payload = await response.json();
      renderStats(payload.stats || payload);
    } catch (error) {
      console.error('Failed to load reaction stats:', error);
    }
  };

  reactionButtons.forEach((button) => {
    button.addEventListener('click', async () => {
      const reactionType = button.dataset.reaction;
      if (!reactionType) {
        return;
      }

      if (reactionType === localStorage.getItem('reaction')) {
        return;
      }

      if (reactionType === 'dislike') {
        openFeedback();
      }

      button.classList.add('animate');
      setTimeout(() => button.classList.remove('animate'), 500);

      try {
        const formData = new FormData();
        formData.append('reaction', reactionType);
        formData.append('date', new Date().toISOString());

        const response = await fetch(reactionEndpoint, {
          method: 'POST',
          body: formData
        });

        if (!response.ok) {
          throw new Error(`HTTP ${response.status}`);
        }

        const payload = await response.json();
        const stats = payload.stats || payload;

        setActiveReaction(reactionType);
        localStorage.setItem('reaction', reactionType);
        renderStats(stats);
      } catch (error) {
        console.error('Reaction error:', error);
        showPopup('error', messages.reactionError);
      }
    });
  });

  fetchStats();
}
