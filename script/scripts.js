$(function() {
	
	$('.slide-out-tab-left').tabSlideOut({
        tabHandle: '.handle',                     //class of the element that will become your tab
        pathToTabImage: '/design/shopnow-tab.png', //path to the image for the tab //Optionally can be set using css
        imageHeight: '128px',                     //height of tab image           //Optionally can be set using css
        imageWidth: '128px',                       //width of tab image            //Optionally can be set using css
        tabLocation: 'left',                      //side of screen where tab lives, top, right, bottom, or left
        speed: 300,                               //speed of animation
        action: 'click',                          //options: 'click' or 'hover', action to trigger animation
        topPos: '200px',                          //position from the top/ use if tabLocation is left or right
        leftPos: '20px',                          //position from left/ use if tabLocation is bottom or top
        fixedPosition: true                      //options: true makes it stick(fixed position) on scroll
    });
	
});

var hashtag = {
	togo: function(id) {
		$('html, body').animate({
			scrollTop: $('#' + id).offset().top - 300
		}, 200);
	}
}