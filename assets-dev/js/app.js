// Return to top
$(window).scroll(function() {
	if ($(this).scrollTop() >= 500) {        // If page is scrolled more than 500px
		$('#return-to-top').fadeIn(200);    // Fade in the arrow
	} else {
		$('#return-to-top').fadeOut(200);   // Else fade out the arrow
	}
});

// pre loader
if($("#seller-centre-page-signin").length > 0) {
	$(window).on('load', function() {
		setTimeout(function() {
	      $('body').addClass('loaded');
	    }, 2000);
	});
}

if($("#specialty-in-city-page").length > 0) {
	$(window).on('load', function() {
		setTimeout(function() {
	      $('body').addClass('loaded');
	    }, 100);
	});
}

$('#return-to-top').click(function() {      // When arrow is clicked
	$('body,html').animate({
	scrollTop : 0                       // Scroll to top of body
	}, 500);
});

// Nav shink @ SECTION 1 priority
if($("#for-index").length > 0) {
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

// tooltips
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})

// popup notification
// $(document).ready(function () {
// 	function load_last_notification() {
// 		$.ajax({
// 			url: "fetch.php",
// 			method: "POST",
// 			success: function(data) {
// 				$('.content-popup').html(data);
// 			}
// 		})
// 	}
// });

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

$('.recent').hide();

$('.hintable').focus(function() {
   $('.recent').hide();
   $("."+$(this).attr('hint-class')).show();
});

$('.hintable').blur(function() {
   $('.recent').hide();
});
// ============ END OF SECTION 1 ============

// ============ SECTION 2 ============
// lazy load image
$(function() {
    $('.lazy').lazy({
      effect: "fadeIn",
      effectTime: 2000,
      threshold: 0
    });
});

$(function(){
  $('#etiendahan-section-2 .my-gallery-inner').hover(function() {
    $(this).find('.category-image .zoom').addClass('show');
    $(this).find('.category-image .zoom').removeClass('hide');
  }, function() {
  	$(this).find('.category-image .zoom').addClass('hide');
    $(this).find('.category-image .zoom').removeClass('show');
  })
})

new WOW().init();

// $('#etiendahan-section-2 .my-gallery-inner').hover(
//        function(){ $('#etiendahan-section-2 .my-gallery-inner .category-image .zoom').addClass('show') },
//        function(){ $('#etiendahan-section-2 .my-gallery-inner .category-image .zoom').removeClass('show') }
// )

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
    	lazyLoad:true,
		loop:false,
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

// ============ SECTION 7 ============
// Load Facebook SDK for JavaScript
// (function(d, s, id) {
// 	  var js, fjs = d.getElementsByTagName(s)[0];
// 	  if (d.getElementById(id)) return;
// 	  js = d.createElement(s); js.id = id;
// 	  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=472668573084845';
// 	  fjs.parentNode.insertBefore(js, fjs);
// 	}(document, 'script', 'facebook-jssdk'));
// ============ END OF SECTION 7 ============

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

if (location.hash === "#shop-now") {
    $('html, body').hide();
	$(window).on('load', function() {
	    if (window.location.hash) {
	        setTimeout(function() {
	            $('html, body').scrollTop(0).show();
	            $('html, body').delay(500).animate({
	                scrollTop: $(window.location.hash).offset().top
	                }, 1000)
	        }, 150);
	    } else {
	        $('html, body').show();

	    }
	});
}

$(window).on('load', function() {
    if (window.location.hash) {
        setTimeout(function() {
            $('html, body').scrollTop(0).show();
            $('html, body').delay(1000).animate({
                scrollTop: $(window.location.hash).offset().top
                }, 1000)
        }, 150);
    } else {
        $('html, body').show();

    }
});

// $('html, body').hide();
// $(window).on('load', function() {
//     if (window.location.hash) {
//         setTimeout(function() {
//             $('html, body').scrollTop(0).show();
//             $('html, body').delay(300).animate({
//                 scrollTop: $(window.location.hash).offset().top
//                 }, 1000)
//         }, 0);
//     } else {
//         $('html, body').show();

//     }
// });
// ============ END OF REGISTER PAGE - SECTION 1 ============


// ============ CREATE ACCOUNT PAGE - SECTION 1 ============
$('#inputPasswordSignup').pwstrength({
    ui: { showVerdictsInsideProgressBar: true }
});

$('.modal').on('shown.bs.modal', function() {
  $(this).find('[autofocus]').focus();
});

