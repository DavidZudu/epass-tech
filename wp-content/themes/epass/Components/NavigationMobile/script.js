const mainNav = document.querySelector('[name="NavigationMobile"]')
const mainLinks = mainNav.querySelector('.menu-wrap')

document.addEventListener('click', function (e) {
  console.log("ksdjhf")
  if (e.target && e.target.closest('.nav-toggle')) {
    toggleNav();
  }
  if (e.target && e.target.closest('.sub-toggle'))  {
    console.log("clicked")
    let toggle = e.target.closest('.sub-toggle')
    toggle.classList.toggle('active');
    let target = toggle.nextElementSibling
    subToggle(target);
  }
  if (e.target && e.target.closest('.nav-back'))  {
    let toggle = e.target.closest('.nav-back')
    let target = toggle.closest('.sub-menu')
    navBack(target);
  }
  
});



// TOGGLE NAV
const toggleNav = () => {
  if (mainLinks.classList.contains('open-nav')) {
    closeNav()
  } else {
    openNav()
  }
}
const openNav = () => {
  console.log("opennav")
  document.body.classList.add('pause-overflow')
  mainLinks.classList.add('open-nav')
}
const closeNav = () => {
  console.log("closenav")
  document.body.classList.remove('pause-overflow')
  mainLinks.classList.remove('open-nav')
  document.querySelectorAll('.sub-menu.active').forEach(el => {
    el.classList.remove('active')
  })
}

//Submenu toggle
function subToggle(target) {
    target.classList.toggle('open');
    if (target.classList.contains('open')) {
      let height = target.children[0].scrollHeight + 'px'
      target.style.maxHeight = height;
    } else{
      target.style.maxHeight = '0px';
    }
    
}
