<?php

/*

@package Freelance

    ==============================
        Latest Posts Module
    ==============================
*/



	 // The query arguments
	  $args = array(
	    'post_type' 		=> 'post',
		'post_status'		=> 'published',
	    'order'             => 'DEC',
	    'posts_per_page' 	=> 3,
	  );
	 // Create the related query
	 $rel_query = new WP_Query( $args );

	 // Check if there is any related posts
	 if( $rel_query->have_posts() ) :
	 ?>
		<h1 class="latestPost-heading">Latest from the blog</h1>
		<div id="latest-posts" class="post-wrapper">
			<ul>
				<?php
		 	// The Loop
		 		while ( $rel_query->have_posts() ) :
		    	$rel_query->the_post();
		 			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 3000,1000 ), false, '' );
					?>

		    		<li class="single-post pos">
						<div class="post-image" style="background-image: url(<?php echo $thumb[0]; ?>)"></div>
						<div class="post-info">
							<p><?php  echo freelance_posted_meta(); ?></p>
							<h2 class="entry-title"><?php the_title(); ?></h2>
							<?php the_excerpt(); ?>
						</div>
						<div class="category-wrapper">
							<?php
							$output = '';
								foreach (get_the_category() as $category) {
									$category_id = get_cat_ID( $category->cat_name );
									$category_link = get_category_link( $category_id );
									$output .= '<span class="cat"><a href="'.$category_link.'">'.$category->cat_name.'</a></span>';
								}
								echo $output;
							?>
						</div>
						<div class="post-meta">
							<?php echo freelance_posted_footer(); ?>
							<div class="post-share">
								<?php get_template_part('/includes/modules/module', 'socialShare'); ?>
							</div>
						</div>
			    	</li>

					<?php
		 		endwhile;
					?>
		 	</ul><!-- .group -->
		</div><!-- #related -->
	 <?php
	 endif;

	 // Reset the query
		wp_reset_query();