if($("#password-page").length > 0){
	var password = document.getElementById("inputPasswordNew")
	  , confirm_password = document.getElementById("inputPasswordNewConfirm");

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
    $("#show-hide-current-password a").on('click', function(event) {
        event.preventDefault();
        if($('#show-hide-current-password input').attr('type') == 'text'){
            $('#show-hide-current-password input').attr('type', 'password');
            $('#show-hide-current-password i').addClass('fa-eye-slash');
            $('#show-hide-current-password i').removeClass('fa-eye');
        }else if($('#show-hide-current-password input').attr('type') == 'password'){
            $('#show-hide-current-password input').attr('type', 'text');
            $('#show-hide-current-password i').removeClass('fa-eye-slash');
            $('#show-hide-current-password i').addClass('fa-eye');
        }
    });
});	

$('#prevent-not-to-scroll').on( 'mousewheel DOMMouseScroll', function (e) { 
  
  var e0 = e.originalEvent;
  var delta = e0.wheelDelta || -e0.detail;

  this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
  e.preventDefault();  
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

$(document).ready(function() {
    $('#popup-notification').delay(1000).fadeIn(400);
});

$("#popup-close").click(function() {
	$("#popup-notification").css("margin-left", "-430px");
});

setTimeout(function() {
    $('#popup-notification').css("margin-left", "-430px");
}, 10000);

$(document).ready(function() {
   str = $('.popup-content').text();
   if($.trim(str) === "") {
     	$('#popup-notification').remove();
   }
});

// welcome
$(document).ready(function() {
    $('#popup-notification-welcome').delay(1000).fadeIn(400);
});

$("#popup-close-welcome").click(function() {
	$("#popup-notification-welcome").css("margin-left", "-430px")
});

setTimeout(function() {
    $('#popup-notification-welcome').css("margin-left", "-430px");
}, 10000);

$(document).ready(function() {
   str = $('.popup-content-welcome').text();
   if($.trim(str) === "") {
     	$('#popup-notification-welcome').remove();
   }
});


// logout
$(document).ready(function() {
    $('#popup-notification-logout').delay(1000).fadeIn(400);
});

$("#popup-close-logout").click(function() {
	$("#popup-notification-logout").css("margin-left", "-430px")
});

setTimeout(function() {
    $('#popup-notification-logout').css("margin-left", "-430px");
}, 10000);

$(document).ready(function() {
   str = $('.popup-content-logout').text();
   if($.trim(str) === "") {
     	$('#popup-notification-logout').remove();
   }
});

// logout - redirect
$(document).ready(function() {
    $('#popup-notification-logout-redirect').delay(1000).fadeIn(400);
});

$("#popup-close-logout-redirect").click(function() {
	$("#popup-notification-logout-redirect").css("margin-left", "-430px");
});

setTimeout(function() {
    $('#popup-notification-logout-redirect').css("margin-left", "-430px");
}, 10000);

$(document).ready(function() {
   str = $('.popup-content-logout-redirect').text();
   if($.trim(str) === "") {
     	$('#popup-notification-logout-redirect').remove();
   }
});

// completed
$(document).ready(function() {
    $('#popup-notification-completed').delay(1000).fadeIn(400);
});

$("#popup-close").click(function() {
	$("#popup-notification-completed").css("margin-left", "-430px");
});

setTimeout(function() {
    $('#popup-notification-completed').css("margin-left", "-430px");
}, 10000);

$(document).ready(function() {
   str = $('.popup-content-completed').text();
   if($.trim(str) === "") {
     	$('#popup-notification-completed').remove();
   }
});

// ============ END OF MY ACCOUNT PAGE - CHANGE PASSWORD - SECTION 1 ============


// ============ MY ACCOUNT PAGE - CHANGE ADDRESS - SECTION 1 ===========
$(function(){ 
    $("select[name='province']").change(function() {            
        if (this.selectedIndex == 0){
        	// $('#city').children('option:not(:second)').remove();

    		$('#city')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="" selected>City</option>');    	

			$('#barangay')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="" selected>Barangay</option>');    
        }
  	});

    $("select[name='city']").change(function() {            
        if (this.selectedIndex == 0){
			$('#barangay')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="" selected>Barangay</option>');  
        }
  	});

}); 

var municipalityByCategory = {
    1: ["City", "Bangued", "Boliney", "Bucay", "Bucloc", "Daguioman", "Danglas", "Dolores", "La Paz", "Lacub", "Lagangilang", "Lagayan", "Langiden", "Licuan~Baay", "Luba", "Malibcong", "Manabo", "Penarrubia", "Pidigan", "Pilar", "Sallapadan", "San Isidro", "San Juan", "San Quintin", "Tayum", "Tineg", "Villaviciosa"],
    // Pangasinan
    77: ["City", "Agno", "Aguilar", "Alaminos City", "Alcala", "Anda", "Asingan", "Balungao", "Bani", "Basista", "Bautista", "Bayambang", "Binalonan", "Binmaley", "Bolinao", "Bugallon", "Burgos", "Calasiao", "Dagupan City", "Dasol", "Infanta", "Laoac", "Lingayen", "Mabini", "Malasiqui", "Manaoag", "Mangaldan", "Mangatarem", "Mapandan", "Natividad", "Pozorrubio", "Rosales", "San Carlos City", "San Fabian", "San Jacinto", "San Manuel", "San Nicolas", "San Quintin", "Santa Barbara", "Santa Maria", "Santo Tomas", "Sison", "Sual", "Tayug", "Umingan", "Urbiztondo", "Urdaneta City", "Villasis"]
}

var cityInProvinceChangeByCategory = {
	0: ["Barangay"],
    1: ["Barangay"],
    2: ["Barangay"],
    3: ["Barangay"],
    4: ["Barangay"],
    5: ["Barangay"],
    6: ["Barangay"],
    7: ["Barangay"],
    8: ["Barangay"],
    9: ["Barangay"],
    10: ["Barangay"],
    11: ["Barangay"],
    12: ["Barangay"],
    13: ["Barangay"],
    14: ["Barangay"],
    15: ["Barangay"],
    16: ["Barangay"],
    17: ["Barangay"],
    18: ["Barangay"],
    19: ["Barangay"],
    20: ["Barangay"],
    21: ["Barangay"],
    22: ["Barangay"],
    23: ["Barangay"],
    24: ["Barangay"],
    25: ["Barangay"],
    26: ["Barangay"],
    27: ["Barangay"],
    28: ["Barangay"],
    29: ["Barangay"],
    30: ["Barangay"],
    31: ["Barangay"],
    32: ["Barangay"],
    33: ["Barangay"],
    34: ["Barangay"],
    35: ["Barangay"],
    36: ["Barangay"],
    37: ["Barangay"],
    38: ["Barangay"],
    39: ["Barangay"],
    40: ["Barangay"],
    41: ["Barangay"],
    42: ["Barangay"],
    43: ["Barangay"],
    44: ["Barangay"],
    45: ["Barangay"],
    46: ["Barangay"],
    47: ["Barangay"],
    48: ["Barangay"],
    49: ["Barangay"],
    50: ["Barangay"],
    51: ["Barangay"],
    52: ["Barangay"],
    53: ["Barangay"],
    54: ["Barangay"],
    55: ["Barangay"],
    56: ["Barangay"],
    57: ["Barangay"],
    58: ["Barangay"],
    59: ["Barangay"],
    60: ["Barangay"],
    61: ["Barangay"],
    62: ["Barangay"],
    63: ["Barangay"],
    64: ["Barangay"],
    65: ["Barangay"],
    66: ["Barangay"],
    67: ["Barangay"],
    68: ["Barangay"],
    69: ["Barangay"],
    70: ["Barangay"],
    71: ["Barangay"],
    72: ["Barangay"],
    73: ["Barangay"],
    74: ["Barangay"],
    75: ["Barangay"],
    76: ["Barangay"],
    77: ["Barangay"],
    78: ["Barangay"],
    79: ["Barangay"],
    80: ["Barangay"],
    81: ["Barangay"],
    82: ["Barangay"],
    83: ["Barangay"],
    84: ["Barangay"],
    85: ["Barangay"],
    86: ["Barangay"],
    87: ["Barangay"],
    88: ["Barangay"],
    89: ["Barangay"],
    90: ["Barangay"],
    91: ["Barangay"],
    92: ["Barangay"],
    93: ["Barangay"],
    94: ["Barangay"],
    95: ["Barangay"],
    96: ["Barangay"],
    97: ["Barangay"],
    98: ["Barangay"]
}

function changeprovince(value) {
    if (value.length == 0) document.getElementById("city").innerHTML = "<option></option>";
    else {
		var municipalityOptions = "";
		for (municipalityId in municipalityByCategory[value]) {
			if (municipalityByCategory[value][municipalityId] == "City") {
				municipalityOptions = "<option value=''>City</option>";
			} else {
				municipalityOptions += "<option value='" + municipalityByCategory[value][municipalityId] + "'>" + municipalityByCategory[value][municipalityId] + "</option>";
			} 
		}
		document.getElementById("city").innerHTML = municipalityOptions;
    }

    if (value.length == 0) document.getElementById("barangay").innerHTML = "<option></option>";
    else {
		var cityOptions = "";
		for (cityId in cityInProvinceChangeByCategory[value]) {
		cityOptions += "<option value='" + cityInProvinceChangeByCategory[value][cityId] + "'>" + cityInProvinceChangeByCategory[value][cityId] + "</option>";
		}
		document.getElementById("barangay").innerHTML = cityOptions;
    }
}

var cityByCategory = {
	"Municipality": ["Barangay"],
	// Abra
    "Bangued": ["Barangay", "Agtangao", "Angad", "Bagacao", "Bangbangar", "Cabuloan", "Calaba", "Cosili East (Proper)", "Cosili West (Buaya)", "Dangdangla", "Lingtan", "Lipcan", "Lubong", "Macarcarmay", "Macray", "Malita", "Maoay", "Palao", "Patucannay", "Sagap", "San Antonio", "Santa Rosa", "Sao~atan", "Sappaac", "Tablac (Calot)", "Zone 1 Pob. (Nalasin)", "Zone 2 Pob. (Consiliman)", "Zone 3 Pob. (Lalaud)", "Zone 4 Pob. (Town Proper)", "Zone 5 Pob. (Bo. Barikir)", "Zone 6 Pob. (Sinapangan)", "Zone 7 Pob. (Baliling)"],
    // Pangasinan
    "Agno": ["Barangay", "Allabon", "Aloleng", "Bangan~Oda", "Baruan", "Boboy", "Cayungnan", "Dangley", "Gayusan", "Macaboboni", "Magsaysay", "Namatucan", "Patar", "Poblacion East", "Poblacion West", "San Juan", "Tupa", "Viga"],
    "Dagupan City": ["Barangay", "Bacayao Norte", "Bacayao Sur", "Barangay I (T. Bugallon)", "Barangay Ii (Nueva)", "Barangay Iv (Zamora)", "Bolosan", "Bonuan Binloc", "Bonuan Boquig", "Bonuan Gueset", "Calmay", "Carael", "Caranglaan", "Herrero", "Lasip Chico", "Lasip Grande", "Lomboy", "Lucao", "Malued", "Mamalingling", "Mangin", "Mayombo", "Pantal", "Poblacion Oeste", "Pogo Chico", "Pogo Grande", "Pugaro Suit", "Salapingao", "Salisay", "Tambac", "Tapuac", "Tebeng"]
}

function changemunicipality(value) {
    if (value.length == 0) document.getElementById("barangay").innerHTML = "<option></option>";
    else {
		var cityOptions = "";
		for (cityId in cityByCategory[value]) {
			if (cityByCategory[value][cityId] == "Barangay") {
				cityOptions += "<option value=''>" + cityByCategory[value][cityId] + "</option>";
			}

			if (cityByCategory[value][cityId] != "Barangay") {
				cityOptions += "<option value='" + cityByCategory[value][cityId] + "'>" + cityByCategory[value][cityId] + "</option>";
			} 

		}
		document.getElementById("barangay").innerHTML = cityOptions;
    }
}
// ============ END OF MY ACCOUNT PAGE - CHANGE ADDRESS - SECTION 1 ============

// ============ CATEGORY PAGE ============
$(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#list').addClass('active');$('#grid').removeClass('active');
    	$('#item-wrapper-grid-list .item').addClass('list-group-item');
	});
    $('#grid').click(function(event){event.preventDefault();$('#grid').addClass('active');$('#list').removeClass('active');
    	$('#item-wrapper-grid-list .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');
	});
});
// ============ END OF CATEGORY PAGE ============

