export function initCustomCursor() {
  const customCursor = document.querySelector('.mouse-cursor');
  if (!customCursor) {
    return () => {};
  }

  const interactiveElements = document.querySelectorAll('.cursor-set');

  const moveCustomCursor = (event) => {
    const isTouchDevice = 'ontouchstart' in window
      || navigator.maxTouchPoints > 0
      || window.matchMedia('(pointer: coarse)').matches;

    if (window.innerWidth <= 700 || isTouchDevice) {
      return;
    }

    const width = customCursor.offsetWidth;
    const height = customCursor.offsetHeight;

    customCursor.style.left = `${event.clientX - width / 2}px`;
    customCursor.style.top = `${event.clientY - height / 2}px`;
  };

  document.addEventListener('mousemove', moveCustomCursor);

  interactiveElements.forEach((element) => {
    element.addEventListener('mouseover', () => {
      customCursor.style.scale = '0.1';
      customCursor.style.transition = '0.2s ease-out';
    });

    element.addEventListener('mouseout', (event) => {
      customCursor.style.scale = '';
      customCursor.style.transition = '';
      moveCustomCursor(event);
    });
  });

  return moveCustomCursor;
}
