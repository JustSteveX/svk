/**
 * Funktion um Collapsible Elements aus / ein-zuklappen
 * @param {string} elementName welches ein / ausgeklappt wird
 * */
function collapse(elementName) {
  const element = document.getElementById(elementName);
  const isCollapsed = !element.style.maxHeight;
  if (!isCollapsed) element.style.maxHeight = null;
  else element.style.maxHeight = element.scrollHeight + "px";


  const collapseArrow = document.getElementById('collapse-arrow');
  collapseArrow.style.transform = isCollapsed ? 'rotate(180deg)' : 'rotate(0deg)';
}

/**
 * Scrolls the carousel in a specific direction
 * @param {'forward' | 'back'} direction
 */
function scrollCarousel(direction) {
  const carouselElem = document.getElementsByClassName('carousel-wrapper')[0];
  const scrollStep = (direction === 'back' ? -1 : 1) * carouselElem.getElementsByClassName('carousel-container')[0].offsetWidth;
  console.log(`ClientWidth: ${carouselElem.clientWidth} && ScrollWidth: ${carouselElem.scrollWidth}`);
  carouselElem.scrollBy(scrollStep, 0);

  if (direction === 'back' && carouselElem.scrollLeft === 0) {
    carouselElem.scrollTo(carouselElem.scrollLeftMax, 0);
  }
  if (direction === 'forward' && carouselElem.scrollLeft === carouselElem.scrollLeftMax) {
    carouselElem.scrollTo(0, 0);
  }
}
