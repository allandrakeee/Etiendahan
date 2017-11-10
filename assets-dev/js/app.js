// Return to top
$(window).scroll(function() {
	if ($(this).scrollTop() >= 500) {        // If page is scrolled more than 500px
		$('#return-to-top').fadeIn(200);    // Fade in the arrow
	} else {
		$('#return-to-top').fadeOut(200);   // Else fade out the arrow
	}
});

$('#return-to-top').click(function() {      // When arrow is clicked
	$('body,html').animate({
	scrollTop : 0                       // Scroll to top of body
	}, 500);
});

// ============ SECTION 1 ============

// Nav shink
$(window).scroll(function(){
	if($(document).scrollTop() > 20) {
		$('nav').addClass('shrink');
	}
	else {
		$('nav').removeClass('shrink');
	}
});

// Touch enabled in carousel
var el = document.getElementById('carouselExampleIndicators');

Hammer(el).on("swipeleft", function () {
	$(el).carousel('next')
})

Hammer(el).on("swiperight", function () {
	$(el).carousel('prev')
})

// Hover on drop down menu
$('ul.navbar-nav li.dropdown').hover(function() {
	$(this).find('.dropdown-menu').stop(true, true).fadeIn(200);
}, function() {
	$(this).find('.dropdown-menu').stop(true, true).fadeOut(400);
});

$('nav.my-navbar div.dropdown').hover(function() {
	$(this).find('.dropdown-menu').stop(true, true).fadeIn(200);
}, function() {
	$(this).find('.dropdown-menu').stop(true, true).fadeOut(400);
});

$('ul.navbar-nav li.dropdown .dropdown-menu').hover(function(e) {
	$('ul.navbar-nav li.dropdown a.nav-link').addClass('show');
}, function() {
	$('ul.navbar-nav li.dropdown a.nav-link').removeClass('show');
});

// ============ END OF SECTION 1 ============