// ============ VIEW ITEM PAGE ============

$(document).ready(function () {
	

  $('.span3').click(function () {
  	var attr = $(this).attr("data-display");
    $('#data-display img').attr("src", attr);
    // $('#data-display img').css('background', 'url('+attr+')');
  });
});

$(document).ready(function() {
    $('#lightSlider').lightSlider({
	    gallery: true,
	    item: 1,
	    loop:false,
	    slideMargin: 0,
	    thumbItem: 9,

	    keyPress: false,
        controls: true,
        prevHtml: '<i class="fa fa-arrow-circle-o-left product-view"></i>',
        nextHtml: '<i class="fa fa-arrow-circle-o-right product-view"></i>',

	});
});
// ============ END OF VIEW ITEM PAGE ============

// ============ END OF MAGNIFIER PAGE ============
if($("#view-product-page").length > 0) {
	// var evt = new Event(),
 //    m = new Magnifier(evt);
	// m.attach({thumb: '#thumb', mode: 'inside', zoom: 2, zoomable: true});
}
// ============ END OF MAGNIFIER PAGE ============

// ============ VIEW PRODUCT PAGE ============
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }    
});

$(function() {
    $('.check').click(function() {
        $(this).toggleClass('check checked');
    });
});

$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('id'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).attr('id'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
      $("#reviewFullname").prop('disabled', false);
      $("#reviewEmail").prop('disabled', false);
      $("#reviewTitle").prop('disabled', false);
      $("#reviewBody").prop('disabled', false);
      $(".submit-review").prop('disabled', false);

    }
    
  });
});
// ============ END OF VIEW PRODUCT PAGE ============

