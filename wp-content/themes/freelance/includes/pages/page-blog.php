<section>


		<?php // Display blog posts on any page @ http://blog:8888/blog
		 get_search_form();
		$temp = $wp_query; $wp_query= null;
		$wp_query = new WP_Query(); $wp_query->query('showposts=5' . '&paged='.$paged);
		while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<article>
		<div class="post-image"><?php the_post_thumbnail(); ?></div>
		<div class="meta-content">
			<p>
				<?php  the_author(); ?><span>/</span> <?php echo get_the_date('F j Y'); ?>
			</p>
		</div>
		<h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
		<?php the_excerpt(); ?>
		<div class="post-tags">
			<?php $tags = get_the_tags();
				foreach ($tags as $tag) { ?>
					<span><?php echo $tag->name; ?></span>
				<?php }

			?>
			<?php  get_the_tags(); ?>
		</div>
		<div class="social-stats">
			<div class="like-stats">

			</div>
			<div class="comment-stats">
				<?php get_template_part('_build/icons/comment') . comments_number( '0', '1', '%' );?>
			</div>
		</div>
		</article>
		<?php endwhile; ?>


		<?php if ($paged > 1) { ?>

		<nav id="nav-posts">
			<div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
			<div class="next"><?php previous_posts_link('Newer Posts &raquo;'); ?></div>
		</nav>

		<?php } else { ?>

		<nav id="nav-posts">
			<div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
		</nav>

		<?php } ?>

		<?php wp_reset_postdata(); ?>
	</section>
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<aside id="sidebar">
			<ul>
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</ul>
		</aside>
	<?php endif; ?>
