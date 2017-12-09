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

// Nav shink @ SECTION 1 priority
if($("#for-index").length > 0){
	$(window).scroll(function(){
		if($(document).scrollTop() > 20) {
			$('nav.index').addClass('shrink');
		}
		else {
			$('nav.index').removeClass('shrink');
		}
	});
}

// Smooth scrolling navigation
$(document).ready(function(){
	$('.navbar li a').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
		&& location.hostname == this.hostname) {
			var $target = $(this.hash);
			$target = $target.length && $target
			|| $('[name=' + this.hash.slice(1) +']');
			if ($target.length) {
				var targetOffset = $target.offset().top;
				$('html,body')
				.animate({scrollTop: targetOffset}, 1000);
			return false;
			}
		}
	});
});

// ============ SECTION 1 ============
// Touch enabled in carousel
if($("#etiendahanCarouselIndicators").length > 0){
	$(document).ready(function () {

			var el = document.getElementById('etiendahanCarouselIndicators');

			Hammer(el).on("swipeleft", function () {
				$(el).carousel('next')
			})

			Hammer(el).on("swiperight", function () {
				$(el).carousel('prev')
			})

	});
}

// Hover on drop down menu
$('ul.navbar-nav li.dropdown').hover(function() {
	$(this).find('.dropdown-menu').removeClass('animated fadeOutRight');
	$(this).find('.dropdown-menu').stop(true, true).fadeIn().addClass('animated fadeInRight');
}, function() {
	$(this).find('.dropdown-menu').removeClass('animated fadeInRight');
	$(this).find('.dropdown-menu').stop(true, true).fadeOut().addClass('animated fadeOutRight');
});

// Hover on drop down menu right nav
$('nav.my-navbar div.dropdown').hover(function() {
	$(this).find('.dropdown-menu').stop(true, true).fadeIn(1);
}, function() {
	$(this).find('.dropdown-menu').stop(true, true).fadeOut(1);
});

$('ul.navbar-nav li.dropdown .dropdown-menu').hover(function(e) {
	$('ul.navbar-nav li.dropdown a.nav-link').addClass('show');
}, function() {
	$('ul.navbar-nav li.dropdown a.nav-link').removeClass('show');
});

// Change container to container-fluid
$( function() {
if(window.innerWidth <= 1199)
    {
        $("nav.my-navbar .container").addClass('container-fluid');
        $("nav.my-navbar .container").removeClass('container');

        // $("nav.my-navbar .nav-item .nav-link").attr("data-toggle", "dropdown");
        
        $('ul.navbar-nav li.dropdown').hover(function() {
        	$(this).find('.dropdown-menu').css('display','none');
		});

		$('ul.navbar-nav li.nav-item a.nav-link').hover(function(e) {
			$(this).removeClass('cl-effect');
		}, function() {
			$(this).addClass('cl-effect');
		});

		$('nav.my-navbar div.dropdown').hover(function() {
			$(this).find('.dropdown-menu').addClass('invisible');
		}, function() {
			$(this).find('.dropdown-menu').removeClass('invisible');
		});
    }
});

$(window).resize(function(){
	if(window.innerWidth <= 1199) {
	    $("nav.my-navbar .container").addClass('container-fluid');
	    $("nav.my-navbar .container").removeClass('container');

		$('ul.navbar-nav li.dropdown').hover(function() {
	    	$(this).find('.dropdown-menu').css('display','none');
		});

		$('ul.navbar-nav li.nav-item a.nav-link').hover(function(e) {
			$(this).removeClass('cl-effect');
		}, function() {
			$(this).addClass('cl-effect');
		});

	    $('nav.my-navbar div.dropdown').hover(function() {
			$(this).find('.dropdown-menu').addClass('invisible');
		}, function() {
			$(this).find('.dropdown-menu').removeClass('invisible');
		});
	} else {
	    $("nav.my-navbar .container-fluid").addClass('container');
	    $("nav.my-navbar .container-fluid").removeClass('container-fluid');

		$('ul.navbar-nav li.dropdown').hover(function() {
	    	$(this).find('.dropdown-menu').css('display','block');
		});

		$('ul.navbar-nav li.nav-item a.nav-link').hover(function(e) {
			$(this).addClass('cl-effect');
		});

	    $('nav.my-navbar div.dropdown').hover(function() {
			$(this).find('.dropdown-menu').removeClass('invisible');
		});
	}
}); 
// ============ END OF SECTION 1 ============

// ============ SECTION 2 ============
// $('#etiendahan-section-2 .my-gallery-inner').hover(function(e) {
// 	$('#etiendahan-section-2 .my-gallery-inner .category-image').addClass('active');
// 	$('#etiendahan-section-2 .my-gallery-inner .category-image .zoom').removeClass('hide');
// 	$('#etiendahan-section-2 .my-gallery-inner .category-image .zoom').addClass('show');
// }, function() {
// 	$('#etiendahan-section-2 .my-gallery-inner .category-image .zoom').removeClass('show');
// 	$('#etiendahan-section-2 .my-gallery-inner .category-image .zoom').addClass('hide');
// });
// ============ END OF SECTION 2 ============

