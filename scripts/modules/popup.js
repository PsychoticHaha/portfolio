export function createPopupController() {
  const popupDiv = document.querySelector('.popup-message');
  const popupContent = popupDiv ? popupDiv.querySelector('#popup-content') : null;
  const closeButton = document.querySelector('.close-popup-btn');

  if (!popupDiv) {
    return {
      show: () => {},
      close: () => {}
    };
  }

  let timeoutHandle = null;

  const close = () => {
    if (timeoutHandle) {
      clearTimeout(timeoutHandle);
      timeoutHandle = null;
    }
    popupDiv.classList.remove('success', 'error');
  };

  const show = (type, message = '') => {
    popupDiv.classList.remove('success', 'error');

    if (message && popupContent) {
      popupContent.textContent = message;
    }

    popupDiv.classList.add(type);

    if (timeoutHandle) {
      clearTimeout(timeoutHandle);
    }

    timeoutHandle = setTimeout(() => {
      close();
    }, 2500);
  };

  if (closeButton) {
    closeButton.addEventListener('click', close);
  }

  return { show, close };
}
