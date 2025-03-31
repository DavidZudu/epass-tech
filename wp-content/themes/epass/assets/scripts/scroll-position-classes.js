window.addEventListener('scroll', checkScrollPos);
window.addEventListener('resize', checkScrollPos);
window.addEventListener('load', checkScrollPos);

function scrollingDirection() {
    if (this.oldScroll > this.scrollY) {
        document.body.classList.add("scrolling-up");
        document.body.classList.remove("scrolling-down");
    } else {
        document.body.classList.remove("scrolling-up");
        document.body.classList.add("scrolling-down");
    }
    this.oldScroll = this.scrollY;
}

function checkScrollPos() {
    const header = document.querySelector('[is=flynt-layout-home-header],[is=flynt-layout-post-header]');
    const headerPos = header ? header.getBoundingClientRect() : null;

    // Window is within 10px of the top
    if (window.scrollY <= 10) {
        document.body.classList.add("at-top");
    } else {
        document.body.classList.remove("at-top");
    }

    // Window has scrolled past the header
    if (headerPos) {
        if (headerPos.bottom < 0) {
            document.body.classList.add("passed-header");
        } else {
            document.body.classList.remove("passed-header");
        }
    }

    // User is near the bottom of the page
    if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight - 10) {
        document.body.classList.add("at-bottom");
    } else {
        document.body.classList.remove("at-bottom");
    }

    // Page is shorter than the viewport
    if (document.body.scrollHeight <= window.innerHeight + 1) {
        document.body.classList.add("is-short-page");
    } else {
        document.body.classList.remove("is-short-page");
    }
}


