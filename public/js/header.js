$(document).ready(function() {
    function handleResize() {
        var header = document.getElementById('collapseLayouts');

        if (window.innerWidth <= 768) {
            header.classList.remove('show');
        } else {
            header.classList.add('show');
        }
    }
    handleResize();
    window.addEventListener('resize', handleResize);
});