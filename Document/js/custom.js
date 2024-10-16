/* =================================
===  OPEN SIDE NAV ==
=================================== */

/* $(document).ready(function () {
	$('#sidebarCollapse').on('click', function () {
		 $('#nevbarleft').toggleClass('active');
	});
}); */
$(document).ready(function () {
	 $('#sidebarCollapse').on('click', function () {
		 $('#nevbarleft').toggleClass('active');
		 $(this).toggleClass('active');
	 });
 });
/* =================================
===  DOWNLOAD BUTTON CLICK SCROLL ==
=================================== */
jQuery(function( $ ){
	$('#download-button, #download-button2, #download-button3, .topbutton').localScroll({
		duration:1000
	});
});
/* =================================
===  SMOOTH SCROLL             ====
=================================== */
var scrollAnimationTime = 1200,
    scrollAnimation = 'easeInOutExpo';
$('a.scrollto').bind('click.smoothscroll', function (event) {
    event.preventDefault();
    var target = this.hash;
    $('html, body').stop().animate({
        'scrollTop': $(target).offset().top
    }, scrollAnimationTime, scrollAnimation, function () {
        window.location.hash = target;
    });
});

/* =================================
===  Bootstrap Internet Explorer 10 in Windows 8 and Windows Phone 8 FIX
=================================== */
if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
  var msViewportStyle = document.createElement('style')
  msViewportStyle.appendChild(
    document.createTextNode(
      '@-ms-viewport{width:auto!important}'
    )
  )
  document.querySelector('head').appendChild(msViewportStyle)
}