(function(){
	$(function(){
		splash();
		postShare();
		stickyNav();
		ajaxLoadMore();
		revealPosts();
		scrollCheck();

  });

	function splash(){
		var $splash = $('.splash'),
			$splashAnchor = $('.splash').children('a');

		$splashAnchor.on('click', function(a){
			a.preventDefault();

			$splash.fadeOut(500);
		});
	}

	function postShare(){
		var $shareText = $('.post-share');
		$shareText.hover(function(){
			window.console.log('hover');
			$(this).find('#hidden').addClass('reveal');

		}, function(){
			$(this).find('#hidden').removeClass('reveal');
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

	/* Helper function for article animation */
	function revealPosts(){

		var $posts = $('article:not(.reveal)'),
			$i = 0 ;

		setInterval( function(){

			if( $i >= $posts.length ) {
				return false;
			}

			var $el = $posts[$i];
			$($el).addClass('reveal');
			$i++;

		}, 200 );

	}

	function ajaxLoadMore(){
		$('#freelance-ajax-load:not(.loading)').on('click', function(){

			var	$this = $(this),
				page = $this.attr('data-page'),
				$newPage = parseInt(page) + 1,
				$ajaxUrl = $this.attr('data-url'),
				$prev = $this.attr('data-prev'),
				archive = $this.attr('data-archive');

				if( typeof $prev === 'undefined' ){
					$prev = 0;
				}
				if( typeof archive === 'undefined' ){
					archive = 0;
				}
				$this.addClass('loading').find('.freelance-ajax-text').slideUp('300');
				setTimeout(function() {
					$this.find('.freelance-loading-icon').addClass('spin');
				}, 300 );

			$.ajax({

				url		: $ajaxUrl,
				type	: 'post',
				data	: {
					page	: page,
					prev	: $prev,
					archive : archive,
					action	: 'freelance_load_more'
				},
				error 	: function( response ){
					window.console.log( response );
				},
				success : function( response ){
					if( response == 0){
						$('.freelance-posts-container').append( '<div class="finished-posts" ><h3>You have reached the end of the line!</h3><p>There are no more posts to load.</p></div>' );
							$this.slideUp(320);
						}else{

						setTimeout( function(){

							if( $prev == 1 ){
								$('.freelance-posts-container').prepend( response );
								$newPage = parseInt(page) - 1;
							} else {
								$('.freelance-posts-container').append( response );
							}
							if ( $newPage == 1 ){
								$this.slideUp(320);
							}else{
								$this.attr('data-page', $newPage);
								$this.removeClass('loading').find('.freelance-ajax-text').slideDown(300);
								$this.find('.freelance-loading-icon').removeClass('spin');
							}

							revealPosts();

						}, 1000 );
					}
				}
			});
		});
	}

	//This function is used to change the url when a user clicks on load more and scrolls onto the section
	function scrollCheck(){

		var $lastScroll = 0;

		$(window).scroll( function(){

			var $scroll = $(window).scrollTop();

			if( Math.abs( $scroll - $lastScroll ) > $(window).height() * 0.1 ){

				$lastScroll = $scroll;

				$('.page-limit').each( function( index ){

					if( isVisible( $(this) ) ){

						history.replaceState( null, null, $(this).attr('data-page') );
						return (true);

					}
				} );
			}
		});
	}

	//Detect if element is in 25% of the window
	function isVisible( element ){

		var $scrollPosition = $(window).scrollTop(),
			$windowHeight 	= $(window).height(),
			$elementTop 	= $(element).offset().top,
			$elementHeight 	= $(element).height(),
			$elementBottom 	= $elementTop + $elementHeight;

		return ( ($elementBottom - $elementHeight * 0.25 > $scrollPosition) && ($elementTop  < ($scrollPosition + 0.5 * $windowHeight ) ) );

	}



}) (jQuery);
