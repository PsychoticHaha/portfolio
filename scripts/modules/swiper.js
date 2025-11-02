export function initSwiper() {
  if (typeof Swiper === 'undefined') {
    console.warn('Swiper library is not available.');
    return null;
  }

  return new Swiper('.swiper-container', {
    slidesPerView: 'auto',
    spaceBetween: 15,
    autoplay: {
      delay: 500,
      disableOnInteraction: false
    },
    freeMode: true,
    loop: true,
    reverseDirection: true,
    pauseOnMouseEnter: true,
    speed: 2500
  });
}
