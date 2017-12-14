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