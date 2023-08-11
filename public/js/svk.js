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
 * Scrolls the carousel
 * @param {HTMLButtonElement} btnElem
 */
function scrollCarousel(btnElem) {
  const direction = btnElem.id;
  const carouselElem = btnElem.parentElement.getElementsByClassName('carousel-wrapper')[0];
  if (direction === 'back' && carouselElem.scrollLeft === 0) {
    carouselElem.scrollTo(carouselElem.scrollWidth, 0);
    //carouselElem.scrollTo(carouselElem.scrollLeftMax, 0);
  } else if (direction === 'forward' && carouselElem.scrollLeft + carouselElem.offsetWidth === carouselElem.scrollWidth) {
    carouselElem.scrollTo(0, 0);
  } else {
    const gap = calcGap(carouselElem);
    const scrollStep = (direction === 'back' ? -1 : 1) * (carouselElem.getElementsByClassName('carousel-container')[0].offsetWidth + gap);
    carouselElem.scrollBy(scrollStep, 0);
  }

  function calcGap(carouselElem) {
    const carouselItems = carouselElem.getElementsByClassName('carousel-container');
    return (carouselElem.scrollWidth - (carouselItems.length * carouselItems[0].offsetWidth)) / (carouselItems.length - 1);
  }
}

