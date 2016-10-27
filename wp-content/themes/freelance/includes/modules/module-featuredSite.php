
<?php

/*---------     Services Custom WP_Query loop function    ----------*/

  global $post;

  $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
  $count = -1;
  $args = array(
    'post_type' 				        => 'websites',
    'tax_query'                 => array(
      array(
          'taxonomy'  => 'featured',
          'field'	    => 'slug',
          'terms'     => 'featured',
       ),
      ),
    'order_by'					        => 'menu_order',
    'order'						          => 'ASC',
    'update_post_term_cache' 	  => false,
    'posts_per_page' 			      => $count,
    'pagination'				        => false,
    'paged'						          => $paged,
  );
  $services = new WP_Query($args);

  if( $services->have_posts() ) : ?>
    <h1>Featured Site</h1>
    <div class="featured-wrapper">
      <?php
      while( $services->have_posts() ) : $services->the_post();
        $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 3000,1000 ), false, '' ); ?>
        <div class="icon">
          <div class="featured-image" style="background-image:url(<?php echo $src[0] ?>)">

          </div>
        </div>
        <div class="content-lockup">
          <p><?php the_content(); ?></p>
        </div>
        <div class="title">
          <h2><?php the_title();?></h2>
        </div>
      <?php
      endwhile; ?>
      <a href="<?php echo site_url('/portfolio'); ?>">See our other sites</a>
    </div>
  <?php endif;

  wp_reset_postdata();