// ============ SELLER SHOP PAGE ============ 



// ============ END OF SELLER SHOP PAGE ============ 




// ============ SELLER CENTRE PAGE ============ 
$('.seller-centre-link').click(function(){
  location.href = $(this).attr('data-url');
});

if($("#product-details-page").length > 0) {
	// $('#inputProductPrice').keyup(function(event) {
	// 	// skip for arrow keys
	// 	if(event.which >= 37 && event.which <= 40) return;
	// 	// format number
	// 	$(this).val(function(index, value) {
	// 		return value
	// 		.replace(/\D/g, "")
	// 		.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	// 	});
	// });

	// document.getElementById("inputProductPrice").onblur =function (){   
	// 		if(this.value = this.value) { 
	// 		    this.value = parseFloat(this.value.replace(/,/g, ""));
	//         } else {
	//         	this.value = '';
	//         }
 //        }

	// document.querySelector("#inputProductPrice").addEventListener("keypress", function (evt) {
	//     if (evt.which < 48 || evt.which > 57)
	//     {
	//         evt.preventDefault();
	//     }
	// });
}

var myVar1;

function myFunction1() {
    myVar1 = setTimeout( function () { 
		        $('.myform').submit();
		    }, 2000);
}

function myStopFunction1() {
    clearTimeout(myVar1);
}

