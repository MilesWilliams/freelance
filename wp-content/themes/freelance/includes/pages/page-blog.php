<?php
/*

@package freelance

    ==============================
        Theme Blog Page
    ==============================
*/
?>
<section class="blog">
	<?php if ( is_paged() ){ ?>
		<div class="button-container load-previous">
			<a id="freelance-ajax-load" class="btn-load" data-prev="1" data-page="<?php echo freelance_check_paged(1); ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
				<span class="freelance-loading-icon"></span>
				<span class="freelance-ajax-text">Load Previous</span>
			</a>
		</div>
	<?php } ?>
	<div class="freelance-posts-container">

		<?php // Display blog posts @ http://blog:8888/blog
		  global $post;

		  $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		  $count = 2;
		  $args = array(
		    'post_type' 		=> 'post',
			'post_status'		=> 'published',
		    'order'             => 'DEC',
		    'posts_per_page' 	=> $count,
			'paged'				=> $paged,
		  );
		  $blogPosts = new WP_Query($args);
		if( $blogPosts->have_posts() ): ?>
			<div class="page-limit" data-page="/blog<?php $_SERVER["REQUEST_URI"] .  freelance_check_paged(1); ?>/">
				<?php while ($blogPosts->have_posts()) : $blogPosts->the_post();
					//$class = 'reveal';
					//set_query_var( 'post-class', $class );
					get_template_part('includes/post-format/content', get_post_format() );

				endwhile; ?>
			</div>
		<?php endif;
		wp_reset_postdata(); ?>
	</div>
	<div class="button-container">
		<a id="freelance-ajax-load" class="btn-load" data-page="<?php echo freelance_check_paged(1); ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
			<span class="freelance-loading-icon"></span>
			<span class="freelance-ajax-text">Load More</span>
		</a>
	</div>
</section>
<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<aside id="sidebar">
		<ul>
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</ul>
	</aside>
<?php endif; ?>
