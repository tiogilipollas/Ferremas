// JavaScript
document.querySelector('.dropdown-toggle').addEventListener('click', function (event) {
    event.stopPropagation();
    var dropdownMenu = this.nextElementSibling;
    dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
});

window.addEventListener('click', function () {
    var dropdownMenu = document.querySelector('.dropdown-menu');
    if (dropdownMenu.style.display === 'block') {
        dropdownMenu.style.display = 'none';
    }
});
