const TYPING_INTERVAL = 70;
const ERASING_INTERVAL = 40;
const BETWEEN_WORD_DELAY = 1600;
const BETWEEN_ERASE_DELAY = 400;

export function initHeroTextAnimation(texts) {
  const textContainer = document.querySelector('.js-changing-paragraph');
  const cursor = document.querySelector('.hero-typing-cursor');
  const scrollCursorIcon = document.querySelector('.mouse-container .mouse');
  const aboutSectionBtn = document.querySelector('a.item.resume');

  if (scrollCursorIcon && aboutSectionBtn) {
    scrollCursorIcon.addEventListener('click', () => aboutSectionBtn.click());
  }

  if (!textContainer || !cursor || !Array.isArray(texts) || !texts.length) {
    return;
  }

  let currentIndex = 0;
  let typingTimeout = null;
  let erasingTimeout = null;

  const setText = (value) => {
    textContainer.textContent = value;
  };

  const type = (text, index = 0) => {
    if (index <= text.length) {
      setText(text.slice(0, index));
      typingTimeout = setTimeout(() => type(text, index + 1), TYPING_INTERVAL);
      return;
    }

    erasingTimeout = setTimeout(() => erase(text, text.length - 1), BETWEEN_WORD_DELAY);
  };

  const erase = (text, index) => {
    if (index >= 0) {
      setText(text.slice(0, index));
      erasingTimeout = setTimeout(() => erase(text, index - 1), ERASING_INTERVAL);
      return;
    }

    currentIndex = (currentIndex + 1) % texts.length;
    typingTimeout = setTimeout(() => type(texts[currentIndex]), BETWEEN_ERASE_DELAY);
  };

  const cleanup = () => {
    clearTimeout(typingTimeout);
    clearTimeout(erasingTimeout);
  };

  window.addEventListener('beforeunload', cleanup);

  setText('');
  cursor.classList.add('visible');
  type(texts[currentIndex]);
}
