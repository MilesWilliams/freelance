<?php
/*

@package freelance

    ==============================
        Theme Custom Post Types
    ==============================
*/

$contact = get_option('activate_contact');
if(@$contact == 1){

  add_action('init', 'contact_form_custom_post_type');

  add_filter( 'manage_freelance-contact_posts_columns', 'freelance_set_contact_columns' );
  add_action( 'manage_freelance-contact_posts_custom_column', 'freelance_contact_custom_column', 10, 2 );
  add_action('add_meta_boxes', 'freelance_contact_add_metabox');
  add_action('save_post', 'freelance_save_email_data');
}

/* Contact Custom Post Type */
function contact_form_custom_post_type(){
  $labels = array(
    'name'            => 'Messages',
    'singular_name'   => 'Message',
    'menu_name'       => 'Messages',
    'name_admin_bar'  => 'Message'
  );

  $args = array(
    'labels'          => $labels,
    'show_ui'         => true,
    'show_in_menu'    => true,
    'capability_type' => 'post',
    'hierarchical'    => false,
    'menu_position'   => 26,
    'menu_icon'       => 'dashicons-email-alt',
    'supports'        => array('title','editor','author')
  );

  register_post_type('freelance-contact', $args);
}

function freelance_set_contact_columns( $columns ){
  $newColumns = array();
  $newColumns['title'] = 'Full Name';
  $newColumns['message'] = 'Message';
  $newColumns['email'] = 'Email';
  $newColumns['date'] = 'Date';
  return $newColumns;
}

function freelance_contact_custom_column( $column, $post_id ){
  switch( $column ){

    case'message' :
      echo get_the_excerpt();
      break;

    case 'email' :
    $email = get_post_meta($post_id, '_contact_email_value_key', true);
      echo '<a href="mailto:'.$email.'" >'.$email.'</a>';
      break;
  }
}

/* Contact Custom Post Type Metabox  */

function freelance_contact_add_metabox(){
  add_meta_box('contact_email', 'User Email', 'freelance_contact_email_callback', 'freelance-contact', 'side', 'high');
}

function freelance_contact_email_callback( $post ){
  wp_nonce_field('freelance_save_email_data', 'freelance_contact_email_meta_box_nonce');

  $value = get_post_meta($post->ID, '_contact_email_value_key', true);

  echo '<label for="freelance_contact_email_field">User Email Address: </label>';
  echo '<input type="email" id="freelance_contact_email_field" name="freelance_contact_email_field" value="'.esc_attr($value).'" size="25"/>';

}

function freelance_save_email_data($post_id){
  if (! isset( $_POST['freelance_contact_email_meta_box_nonce'] ) ){
    return;
  }
  if ( ! wp_verify_nonce( $_POST['freelance_contact_email_meta_box_nonce'], 'freelance_save_email_data'  )){
    return;
  }

  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
    return;
  }

  if ( ! current_user_can('edit_post', $post_id) ){
    return;
  }

  if (! isset( $_POST['freelance_contact_email_field'] ) ){
    return;
  }

  $email_data = sanitize_text_field($_POST['freelance_contact_email_field'] );

  update_post_meta( $post_id, '_contact_email_value_key', $email_data );
}

/*-----------     Shops Custom Post Type     -----------*/

function servicesCustomPostType(){

	$singular 	= 'Service';
	$plural 	= 'Services';
	$labels 	= array(
		'name' 					      => $plural,
		'singular_name' 		  => $singular,
		'add_name' 			  	  => 'Add New',
		'add_new_item' 			  => 'Add New ' . $singular,
		'edit' 					      => 'Edit',
		'edit_item'				    => 'Edit ' . $singular,
		'new_item'				    => 'New ' . $singular,
		'view'					      => 'View ' . $singular,
		'view_item'				    => 'View ' . $singular,
		'search_item'			    => 'Search ' . $plural,
		'parent'				      => 'Parent ' . $singular,
		'not_found' 			    => 'No ' . $plural . ' found',
		'not_found_in_trash'  => 'No ' . $plural . ' in Trash',
	);
	$args = array(
		'labels'			 	         => $labels,
		'public' 				         => true,
		'public_queryable' 	  	 => true,
		'exclude_from_search' 	 => false,
		'show_in_nav_menus' 	   => true,
		'show_in_ui' 			       => true,
		// 'show_in_menu' 			     => 'ffreelance_menu',
		'show_in_admin_bar' 	   => true,
		'menu_icon' 			       => 'dashicons-store',
		'can_export' 			       => true,
		'delete_with_user' 		   => false,
		'hierarchical' 			     => false,
		'query_var' 			       => true,
		'capability_type' 		   => 'page',
		'map_meta_cap' 			     => true,
		// 'capabilities' => array(),
		'rewrite' 				       => array(
			'slug' 				         => 'services',
			'with_front' 		       => true,
			'pages' 			         => true,
			'feeds' 			         => true,
			),
		'supports' 				       => array(
		  'title',
			'editor',
			'custom_fields',
			'thumbnail',
			'post-formats',
		)
	);
	register_post_type('services', $args);
}
add_action('init', 'servicesCustomPostType');


/*-----------     Shops Custom Post Type     -----------*/