jQuery(document).ready(function($) { 
    //reset
    $(".myform .activate-seller").prop("checked", false);
    $(".myform .activate-seller").click(function () {

        if ($(this).is(":checked")) {

            //checked
            $(this).addClass("checked");

        } else {
            //unchecked
            $(this).removeClass("checked");
			myStopFunction1();
        }

    })

});

jQuery(document).ready(function($) { 
	$(".activate-seller").click(function () {
		if($(this).hasClass('checked')){
		    myFunction1();
		}
	});
});

// wishlists
var myVar;

function myFunction() {
    myVar = setTimeout( function () { 
		        $('.wishlists-form').submit();
		    }, 1500);
}

function myStopFunction() {
    clearTimeout(myVar);
}

jQuery(document).ready(function($) { 
    //reset
    $(".wishlists-form .wishlists-input").prop("checked", false);
    $(".wishlists-form .wishlists-input").click(function () {

        if ($(this).is(":checked")) {

            //checked
            $(this).addClass("checked");

        } else {
            //unchecked
            $(this).removeClass("checked");
			myStopFunction();
        }

    })

});

jQuery(document).ready(function($) { 
	$(".wishlists-input").click(function () {
		if($(this).hasClass('checked')){
		    myFunction();
		}
	});
});

// getting the parent id in the other page in ajax request
function get_child_options(selected) {
	if(typeof selected === 'object') {
		var selected = '';
	}

	var parent_id = jQuery('#category').val();
	jQuery.ajax({
		url: '/etiendahan/c8NLPYLt-functions/child-categories/',
		type: 'POST',
		data: {parent_id : parent_id, selected : selected},
		success: function(data){
			jQuery('#sub-category').html(data);
		},
		error: function(){alert("Something went wrong with the child options.")}
	});
}

jQuery('select[name="category"]').change(function(){
	get_child_options();
});

$(document).on('click', 'div.product-wrapper.list', function(){
    var product_details_id = $(this).attr('id');
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"product_details_id": product_details_id});
});

$(document).on('click', 'button.delete-image', function(){
    var product_details_id = $("input[name=my-hidden-input]").val();
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"product_details_id": product_details_id});
});

$(document).on('click', '.my-gallery-inner', function(){
    var category_id = $(this).attr('id');
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"category_id": category_id});
});

$(document).on('click', 'a.go-to-sub', function(){
    var sub_category_id = $(this).attr('id');
    // alert(sub_category_id);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"sub_category_id": sub_category_id});
});

$(document).on('click', '.category-product-id', function(){
    var category_product_id = $(this).attr('id');
    // alert(category_product_id);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"category_product_id": category_product_id});
});

$(document).on('click', '.category-product-id', function(){
    var category_product_id_sightings = $(this).attr('id');
    // alert(category_product_id_sightings);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"category_product_id_sightings": category_product_id_sightings});
});

$(document).on('click', '.view-shop', function(){
    var seller_shop_email = $(this).attr('id');
    // alert(seller_shop_email);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"seller_shop_email": seller_shop_email});
});

