const EMAIL_REGEX = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

export function setupContactForm({ messageEndpoint, messages, popup }) {
  const contactForm = document.getElementById('contact-form');
  const sendBtn = document.getElementById('send-message-btn');
  const fullnameInput = document.getElementById('fullname');
  const emailInput = document.getElementById('email');
  const messageInput = document.getElementById('message');

  if (!contactForm || !sendBtn || !fullnameInput || !emailInput || !messageInput) {
    return;
  }

  const showPopup = popup?.show ?? (() => {});
  const siteKey = contactForm.dataset.recaptchaSitekey || '';

  const resetForm = () => {
    contactForm.reset();
    const tokenInput = document.getElementById('recaptcha-token');
    if (tokenInput) {
      tokenInput.value = '';
    }
  };

  const requestRecaptchaToken = () => new Promise((resolve, reject) => {
    if (!siteKey) {
      resolve(null);
      return;
    }

    const ensureRecaptcha = () => new Promise((innerResolve, innerReject) => {
      if (typeof grecaptcha !== 'undefined') {
        innerResolve();
        return;
      }

      const maxAttempts = 20;
      let attempts = 0;
      const interval = setInterval(() => {
        attempts += 1;

        if (typeof grecaptcha !== 'undefined') {
          clearInterval(interval);
          innerResolve();
        } else if (attempts >= maxAttempts) {
          clearInterval(interval);
          innerReject(new Error(messages.verificationUnavailable));
        }
      }, 250);
    });

    ensureRecaptcha()
      .then(() => {
        grecaptcha.ready(() => {
          grecaptcha.execute(siteKey, { action: 'contact_form' })
            .then((token) => resolve(token))
            .catch(() => reject(new Error(messages.verificationFailed)));
        });
      })
      .catch(reject);
  });

  contactForm.addEventListener('submit', async (event) => {
    event.preventDefault();

    const fullname = fullnameInput.value.trim();
    const email = emailInput.value.trim();
    const userMessage = messageInput.value.trim();

    if (!fullname || !email || !EMAIL_REGEX.test(email) || userMessage.length < 6) {
      showPopup('error', messages.formInvalid);
      return;
    }

    sendBtn.disabled = true;
    sendBtn.classList.add('loading');

    try {
      const token = await requestRecaptchaToken();

      const formData = new FormData();
      formData.append('fullname', fullname);
      formData.append('email', email);
      formData.append('message', userMessage);

      if (token) {
        formData.append('g-recaptcha-response', token);
        formData.append('recaptcha_action', 'contact_form');
        const hiddenToken = document.getElementById('recaptcha-token');
        if (hiddenToken) {
          hiddenToken.value = token;
        }
      }

      const response = await fetch(messageEndpoint, {
        method: 'POST',
        body: formData
      });

      if (!response.ok) {
        throw new Error(`HTTP ${response.status}`);
      }

      let payload = null;

      try {
        payload = await response.json();
      } catch (parseError) {
        throw new Error('Unexpected response from the server.');
      }

      if (payload === 'sent' || (payload && payload.status === 'sent')) {
        showPopup('success', messages.thanksMessage);
        resetForm();
        return;
      }

      const messageText = payload && payload.message ? payload.message : messages.formError;
      throw new Error(messageText);
    } catch (error) {
      console.error('Contact form error:', error);
      showPopup('error', error.message || messages.formError);
    } finally {
      sendBtn.disabled = false;
      sendBtn.classList.remove('loading');
    }
  });
}
