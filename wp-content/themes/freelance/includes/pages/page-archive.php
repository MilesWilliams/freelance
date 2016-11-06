<?php
/*

@package freelance

    ==============================
        Theme Archive Page
    ==============================
*/
?>
<section class="blog">
	<header class="archive-header">
		<?php the_archive_title('<h1>','</h1>');  ?>
	</header>
	<?php if ( is_paged() ){ ?>
		<div class="button-container load-previous">
			<a id="freelance-ajax-load" class="btn-load" data-prev="1" data-archive="<?php echo  $_SERVER["REQUEST_URI"]; ?>" data-page="<?php echo freelance_check_paged(1); ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
				<span class="freelance-loading-icon"></span>
				<span class="freelance-ajax-text">Load Previous</span>
			</a>
		</div>
	<?php } ?>
	<div class="freelance-posts-container">
			<?php echo '<div class="page-limit archive" data-page="'. $_SERVER["REQUEST_URI"] .'">'; ?>
				<?php while (have_posts()) : the_post();
					//$class = 'reveal';
					//set_query_var( 'post-class', $class );
					get_template_part('includes/post-format/content', get_post_format() );

				endwhile; ?>
			</div>
	</div>
	<div class="button-container">
		<a id="freelance-ajax-load" class="btn-load" data-page="<?php echo freelance_check_paged(1); ?>" data-archive="<?php echo  $_SERVER["REQUEST_URI"]; ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
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
