!function(){function e(){var e=$(".splash"),n=$(".splash").children("a");n.on("click",function(n){n.preventDefault(),e.fadeOut(500)})}function n(){var e=$(".post-share");e.hover(function(){window.console.log("hover"),$(this).find("#hidden").addClass("reveal")},function(){$(this).find("#hidden").removeClass("reveal")})}function a(){$(window).scroll(function(){$(this).scrollTop()>1?$("#main-nav").addClass("sticky"):$("nav").removeClass("sticky")})}function t(){var e=$("article:not(.reveal)"),n=0;setInterval(function(){if(n>=e.length)return!1;var a=e[n];$(a).addClass("reveal"),n++},200)}function o(){$("#freelance-ajax-load:not(.loading)").on("click",function(){var e=$(this),n=e.attr("data-page"),a=parseInt(n)+1,o=e.attr("data-url"),i=e.attr("data-prev"),r=e.attr("data-archive");"undefined"==typeof i&&(i=0),"undefined"==typeof r&&(r=0),e.addClass("loading").find(".freelance-ajax-text").slideUp("300"),setTimeout(function(){e.find(".freelance-loading-icon").addClass("spin")},300),$.ajax({url:o,type:"post",data:{page:n,prev:i,archive:r,action:"freelance_load_more"},error:function(e){window.console.log(e)},success:function(o){0==o?($(".freelance-posts-container").append('<div class="finished-posts" ><h3>You have reached the end of the line!</h3><p>There are no more posts to load.</p></div>'),e.slideUp(320)):setTimeout(function(){1==i?($(".freelance-posts-container").prepend(o),a=parseInt(n)-1):$(".freelance-posts-container").append(o),1==a?e.slideUp(320):(e.attr("data-page",a),e.removeClass("loading").find(".freelance-ajax-text").slideDown(300),e.find(".freelance-loading-icon").removeClass("spin")),t()},1e3)}})})}function i(){var e=0;$(window).scroll(function(){var n=$(window).scrollTop();Math.abs(n-e)>.1*$(window).height()&&(e=n,$(".page-limit").each(function(e){if(r($(this)))return history.replaceState(null,null,$(this).attr("data-page")),!0}))})}function r(e){var n=$(window).scrollTop(),a=$(window).height(),t=$(e).offset().top,o=$(e).height(),i=t+o;return i-.25*o>n&&t<n+.5*a}$(function(){e(),n(),a(),o(),t(),i()})}(jQuery);