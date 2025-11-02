const NOTIFICATION_DURATION = 4500;

export function createPopupController() {
  const container = getOrCreateContainer();
  const appTranslations = window.APP_I18N || {};
  const closeLabel = appTranslations.messages?.closeNotification || 'Close notification';
  let lastNotification = null;
  let timeoutHandle = null;

  const removeNotification = (notification) => {
    if (!notification) {
      return;
    }
    notification.classList.add('leaving');
    setTimeout(() => {
      notification.remove();
    }, 200);
  };

  const close = () => {
    if (!lastNotification) {
      return;
    }
    removeNotification(lastNotification);
    lastNotification = null;
    if (timeoutHandle) {
      clearTimeout(timeoutHandle);
      timeoutHandle = null;
    }
  };

  const show = (type, message = '') => {
    const notification = document.createElement('div');
    notification.className = `notification notification--${type}`;

    const messageEl = document.createElement('span');
    messageEl.className = 'notification__message';
    messageEl.textContent = message || '';

    const closeBtn = document.createElement('button');
    closeBtn.className = 'notification__close';
    closeBtn.setAttribute('type', 'button');
    closeBtn.setAttribute('aria-label', closeLabel);
    closeBtn.textContent = '×';

    closeBtn.addEventListener('click', () => {
      removeNotification(notification);
      if (notification === lastNotification && timeoutHandle) {
        clearTimeout(timeoutHandle);
        timeoutHandle = null;
      }
    });

    notification.appendChild(messageEl);
    notification.appendChild(closeBtn);
    container.appendChild(notification);

    if (lastNotification && timeoutHandle) {
      clearTimeout(timeoutHandle);
      removeNotification(lastNotification);
    }

    lastNotification = notification;

    timeoutHandle = setTimeout(() => {
      if (notification === lastNotification) {
        removeNotification(notification);
        lastNotification = null;
      }
    }, NOTIFICATION_DURATION);
  };

  return { show, close };
}

function getOrCreateContainer() {
  let container = document.querySelector('.global-notifications');

  if (!container) {
    container = document.createElement('div');
    container.className = 'global-notifications';
    container.setAttribute('aria-live', 'polite');
    container.setAttribute('aria-atomic', 'true');
    document.body.appendChild(container);
  }

  return container;
}