$(document).on('click', '.related-products', function(){
    var sub_category_name = $(this).attr('id');
    // alert(sub_category_name);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"sub_category_name": sub_category_name});
});

$(document).on('click', '.post-page', function(){
    var post_page = $(this).attr('id');
    // alert(post_page);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"post_page": post_page});
});

$(document).on('click', '.address-delete', function(){
    var address_delete = $(this).attr('id');
    // alert(address_delete);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"address_delete": address_delete});
});

$(document).on('click', '.address-update', function(){
    var address_update = $(this).attr('id');
    // alert(address_update);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"address_update": address_update});
});

$(document).on('click', '.wishlist-toggle', function(){
    var wishlist_product_id = $(this).attr('id');
    // alert(wishlist_product_id);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"wishlist_product_id": wishlist_product_id});
});

$(document).on('click', '.wishlists-delete', function(){
    var wishlists_delete = $(this).attr('id');
    // alert(wishlists_delete);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"wishlists_delete": wishlists_delete});
});

$(document).on('click', '.wishlists-cart', function(){
    var wishlists_cart = $(this).attr('id');
    // alert(wishlists_cart);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"wishlists_cart": wishlists_cart});
});

$(document).on('click', '.add-to-cart', function(){
    var add_to_cart_product_id = $(this).attr('id');
    var input_quantity = $('#input-quantity').val();
    // alert(add_to_cart_product_id);
    // alert(input_quantity);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"add_to_cart_product_id": add_to_cart_product_id, "input_quantity": input_quantity});
});

$(document).on('click', '.cart-delete', function(){
    var cart_product_id_delete = $(this).attr('id');
    // alert(cart_product_id_delete);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"cart_product_id_delete": cart_product_id_delete});
});

$(document).on('click', '.report-review', function(){
    var report_rating = $(this).attr('id');
    // alert(report_rating);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"report_rating": report_rating});
});

$(document).on('click', '.submit-review', function(){
	var ids = $(".star.selected[id]").map(function() {
    return this.id;
	}).get();

	var rating_value = Math.max.apply( Math, ids );
	// alert(rating_value);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"rating_value": rating_value});
});

// currency input
$('.money > div').click(function() {
    $('.money > input:eq('+$('.money > div').index(this)+')').focus();
});