// ============ SECTION 3 ============
$(document).ready(function(){
  var owl = $('.owl-carousel');
	owl.owlCarousel({
		loop:true,
	    margin:10,
	    nav:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:3
	        },
	        1000:{
	            items:5
	        }
	    }
	});
	// owl.on('mousewheel', '.owl-stage', function (e) {
	//     if (e.deltaY>0) {
	//         owl.trigger('next.owl');
	//     } else {
	//         owl.trigger('prev.owl');
	//     }
	//     e.preventDefault();
	// });
});
// ============ END OF SECTION 3 ============

// ============ REGISTER PAGE - SECTION 1 ============
if($("#create-account-page").length > 0){
	var password = document.getElementById("inputPasswordSignup")
	  , confirm_password = document.getElementById("inputConfirmPasswordSignup");

	function validatePassword() {
		if(password.value != confirm_password.value) {
			confirm_password.setCustomValidity("Passwords don't match.");
		} else {
			confirm_password.setCustomValidity('');
		}
	}

	function validateMinPassword() {
		if(password.value.length < 10) {
			password.setCustomValidity("Must be less than 10 characters.");
		} else {
			password.setCustomValidity('');
		}
	}

	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;
	password.onchange = validateMinPassword;
	password.onkeyup = validateMinPassword;
}

$(document).ready(function() {
    $("#show-hide-confirm-password a").on('click', function(event) {
        event.preventDefault();
        if($('#show-hide-confirm-password input').attr("type") == "text"){
            $('#show-hide-confirm-password input').attr('type', 'password');
            $('#show-hide-confirm-password i').addClass( "fa-eye-slash" );
            $('#show-hide-confirm-password i').removeClass( "fa-eye" );
        }else if($('#show-hide-confirm-password input').attr("type") == "password"){
            $('#show-hide-confirm-password input').attr('type', 'text');
            $('#show-hide-confirm-password i').removeClass( "fa-eye-slash" );
            $('#show-hide-confirm-password i').addClass( "fa-eye" );
        }
    });
});

$(document).ready(function() {
    $("#show-hide-password a").on('click', function(event) {
        event.preventDefault();
        if($('#show-hide-password input').attr('type') == 'text'){
            $('#show-hide-password input').attr('type', 'password');
            $('#show-hide-password i').addClass('fa-eye-slash');
            $('#show-hide-password i').removeClass('fa-eye');
        }else if($('#show-hide-password input').attr('type') == 'password'){
            $('#show-hide-password input').attr('type', 'text');
            $('#show-hide-password i').removeClass('fa-eye-slash');
            $('#show-hide-password i').addClass('fa-eye');
        }
    });
});	

$('html, body').hide();
$(window).on('load', function() {
    if (window.location.hash) {
        setTimeout(function() {
            $('html, body').scrollTop(0).show();
            $('html, body').delay(300).animate({
                scrollTop: $(window.location.hash).offset().top
                }, 1000)
        }, 0);
    } else {
        $('html, body').show();

    }
});
// ============ END OF REGISTER PAGE - SECTION 1 ============


// ============ CREATE ACCOUNT PAGE - SECTION 1 ============
$('#inputPasswordSignup').pwstrength({
    ui: { showVerdictsInsideProgressBar: true }
});
// ============ END CREATE ACCOUNT PAGE - SECTION 1 ============



// ============ MY ACCOUNT PAGE - CHANGE PASSWORD - SECTION 1 ============
if($("#password-page").length > 0){
	var new_password = document.getElementById("inputPasswordNew")
	  , new_confirm_password = document.getElementById("inputPasswordNewConfirm")
	  , current_confirm_password = document.getElementById("inputPasswordCurrent");

	function validateNewPassword() {
		if(new_password.value != new_confirm_password.value) {
			new_confirm_password.setCustomValidity("Passwords don't match.");
		} else {
			new_confirm_password.setCustomValidity('');
		}
	}

	function validateMinPasswordNew() {
		if(new_password.value.length < 10) {
			new_password.setCustomValidity("Must be less than 10 characters.");
		} else {
			new_password.setCustomValidity('');
		}
	}

	function validateMinPasswordCurrent() {
		if(current_confirm_password.value.length < 10) {
			current_confirm_password.setCustomValidity("Must be less than 10 characters.");
		} else {
			current_confirm_password.setCustomValidity('');
		}
	}

	new_password.onchange = validateNewPassword;
	new_confirm_password.onkeyup = validateNewPassword;
	new_password.onchange = validateMinPasswordNew;
	new_password.onkeyup = validateMinPasswordNew;
	current_confirm_password.onchange = validateMinPasswordCurrent;
	current_confirm_password.onkeyup = validateMinPasswordCurrent;
	
}

$('#inputPasswordNew').pwstrength({
    ui: { showVerdictsInsideProgressBar: true }
});
// ============ END OF MY ACCOUNT PAGE - CHANGE PASSWORD - SECTION 1 ============