const mainNav = document.querySelector('[name="NavigationDesktop"]');
const mainLinks = mainNav.querySelector(".menu-wrap");
setMaxHeightFromTop(mainLinks);

document.addEventListener("click", function (e) {
  if (e.target && !e.target.closest('[name="NavigationDesktop"]')) {    
    closeNav();
  }
  if (e.target && e.target.closest(".nav-toggle")) {
    toggleNav();
  }   
});

// TOGGLE NAV
const toggleNav = () => {
  if (mainLinks.classList.contains("open-nav")) {
    closeNav();
  } else {
    openNav();
  }
};
const openNav = () => {
  document.body.classList.add("pause-overflow");
  mainLinks.classList.add("open-nav");
};
const closeNav = () => {
  document.body.classList.remove("pause-overflow");
  mainLinks.classList.remove("open-nav");
  document.querySelectorAll(".sub-menu.active").forEach((el) => {
    el.classList.remove("active");
  });
};





document.querySelectorAll('.menu-item-has-children').forEach((item, index) => {
  const button = item.querySelector('.nav-button');
  const submenuWrapper = item.querySelector('.submenu-wrapper');

  // Generate unique IDs
  const btnId = `nav-toggle-${index}`;
  const submenuId = `submenu-${index}`;
  button.id = btnId;
  submenuWrapper.id = submenuId;

  button.setAttribute('aria-controls', submenuId);
  submenuWrapper.setAttribute('aria-labelledby', btnId);

  button.addEventListener('click', () => {
    const isExpanded = button.getAttribute('aria-expanded') === 'true';
    button.setAttribute('aria-expanded', String(!isExpanded));
    item.classList.toggle('open');

    // If collapsing, close all nested .menu-item-has-children elements inside this item
    if (isExpanded) {
      item.querySelectorAll('.menu-item-has-children').forEach(nested => {
        if (nested !== item) {
          nested.classList.remove('open');
          const nestedButton = nested.querySelector('.nav-button');
          if (nestedButton) {
            nestedButton.setAttribute('aria-expanded', 'false');
          }
        }
      });
    }
  });
});


function setMaxHeightFromTop(el, offset = 24) {
  if (!el) return;

  const rect = el.getBoundingClientRect();
  const distanceFromTop = rect.top;
  const viewportHeight = window.innerHeight;

  const maxHeight = viewportHeight - distanceFromTop - offset;

  el.style.maxHeight = `${maxHeight}px`;
}