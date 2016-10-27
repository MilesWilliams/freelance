
<?php

/*---------     Services Custom WP_Query loop function    ----------*/

  global $post;

  $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
  $count = -1;
  $args = array(
    'post_type' 				        => 'services',
    'order_by'					        => 'menu_order',
    'order'						          => 'ASC',
    'update_post_term_cache' 	  => false,
    'posts_per_page' 			      => $count,
    'pagination'				        => false,
    'paged'						          => $paged,
  );
  $services = new WP_Query($args);

  if( $services->have_posts() ) : ?>
    <div class="services-wrapper">
      <ul>
        <?php
        while( $services->have_posts() ) : $services->the_post();
          $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600, 1000), false, ""); ?>
          <li>
            <div>
              <div class="icon <?php the_title();?>" style="background: url(<?php echo $src[0]; ?>) no-repeat center"></div>
            </div>
            <div class="content-lockup">
              <div class="title">
                <h2><?php the_title();?></h2>
              </div>
              <p><?php the_content(); ?></p>
            </div>
          </li>
        <?php
        endwhile; ?>
      </ul>
    </div>
  <?php endif;

  wp_reset_postdata();
