window.addEventListener('load', function() {
    if (window.localStorage.getItem('DD_PURCHASES_Nav')) {
        track_navigation('DD_PURCHASES_Nav');
    }

    if (window.localStorage.getItem('DD_SALES_Nav')) {
        track_navigation('DD_SALES_Nav');
    }

    handleResize();
    window.addEventListener('resize', handleResize);
});

function track_navigation(element) {
	var navElement = document.getElementById(element);
	var parentElement = navElement.parentElement;
	var iconElement = parentElement.querySelector('.fas.fa-chevron-right');
	
	if (navElement.offsetHeight === 0) {
	    navElement.style.height = 'auto';
	    var autoHeight = navElement.offsetHeight + 'px';
	    navElement.style.height = '0px';
	    
	    navElement.style.transition = 'height 0.5s ease';
	    navElement.style.height = autoHeight;
	    iconElement.style.transform = 'rotate(90deg)';
	}
}

function close_navigation(element) {
    var navElement = document.getElementById(element);
    var parentElement = navElement.parentElement;
    var iconElement = parentElement.querySelector('.fas.fa-chevron-right');
    
    if (navElement.offsetHeight !== 0) {
        navElement.style.transition = 'height 0s';
        navElement.style.height = '0px';
        iconElement.style.transition = 'transform 0.5s ease';
        iconElement.style.transform = 'rotate(0deg)';
        iconElement.style.top = '50%';
        iconElement.style.transform = 'translateY(-50%)';
        window.localStorage.removeItem(element);
    }
}

function DD_Nav(element) {
    var navElement = document.getElementById(element);
    var parentElement = navElement.parentElement;
    var iconElement = parentElement.querySelector('.fas.fa-chevron-right');
    
    if (navElement.offsetHeight === 0) {
        navElement.style.height = 'auto';
        var autoHeight = navElement.offsetHeight + 'px';
        navElement.style.height = '0px';
        
        setTimeout(function() {
            navElement.style.transition = 'height 0.5s ease';
            navElement.style.height = autoHeight;
            iconElement.style.transition = 'transform 0.5s ease';
            iconElement.style.transform = 'rotate(90deg)';
        }, 10);

        window.localStorage.setItem(element, true);
    } else {
        navElement.style.transition = 'height 0.5s ease';
        navElement.style.height = '0px';
        iconElement.style.transition = 'transform 0.5s ease';
        iconElement.style.transform = 'rotate(0deg)';
        iconElement.style.top = '50%';
        iconElement.style.transform = 'translateY(-50%)';
        window.localStorage.removeItem(element);

    }
}

function navigation_hideable() {
    if (window.localStorage.getItem('DD_PURCHASES_Nav')) {
        close_navigation('DD_PURCHASES_Nav');
    }

    if (window.localStorage.getItem('DD_SALES_Nav')) {
        close_navigation('DD_SALES_Nav');
    }

    var elements = document.querySelectorAll('.hidable');
    
    elements.forEach(function(element) {
        element.style.display = 'none';
    });

    var navElement = document.querySelector('.income-with-nav > nav');

    if (navElement) {
        navElement.style.width = '50px';
    }

    var hidableElement = document.querySelector('.nav_footer > i');

    if (hidableElement) {
        hidableElement.style.display = 'none';
    }
}

function navigation_showable() {
    var navElement = document.querySelector('.income-with-nav > nav');

    if (navElement.style.width === '50px') {

        var navElement = document.querySelector('.income-with-nav > nav');

        if (navElement) {
            navElement.style.width = '320px';
        }

        var elements = document.querySelectorAll('.hidable');
        
        elements.forEach(function(element) {
            element.style.display = '';
        });

        var hidableElement = document.querySelector('.nav_footer > i');

        if (hidableElement) {
            hidableElement.style.display = '';
        }

        var hidableElement = document.querySelector('.nav_footer > i');

        if (hidableElement) {
            hidableElement.style.display = '';
        }

    }
}

$('nav').find('a').on('click', function() {
    navigation_showable();
})

function handleResize() {
    var header = document.querySelector('nav');

    if (window.innerWidth <= 768) {
        navigation_hideable()
    } else {
        navigation_showable();
    }
}