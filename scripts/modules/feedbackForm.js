export function setupFeedbackForm({ feedbackEndpoint, messages, popup }) {
  const wrapper = document.querySelector('.popup-wrapper');
  const closeBtn = wrapper ? wrapper.querySelector('.close') : null;
  const textarea = wrapper ? wrapper.querySelector('#feedback-message') : null;
  const submitBtn = document.getElementById('send-feedback-btn');

  const showPopup = popup?.show ?? (() => {});

  const close = () => {
    if (wrapper) {
      wrapper.classList.remove('show');
    }
  };

  const open = () => {
    if (wrapper) {
      wrapper.classList.add('show');
      textarea?.focus();
    }
  };

  if (closeBtn) {
    closeBtn.addEventListener('click', (event) => {
      event.stopPropagation();
      close();
    });
  }

  if (wrapper) {
    wrapper.addEventListener('click', (event) => {
      if (event.target === wrapper) {
        close();
      }
    });
  }

  if (submitBtn && textarea) {
    submitBtn.addEventListener('click', async () => {
      const feedbackMessage = textarea.value.trim();

      if (feedbackMessage.length < 3) {
        showPopup('error', messages.feedbackPrompt);
        return;
      }

      submitBtn.disabled = true;
      submitBtn.classList.add('loading');

      try {
        const formData = new FormData();
        formData.append('message', feedbackMessage);

        const response = await fetch(feedbackEndpoint, {
          method: 'POST',
          body: formData
        });

        if (!response.ok) {
          throw new Error(`HTTP ${response.status}`);
        }

        const payload = await response.json();
        if (payload && payload.status === 'saved') {
          showPopup('success', messages.feedbackThanks);
          textarea.value = '';
          close();
        } else {
          throw new Error('Unexpected response');
        }
      } catch (error) {
        console.error('Feedback error:', error);
        showPopup('error', messages.feedbackError);
      } finally {
        submitBtn.disabled = false;
        submitBtn.classList.remove('loading');
      }
    });
  }

  return { open, close };
}
