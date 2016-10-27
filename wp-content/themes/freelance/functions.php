<?php

  /**
  	* Woocommerce theme support declaration
  */
  add_action( 'after_setup_theme', 'woocommerce_support' );

  function woocommerce_support() {
    add_theme_support( 'woocommerce' );
  }

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

    	// Add default posts and comments RSS feed links to head.
    	add_theme_support( 'automatic-feed-links' );

    	/*
    	 * Let WordPress manage the document title.
    	 * By adding theme support, we declare that this theme does not use a
    	 * hard-coded <title> tag in the document head, and expect WordPress to
    	 * provide it for us.
    	 */
    	add_theme_support( 'title-tag' );

    	/*
    	 * Enable support for Post Thumbnails on posts and pages.
    	 *
    	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
    	 */
    	add_theme_support( 'post-thumbnails' );

    	// This theme uses wp_nav_menu() in one location.
    	register_nav_menus( array(
    		'primary' => esc_html__( 'Primary', 'freelance' ),
    	) );

    	register_nav_menus( array(
    		'secondary' => esc_html__( 'Footer', 'freelance' ),
    	) );
      register_nav_menus( array(
        'megaMenu' => esc_html__( 'Mega Menu', 'freelance'),
      ) );

    	/*
    	 * Switch default core markup for search form, comment form, and comments
    	 * to output valid HTML5.
    	 */
    	add_theme_support( 'html5', array(
    		'search-form',
    		'comment-form',
    		'comment-list',
    		'gallery',
    		'caption',
    	) );

      add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'status',
        'audio',
        'chat',
      ) );

      add_theme_support( 'custom-logo', array(
      	'height'      => 50,
      	'width'       => 100,
      	'flex-height' => false,
      	'flex-width'  => false,
      	'header-text' => array( 'freelance', 'A responsive ecommerce site' ),
      ) );

    /* Added Header theme support for the customizer*/
    add_theme_support( 'custom-background' );

    function custom_background_size( $wp_customize ) {

    	// Add the "panel" (Section).
    	// If this section already exists, comment the next 3 lines out.
    	$wp_customize->add_section( 'theme_settings', array(
    		'title' => __( 'Theme Settings' ),
    	) );

    	// If they haven't set the background image, don't show these controls.
    	if ( ! get_theme_mod( 'background_image' ) ) {
    		return;
    	}

    	// Add your setting.
    	$wp_customize->add_setting( 'default-size', array(
    		'default' => 'inherit',
    	) );

    	// Add your control box.
    	$wp_customize->add_control( 'default-size', array(
    		'label'      => __( 'Background Image Size' ),
    		'section'    => 'theme_settings',
    		'settings'   => 'default-size',
    		'priority'   => 200,
    		'type' => 'radio',
    		'choices' => array(
    			'cover' => __( 'Cover' ),
    			'contain' => __( 'Contain' ),
    			'inherit' => __( 'Inherit' ),
    		)
    	) );
    }

    add_action( 'customize_register', 'custom_background_size' );

    function custom_background_size_css() {
    	$background_size = get_theme_mod( 'default-size', 'inherit' );
    	echo '<style> body.custom-background { background-size: '.$background_size.'; } </style>';
    }

    add_action( 'wp_head', 'custom_background_size_css', 999 );


    /* Customizer theme header fallback for older wordpress versions */
      global $wp_version;

      if ( version_compare( $wp_version, '3.4', '>=' ) ) :
      	add_theme_support( 'custom-header' );
      else :
      	add_custom_image_header( $wp_head_callback, $admin_head_callback );
      endif;

    	// Set up the WordPress core custom background feature.
    	add_theme_support( 'custom-background', apply_filters( 'freelance_custom_background_args', array(
    		'default-color' => 'ffffff',
    		'default-image' => '',
    	) ) );
    }
  endif;
  add_action( 'after_setup_theme', 'freelance_setup' );

  //Below required script enqueues the admin document which handles all the cpt's
  require get_template_directory() . '/includes/admin/admin-functions.php';

  /**
   * Enqueue scripts and styles.
   */
  function freelance_scripts() {
  	wp_enqueue_style( 'freelance-style', get_stylesheet_uri() );
  	wp_register_script('freelance_initJS', get_template_directory_uri() . '/_build/js/min/init-min.js', array('jquery'),'1.0.0', true);
  	wp_enqueue_script('freelance_initJS');
    wp_register_script('freelance_jquery', get_stylesheet_directory_uri() . '/_build/js/min/jquery-3.1.1.min.js', array(),'', false);
    wp_enqueue_script('freelance_jquery');
  }
  add_action( 'wp_enqueue_scripts', 'freelance_scripts' );


 //Register sidebar
 add_action( 'widgets_init', 'freelance_widgets_init' );
  function freelance_widgets_init() {
    register_sidebar( array(
      'name' => __( 'Aside Sidebar', 'aside-sidebar' ),
      'id' => 'sidebar-1',
      'description' => __( 'A sidebar to have the product categories', 'theme-slug' ),
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
