document.querySelector('.navbar-toggler').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('show');
});

document.querySelector('.nav-link.dropdown-toggle').addEventListener('click', function(event) {
    event.stopPropagation();
    // event.preventDefault();
});

function closeSidebar() {
    document.querySelector('.sidebar').classList.remove('show');
}