$('.numberOnly').on('keydown', function(e) {
	
  if (this.selectionStart || this.selectionStart == 0) {
	// selectionStart won't work in IE < 9
	
	var key = e.which;
	var prevDefault = true;
	
	var thouSep = ",";  // your seperator for thousands
	var deciSep = ".";  // your seperator for decimals
	var deciNumber = 2; // how many numbers after the comma
	
	var thouReg = new RegExp(thouSep,"g");
	var deciReg = new RegExp(deciSep,"g");
	
	function spaceCaretPos(val, cPos) {
		/// get the right caret position without the spaces
		
		if (cPos > 0 && val.substring((cPos-1),cPos) == thouSep)
		  cPos = cPos-1;
		
		if (val.substring(0,cPos).indexOf(thouSep) >= 0) {
		  cPos = cPos - val.substring(0,cPos).match(thouReg).length;
		}
		
		return cPos;
	}
	
	function spaceFormat(val, pos) {
		/// add spaces for thousands
		
		if (val.indexOf(deciSep) >= 0) {
			var comPos = val.indexOf(deciSep);
			var int = val.substring(0,comPos);
			var dec = val.substring(comPos);
		} else{
			var int = val;
			var dec = "";
		}
		var ret = [val, pos];
		
		if (int.length > 3) {
			
			var newInt = "";
			var spaceIndex = int.length;
			
			while (spaceIndex > 3) {
				spaceIndex = spaceIndex - 3;
				newInt = thouSep+int.substring(spaceIndex,spaceIndex+3)+newInt;
				if (pos > spaceIndex) pos++;
			}
			ret = [int.substring(0,spaceIndex) + newInt + dec, pos];
		}
		return ret;
	}
	
	$(this).on('keyup', function(ev) {
		
		if (ev.which == 8) {
			// reformat the thousands after backspace keyup
			
			var value = this.value;
			var caretPos = this.selectionStart;
			
			caretPos = spaceCaretPos(value, caretPos);
			value = value.replace(thouReg, '');
			
			var newValues = spaceFormat(value, caretPos);
			this.value = newValues[0];
			this.selectionStart = newValues[1];
			this.selectionEnd   = newValues[1];
		}
	});
	
	if ((e.ctrlKey && (key == 65 || key == 67 || key == 86 || key == 88 || key == 89 || key == 90)) ||
	   (e.shiftKey && key == 9)) // You don't want to disable your shortcuts!
		prevDefault = false;
	
	if ((key < 37 || key > 40) && key != 8 && key != 9 && prevDefault) {
		e.preventDefault();
		
		if (!e.altKey && !e.shiftKey && !e.ctrlKey) {
		
			var value = this.value;
			if ((key > 95 && key < 106)||(key > 47 && key < 58) ||
			  (deciNumber > 0 && (key == 110 || key == 188 || key == 190))) {
				
				var keys = { // reformat the keyCode
          48: 0, 49: 1, 50: 2, 51: 3,  52: 4,  53: 5,  54: 6,  55: 7,  56: 8,  57: 9,
          96: 0, 97: 1, 98: 2, 99: 3, 100: 4, 101: 5, 102: 6, 103: 7, 104: 8, 105: 9,
          110: deciSep, 188: deciSep, 190: deciSep
				};
				
				var caretPos = this.selectionStart;
				var caretEnd = this.selectionEnd;
				
				if (caretPos != caretEnd) // remove selected text
				value = value.substring(0,caretPos) + value.substring(caretEnd);
				
				caretPos = spaceCaretPos(value, caretPos);
				
				value = value.replace(thouReg, '');
				
				var before = value.substring(0,caretPos);
				var after = value.substring(caretPos);
				var newPos = caretPos+1;
				
				if (keys[key] == deciSep && value.indexOf(deciSep) >= 0) {
					if (before.indexOf(deciSep) >= 0) newPos--;
					before = before.replace(deciReg, '');
					after = after.replace(deciReg, '');
				}
				var newValue = before + keys[key] + after;
				
				if (newValue.substring(0,1) == deciSep) {
					newValue = "0"+newValue;
					newPos++;
				}
				
				while (newValue.length > 1 && newValue.substring(0,1) == "0" && newValue.substring(1,2) != deciSep) {
					newValue = newValue.substring(1);
					newPos--;
				}
				
				if (newValue.indexOf(deciSep) >= 0) {
					var newLength = newValue.indexOf(deciSep)+deciNumber+1;
					if (newValue.length > newLength) {
					  newValue = newValue.substring(0,newLength);
					}
				}
				
				newValues = spaceFormat(newValue, newPos);
				
				this.value = newValues[0];
				this.selectionStart = newValues[1];
				this.selectionEnd   = newValues[1];
			}
		}
	}
	
	$(this).on('blur', function(e) {
		
		if (deciNumber > 0) {
			var value = this.value;
			
			var noDec = "";
			for (var i = 0; i < deciNumber; i++) noDec += "0";
			
			if (value == "0" + deciSep + noDec) {
        this.value = ""; //<-- put your default value here
      } else if(value.length > 0) {
				if (value.indexOf(deciSep) >= 0) {
					var newLength = value.indexOf(deciSep) + deciNumber + 1;
					if (value.length < newLength) {
					  while (value.length < newLength) value = value + "0";
					  this.value = value.substring(0,newLength);
					}
				}
				else this.value = value + deciSep + noDec;
			}
		}
	});
  }
});

$('.price > input:eq(0)').focus();
// end of currency input

$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<div class="col-md-2 mb-4 text-center"><div class="saved-image" style="background-image: url('+event.target.result+')"></div></div>')).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#image').on('change', function() {
        imagesPreview(this, 'div.row.wrapper-image');
    });
});


