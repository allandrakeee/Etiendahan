/*------------------------------------------------------
    Author : www.webthemez.com
    License: Commons Attribution 3.0
    http://creativecommons.org/licenses/by/3.0/
---------------------------------------------------------  */

(function ($) {
    "use strict";
    var mainApp = {

        initFunction: function () {
            /*MENU 
            ------------------------------------*/
            $('#main-menu').metisMenu();
			
            $(window).bind("load resize", function () {
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });

            /* MORRIS BAR CHART
			-----------------------------------------*/
  //           Morris.Bar({
  //               element: 'morris-bar-chart',
  //               data: [{
  //                   y: '2006',
  //                   a: 100,
  //                   b: 90
  //               }, {
  //                   y: '2007',
  //                   a: 75,
  //                   b: 65
  //               }, {
  //                   y: '2008',
  //                   a: 50,
  //                   b: 40
  //               }, {
  //                   y: '2009',
  //                   a: 75,
  //                   b: 65
  //               }, {
  //                   y: '2010',
  //                   a: 50,
  //                   b: 40
  //               }, {
  //                   y: '2011',
  //                   a: 75,
  //                   b: 65
  //               }, {
  //                   y: '2012',
  //                   a: 100,
  //                   b: 90
  //               }],
  //               xkey: 'y',
  //               ykeys: ['a', 'b'],
  //               labels: ['Series A', 'Series B'],
		// 		 barColors: [
  //   '#e96562','#414e63',
  //   '#A8E9DC' 
  // ],
  //               hideHover: 'auto',
  //               resize: true
  //           });
	 


            /* MORRIS DONUT CHART
			----------------------------------------*/
  //           Morris.Donut({
  //               element: 'morris-donut-chart',
  //               data: [{
  //                   label: "Profits",
  //                   value: 12
  //               }, {
  //                   label: "Users",
  //                   value: 30
  //               }, {
  //                   label: "Total Sales",
  //                   value: 20
  //               }],
		// 		   colors: [
  //   '#A6A6A6','#414e63',
  //   '#e96562' 
  // ],
  //               resize: true
  //           });

            /* MORRIS AREA CHART
			----------------------------------------*/

      //       Morris.Area({
      //           element: 'morris-area-chart',
      //           data: [{
      //               period: '2010 Q1',
      //               iphone: 2666,
      //               ipad: null,
      //               itouch: 2647
      //           }, {
      //               period: '2010 Q2',
      //               iphone: 2778,
      //               ipad: 2294,
      //               itouch: 2441
      //           }, {
      //               period: '2010 Q3',
      //               iphone: 4912,
      //               ipad: 1969,
      //               itouch: 2501
      //           }, {
      //               period: '2010 Q4',
      //               iphone: 3767,
      //               ipad: 3597,
      //               itouch: 5689
      //           }, {
      //               period: '2011 Q1',
      //               iphone: 6810,
      //               ipad: 1914,
      //               itouch: 2293
      //           }, {
      //               period: '2011 Q2',
      //               iphone: 5670,
      //               ipad: 4293,
      //               itouch: 1881
      //           }, {
      //               period: '2011 Q3',
      //               iphone: 4820,
      //               ipad: 3795,
      //               itouch: 1588
      //           }, {
      //               period: '2011 Q4',
      //               iphone: 15073,
      //               ipad: 5967,
      //               itouch: 5175
      //           }, {
      //               period: '2012 Q1',
      //               iphone: 10687,
      //               ipad: 4460,
      //               itouch: 2028
      //           }, {
      //               period: '2012 Q2',
      //               iphone: 8432,
      //               ipad: 5713,
      //               itouch: 1791
      //           }],
      //           xkey: 'period',
      //           ykeys: ['iphone', 'ipad', 'itouch'],
      //           labels: ['iPhone', 'iPad', 'iPod Touch'],
      //           pointSize: 2,
      //           hideHover: 'auto',
				  // pointFillColors:['#ffffff'],
				  // pointStrokeColors: ['black'],
				  // lineColors:['#A6A6A6','#414e63'],
      //           resize: true
      //       });

            /* MORRIS LINE CHART
			----------------------------------------*/
    //         Morris.Line({
    //             element: 'morris-line-chart',
    //             data: [
				// 	  { y: '2014', a: 50, b: 90},
				// 	  { y: '2015', a: 165,  b: 185},
				// 	  { y: '2016', a: 150,  b: 130},
				// 	  { y: '2017', a: 175,  b: 160},
				// 	  { y: '2018', a: 80,  b: 65},
				// 	  { y: '2019', a: 90,  b: 70},
				// 	  { y: '2020', a: 100, b: 125},
				// 	  { y: '2021', a: 155, b: 175},
				// 	  { y: '2022', a: 80, b: 85},
				// 	  { y: '2023', a: 145, b: 155},
				// 	  { y: '2024', a: 160, b: 195}
				// ],
            
				 
      // xkey: 'y',
      // ykeys: ['a', 'b'],
      // labels: ['Total Income', 'Total Outcome'],
      // fillOpacity: 0.6,
      // hideHover: 'auto',
      // behaveLikeLine: true,
      // resize: true,
      // pointFillColors:['#ffffff'],
      // pointStrokeColors: ['black'],
      // lineColors:['gray','#414e63']
	  
      //       });
           
        
            $('.bar-chart').cssCharts({type:"bar"});
            $('.donut-chart').cssCharts({type:"donut"}).trigger('show-donut-chart');
            $('.line-chart').cssCharts({type:"line"});

            $('.pie-thychart').cssCharts({type:"pie"});
       
	 
        },

        initialization: function () {
            mainApp.initFunction();

        }

    }
    // Initializing ///

    $(document).ready(function () {
		$(".dropdown-button").dropdown();
		$("#sideNav").click(function(){
			if($(this).hasClass('closed')){
				$('.navbar-side').animate({left: '0px'});
				$(this).removeClass('closed');
				$('#page-wrapper').animate({'margin-left' : '260px'});
				
			}
			else{
			    $(this).addClass('closed');
				$('.navbar-side').animate({left: '-260px'});
				$('#page-wrapper').animate({'margin-left' : '0px'}); 
			}
		});
		
        mainApp.initFunction(); 
    });

	$(".dropdown-button").dropdown();
	
}(jQuery));


