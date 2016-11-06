<?php

  /*
  **This php file includes the functions to remove
  **the wordpress version numbers to secure the site for hackers
  */
  require get_template_directory() . '/includes/admin/cleanup.php';

  if ( ! function_exists( 'freelance_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
    function freelance_setup() {
    	/*
    	 * Make theme available for translation.
    	 * Translations can be filed in the /languages/ directory.
    	 * If you're building a theme based on freelance, use a find and replace
    	 * to change 'freelance' to the name of your theme in all the template files.
    	 */
    	load_theme_textdomain( 'freelance', get_template_directory() . '/languages' );
    }
  endif;
  add_action( 'after_setup_theme', 'freelance_setup' );

  //Below are the required scripts which handles all the cpt's and the freelance admin page
	require get_template_directory() . '/includes/admin/admin-functions.php';
	require get_template_directory() . '/includes/admin/enqueue.php';
	require get_template_directory() . '/includes/admin/theme-support.php';
	require get_template_directory() . '/includes/admin/custom-post-type.php';
	require get_template_directory() . '/includes/admin/walker.php';
	require get_template_directory() . '/includes/admin/ajax.php';


  /**
   * Enqueue scripts and styles.
   */
  function freelance_scripts() {
  	wp_enqueue_style( 'freelance-style', get_stylesheet_uri() );

    wp_deregister_script('jquery');
    wp_register_script('jquery', get_stylesheet_directory_uri() . '/_build/js/min/jquery-3.1.1.min.js', false, '3.1.1', true);
    wp_enqueue_script('jquery');
    wp_register_script('freelance_initJS', get_template_directory_uri() . '/_build/js/min/init-min.js', array('jquery'),'1.0.0', true);
    wp_enqueue_script('freelance_initJS');
  }
  add_action( 'wp_enqueue_scripts', 'freelance_scripts' );


 //Register sidebar
 add_action( 'widgets_init', 'freelance_widgets_init' );
  function freelance_widgets_init() {
    register_sidebar( array(
      'name' => __( 'Aside Sidebar', 'aside-sidebar' ),
      'id' => 'sidebar-1',
      'description'   => __( 'A sidebar to have the product categories', 'theme-slug' ),
      'before_widget' => '<li id="%1$s" class="widget %2$s">',
    	'after_widget'  => '</li>',
    	'before_title'  => '<h2 class="widgettitle">',
    	'after_title'   => '</h2>',

    ) );
  }

  function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
  	$width = $size[0];

  	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

  	if ( 'page' === get_post_type() ) {
  		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
  	} else {
  		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
  		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
  	}

  	return $sizes;
  }
  add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

  /**
   * Add custom image sizes attribute to enhance responsive image functionality
   * for post thumbnails
   *
   * @since Twenty Sixteen 1.0
   *
   * @param array $attr Attributes for the image markup.
   * @param int   $attachment Image attachment ID.
   * @param array $size Registered image size or flat array of height and width dimensions.
   * @return string A source size value for use in a post thumbnail 'sizes' attribute.
   */
  function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
  	if ( 'post-thumbnail' === $size ) {
  		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
  		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
  	}
  	return $attr;
  }
  add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

  /**
   * Modifies tag cloud widget arguments to have all tags in the widget same font size.
   *
   * @since Twenty Sixteen 1.1
   *
   * @param array $args Arguments for tag cloud widget.
   * @return array A new modified arguments.
   */
  function twentysixteen_widget_tag_cloud_args( $args ) {
  	$args['largest'] = 1;
  	$args['smallest'] = 1;
  	$args['unit'] = 'em';
  	return $args;
  }
  add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );

  /**
  	* Converting the featured image into a url to be used as a background image, as well as if there are any attachments.
  */
function freelance_get_attachment( $num= 1){
	$output = ' ';
	if (has_post_thumbnail() && $num == 1):
		$output = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
		else:
		 	$attachments = get_posts( array(
				'post_type' 	=> 'attachment',
				'numberposts' 	=> $num,
				'post_parent' 	=> get_the_ID()
			) );
			if( $attachments && $num == 1):
				foreach ($attachments as $attachment) :
					$output= wp_get_attachment_url( $attachment->ID);
				endforeach;
				elseif( $attachments && $num > 1 ):
					$output = $attachments;
			endif;
			wp_reset_postdata();
	endif;

	return $output;
}

function freelance_set_post_views($postID) {
	$count_key = 'wpb_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
	    $count = 0;
	    delete_post_meta($postID, $count_key);
	    add_post_meta($postID, $count_key, '0');
	}else{
	    $count++;
	    update_post_meta($postID, $count_key, $count);
	}

}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

add_filter( 'jetpack_development_mode', '__return_true' );
