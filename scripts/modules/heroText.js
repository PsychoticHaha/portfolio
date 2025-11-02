export function initHeroTextAnimation(texts) {
  const target = document.querySelector('.js-changing-paragraph');
  const scrollCursorIcon = document.querySelector('.mouse-container .mouse');
  const aboutSectionBtn = document.querySelector('a.item.resume');

  if (scrollCursorIcon && aboutSectionBtn) {
    scrollCursorIcon.addEventListener('click', () => {
      aboutSectionBtn.click();
    });
  }

  if (!target || !Array.isArray(texts) || !texts.length) {
    return;
  }

  let currentTextIndex = 0;

  function typeText(text, index) {
    if (!target) {
      return;
    }

    if (index < text.length) {
      target.innerHTML += text.charAt(index);
      setTimeout(() => typeText(text, index + 1), 50);
    } else {
      setTimeout(() => deleteText(text, index), 1000);
    }
  }

  function deleteText(text, index) {
    if (!target) {
      return;
    }

    if (index >= 0) {
      target.innerHTML = text.substring(0, index);
      setTimeout(() => deleteText(text, index - 1), 50);
    } else {
      currentTextIndex = (currentTextIndex + 1) % texts.length;
      setTimeout(() => typeText(texts[currentTextIndex], 0), 500);
    }
  }

  target.innerHTML = '';
  typeText(texts[currentTextIndex], 0);
}
