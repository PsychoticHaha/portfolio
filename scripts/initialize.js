/* Initializing Isotope */
// element argument can be a selector string
const elem = document.querySelector('.works-container');

const iso = new Isotope( elem, {
  itemSelector: '.single-work',
  layoutMode: 'fitRows'
});
