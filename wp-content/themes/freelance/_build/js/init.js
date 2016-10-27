(function(){
	$(function(){
		splash();
		stickyNav();
  });

	function splash(){
		var $splash = $('.splash'),
				$splashAnchor = $('.splash').children('a');

		$splashAnchor.on('click', function(a){
			a.preventDefault();

			$splash.fadeOut(500);
		});
	}

	function stickyNav(){

	$(window).scroll(function() {
		if ($(this).scrollTop() > 1){
				$('#main-nav').addClass("sticky");
			}
		else{
			$('nav').removeClass("sticky");
		}
	});

}
}) (jQuery);
