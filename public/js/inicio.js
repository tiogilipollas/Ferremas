document.addEventListener('DOMContentLoaded', (event) => {
    var isAsideOpen = false;
    var navbarHeight = document.querySelector('.navbar').offsetHeight;
    var aside = document.getElementById('herramientasAside');
    var overlay = document.querySelector('.overlay');
    var body = document.body;

    aside.style.top = navbarHeight + 'px';
    aside.style.height = `calc(100% - ${navbarHeight}px)`;

    function toggleAside() {
        isAsideOpen = !isAsideOpen;
        aside.style.display = isAsideOpen ? 'block' : 'none';
        overlay.style.display = isAsideOpen ? 'block' : 'none';
        body.style.overflow = isAsideOpen ? 'hidden' : 'auto';
    }

    // Close the aside when clicking on the overlay
    document.querySelector('.overlay').addEventListener('click', toggleAside);

    // Toggle the aside when clicking on the button
    document.getElementById('toggleAsideButton').addEventListener('click', toggleAside);
});