function websiteCustomPostType(){

	$singular 	= 'Website';
	$plural 	= 'Websites';
	$labels 	= array(
		'name' 					      => $plural,
		'singular_name' 		  => $singular,
		'add_name' 			  	  => 'Add New',
		'add_new_item' 			  => 'Add New ' . $singular,
		'edit' 					      => 'Edit',
		'edit_item'				    => 'Edit ' . $singular,
		'new_item'				    => 'New ' . $singular,
		'view'					      => 'View ' . $singular,
		'view_item'				    => 'View ' . $singular,
		'search_item'			    => 'Search ' . $plural,
		'parent'				      => 'Parent ' . $singular,
		'not_found' 			    => 'No ' . $plural . ' found',
		'not_found_in_trash'  => 'No ' . $plural . ' in Trash',
	);
	$args = array(
		'labels'			 	         => $labels,
		'public' 				         => true,
		'public_queryable' 	  	 => true,
		'exclude_from_search' 	 => false,
		'show_in_nav_menus' 	   => true,
		'show_in_ui' 			       => true,
		// 'show_in_menu' 			     => 'ffreelance_menu',
		'show_in_admin_bar' 	   => true,
		'menu_icon' 			       => 'dashicons-store',
		'can_export' 			       => true,
		'delete_with_user' 		   => false,
		'hierarchical' 			     => false,
		'query_var' 			       => true,
		'capability_type' 		   => 'page',
		'map_meta_cap' 			     => true,
		// 'capabilities' => array(),
		'rewrite' 				       => array(
			'slug' 				         => 'websites',
			'with_front' 		       => true,
			'pages' 			         => true,
			'feeds' 			         => true,
			),
		'supports' 				       => array(
		  'title',
			'editor',
			'custom_fields',
			'thumbnail',
			'post-formats',
		)
	);
	register_post_type('websites', $args);
}
add_action('init', 'websiteCustomPostType');

/*-----------     Featured Website Custom Taxonomies     -----------*/

function featuredWebsiteTaxonomy(){
	$singular 	= 'Taxonomy';
	$plural 		= 'Taxonomies';
	$labels 		= array(
		'name' 											=> $plural,
		'singular_name' 						=> $singular,
		'search_items'							=> 'Search ' . $plural,
		'popular_items'							=> 'Popular ' . $plural,
		'all_items'									=> 'All ' . $plural,
		'parent_item'								=> 'Parent Field',
		'parent_item_colon'					=> 'Parent Field:',
		'edit_item'									=> 'Edit ' . $singular,
		'update_item'								=> 'Update ' . $singular,
		'add_new_item' 							=> 'Add New ' . $singular .' Name',
		'new_item_name'							=> 'New ' . $singular,
		'seperate_items_with_comas' => 'Seperate ' . $plural . ' with commas',
		'add_or_remove_items' 			=> 'Add or remove ' . $plural,
		'choose_from_most_used' 		=> 'Choose from the most used' . $plural,
		'not_found' 								=> 'No ' . $plural . ' found',
		'menu_name'									=> $plural,
	);
	$args = array(
			'hierarchical'      	=> true,
			'labels'            	=> $labels,
			'show_ui'           	=> true,
			'show_admin_column' 	=> true,
			'query_var'        		=> true,
			'public'							=> false,
			'capability_type' 		=> 'page',
			'capabilities' 				=> array(
				'manage_terms',
				),
			'rewrite' 						=> array(
				'slug' 							=> 'featured'
			),
	);
	register_taxonomy( 'featured', array('websites'), $args );
}
add_action('init', 'featuredWebsiteTaxonomy');

/*-----------     Featured Website Custom Taxonomies     -----------*/

function tagsTaxonomy(){
	$singular 	= 'Tag';
	$plural 		= 'Tags';
	$labels 		= array(
		'name' 											=> $plural,
		'singular_name' 						=> $singular,
		'search_items'							=> 'Search ' . $plural,
		'popular_items'							=> 'Popular ' . $plural,
		'all_items'									=> 'All ' . $plural,
		'parent_item'								=> 'Parent Field',
		'parent_item_colon'					=> 'Parent Field:',
		'edit_item'									=> 'Edit ' . $singular,
		'update_item'								=> 'Update ' . $singular,
		'add_new_item' 							=> 'Add New ' . $singular .' Name',
		'new_item_name'							=> 'New ' . $singular,
		'seperate_items_with_comas' => 'Seperate ' . $plural . ' with commas',
		'add_or_remove_items' 			=> 'Add or remove ' . $plural,
		'choose_from_most_used' 		=> 'Choose from the most used' . $plural,
		'not_found' 								=> 'No ' . $plural . ' found',
		'menu_name'									=> $plural,
	);
	$args = array(
			'hierarchical'      	=> true,
			'labels'            	=> $labels,
			'show_ui'           	=> true,
			'show_admin_column' 	=> true,
			'query_var'        		=> true,
			'public'							=> false,
			'capability_type' 		=> 'page',
			'capabilities' 				=> array(
				'manage_terms',
				),
			'rewrite' 						=> array(
				'slug' 							=> 'tag'
			),
	);
	register_taxonomy( 'tag', array('websites'), $args );
}
add_action('init', 'tagsTaxonomy');