$(document).ready(function(){
	$(document).on('change', '#file', function(){
		var property = document.getElementById("file").files[0];
		var image_name = property.name;
		var image_extension = image_name.split(".").pop().toLowerCase();

		if(jQuery.inArray(image_extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
			alert("The file must be an image");
		}

		var image_size = property.size;

		if(image_size > 11864210) {
			alert("Image too large. Each image must be less than 10 megabytes.");
		} else {
			var form_data = new FormData();
			form_data.append("file", property);
			$.ajax({
				url: '/etiendahan/c8NLPYLt-functions/upload/',
				method: 'POST',
				data: form_data,
				contentType: false,
				cached: false,
				processData: false,
				success:function(data){
					$('#uploaded_image').html(data);
					$(document).ajaxStop(function() { location.reload(true); });
				}
			})
		}
	});
});

$(document).ready(function() {
    $('#button-save-new-product').bind("click",function() 
    { 
        var imgVal = $('#image').val(); 
        if(imgVal=='') 
        { 
            alert("Recommended to add image in your product"); 
            return false; 
        } 


    }); 
});
// ============ END OF SELLER CENTRE PAGE ============ 

// ============ AUTOCOMPLETE SEARCH ============ 

// $(document).ready(function($){
// 	$('#customerAutocomplte').keyup(function(){
// 		var query = $(this).val();
// 		if(query != '') {
// 			$.ajax({
// 				url: "suggest.php",
// 				method: "POST",
// 				data:{query:query},
// 				success:function(data) {
// 					$('.inner-recent').fadeIn();
// 					$('.inner-recent').html(data);
// 				}
// 			});
// 		}
// 	});
// });


$(document).ready(function($){
	$('#customerAutocomplete').autocomplete({
		source: "/etiendahan/suggest/", 
		highlight: true,
		minLength: 2
	});
});

$.ui.autocomplete.prototype._renderItem = function (ul, item) {
    item.label = item.label.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + $.ui.autocomplete.escapeRegex(this.term) + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<strong>$1</strong>");
    return $("<li class='li-item d-inline' style='z-index:999999 !important'></li>")
            .data("item.autocomplete", item)
            .append("<a href='/etiendahan/category/view/product/' class='search-item category-product-id' id='"+item.id+"'>" + item.label + "</a>")
            .appendTo(ul);
};
// ============ END OF AUTOCOMPLETE SEARCH ============ 

// administrator page

// target to give background to
if($("#admin-page").length > 0) {
	var $div = document.getElementById("gradient");
	// rgb vals of the gradients
	var gradients = [
	  { start: [128,179,171], stop: [30,41,58] },
	  { start: [255,207,160], stop: [234,92,68] },
	  { start: [212,121,121], stop: [130,105,151] }
	];
	// how long for each transition
	var transition_time = 5;

	// internal type vars
	var currentIndex = 0; // where we are in the gradients array
	var nextIndex = 1; // what index of the gradients array is next
	var steps_count = 0; // steps counter
	var steps_total = Math.round(transition_time*60); // total amount of steps
	var rgb_steps = {
	  start: [0,0,0],
	  stop: [0,0,0]
	}; // how much to alter each rgb value
	var rgb_values = {
	  start: [0,0,0],
	  stop: [0,0,0]
	}; // the current rgb values, gets altered by rgb steps on each interval
	var prefixes = ["-webkit-","-moz-","-o-","-ms-",""]; // for looping through adding styles
	var div_style = $div.style; // short cut to actually adding styles
	var color1, color2;

	// sets next current and next index of gradients array
	function set_next(num) {
	  return (num + 1 < gradients.length) ? num + 1 : 0;
	}

	// work out how big each rgb step is
	function calc_step_size(a,b) {
	  return (a - b) / steps_total;
	}

	// populate the rgb_values and rgb_steps objects
	function calc_steps() {
	  for (var key in rgb_values) {
	    if (rgb_values.hasOwnProperty(key)) {
	      for(var i = 0; i < 3; i++) {
	        rgb_values[key][i] = gradients[currentIndex][key][i];
	        rgb_steps[key][i] = calc_step_size(gradients[nextIndex][key][i],rgb_values[key][i]);
	      }
	    }
	  }
	}

	// update current rgb vals, update DOM element with new CSS background
	function updateGradient(){
	  // update the current rgb vals
	  for (var key in rgb_values) {
	    if (rgb_values.hasOwnProperty(key)) {
	      for(var i = 0; i < 3; i++) {
	        rgb_values[key][i] += rgb_steps[key][i];
	      }
	    }
	  }

	  // generate CSS rgb values
	  var t_color1 = "rgb("+(rgb_values.start[0] | 0)+","+(rgb_values.start[1] | 0)+","+(rgb_values.start[2] | 0)+")";
	  var t_color2 = "rgb("+(rgb_values.stop[0] | 0)+","+(rgb_values.stop[1] | 0)+","+(rgb_values.stop[2] | 0)+")";

	  // has anything changed on this interation
	  if (t_color1 != color1 || t_color2 != color2) {

	    // update cols strings
	    color1 = t_color1;
	    color2 = t_color2;

	    // update DOM element style attribute
	    div_style.backgroundImage = "-webkit-gradient(linear, left bottom, right top, from("+color1+"), to("+color2+"))";
	    for (var i = 0; i < 4; i++) {
	      div_style.backgroundImage = prefixes[i]+"linear-gradient(45deg, "+color1+", "+color2+")";
	    }
	  }

	  // we did another step
	  steps_count++;
	  // did we do too many steps?
	  if (steps_count > steps_total) {
	    // reset steps count
	    steps_count = 0;
	    // set new indexs
	    currentIndex = set_next(currentIndex);
	    nextIndex = set_next(nextIndex);
	    // calc steps
	    calc_steps();
	  }

	  if (div_style.backgroundImage.indexOf("gradient") != -1) {
	    window.requestAnimationFrame(updateGradient)
	  }
	}

	// initial step calc
	calc_steps();

	// go go go!
	window.requestAnimationFrame(updateGradient);
}