$(document).on('click', '.action-slides', function(){
    var slide_id = $(this).attr('id');
    // alert(slide_id);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"slide_id": slide_id});
});

$(document).on('click', '.action-categories', function(){
    var parent_category_id = $(this).attr('id');
    // alert(parent_category_id);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"parent_category_id": parent_category_id});
});

$(document).on('click', '.delete-sub-category', function(){
    var delete_sub_category = $(this).attr('id');
    // alert(delete_sub_category);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"delete_sub_category": delete_sub_category});
});

$(document).on('click', '.action-banned-customer', function(){
    var banned_customer_id = $(this).attr('id');
    // alert(banned_customer_id);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"banned_customer_id": banned_customer_id});
});

$(document).on('click', '.action-report-review', function(){
    var review_go_to_message = $(this).attr('id');
    // alert(review_go_to_message);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"review_go_to_message": review_go_to_message});
});

$(document).on('click', '.action-sic', function(){
    var action_sic = $(this).attr('id');
    // alert(action_sic);
    $.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"action_sic": action_sic});
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


$(function () {
    $("#btnAdd").bind("click", function () {
        var div = $("<tr />");
        div.html(GetDynamicTextBox(""));
        $(".form-group.dynamic").append(div);
    });
    $("body").on("click", ".remove", function () {
        $(this).closest("tr").remove();
    });
});
function GetDynamicTextBox(value) {
    return '<td><input name = "sub_category[]" type="text" value = "" class="form-control" style="width: 475px;"></td>' + '<td><button type="button" class="btn btn-danger remove" style="position: relative;bottom: 8px;left: 5px;"><i class="fa fa-times"></i></button></td>'
}

$('table#incidents').each(function() {
    if($(this).find('tr').children("td").length < 1) {
        $(this).hide();
        $('<p>No Products Yet</p>').appendTo('#page-inner');
    }
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

$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: false // Close upon selecting a date,
  });