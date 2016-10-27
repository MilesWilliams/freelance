<?php

/*------------     freelance Custom Admin Menu Page    -----------*/

function freelance_admin_page(){
  //Generate freelance Admin Page
	add_menu_page( 'Freelance Theme Options', 'Freelance', 'manage_options', 'freelance_lifestyle', 'freelance_menu_theme_create_page' );
	//Generate Studio Republika Admin Sub Pages
	add_submenu_page('freelance_lifestyle','Freelance Theme Options','Sidebar', 'manage_options','freelance_lifestyle', 'freelance_menu_theme_create_page');

	add_submenu_page('freelance_lifestyle','Freelance Theme options', 'Theme Options', 'manage_options', 'freelance_menu_theme', 'freelance_menu_theme_support_page');

	add_action('admin_init', 'freelance_custom_settings');
  }
add_action('admin_menu', 'freelance_admin_page');

function freelance_custom_settings(){
	//Sidebar Options
	register_setting('freelance-settings-group','profile_picture');
	register_setting('freelance-settings-group','first_name');
	register_setting('freelance-settings-group','user_description');
	register_setting('freelance-settings-group','twitter_handler', 'freelance_lifestyle_twitter_handler');
	register_setting('freelance-settings-group','facebook_handler');
	register_setting('freelance-settings-group','behance_handler');

	add_settings_section('freelance-lifestyle-sidebar-option','Theme Options','freelance_lifestyle_sidebar_options','freelance_lifestyle');
  add_settings_field('sidebar-avatar','Profile Picture','freelance_lifestyle_sidebar_avatar','freelance_lifestyle','freelance-lifestyle-sidebar-option');
	add_settings_field('sidebar-name','Your Name','freelance_lifestyle_sidebar_name','freelance_lifestyle','freelance-lifestyle-sidebar-option');
	add_settings_field('sidebar-description','Description','freelance_lifestyle_sidebar_description','freelance_lifestyle','freelance-lifestyle-sidebar-option');
	add_settings_field('sidebar-twitter', 'Twitter Handler', 'freelance_lifestyle_sidebar_twitter', 'freelance_lifestyle','freelance-lifestyle-sidebar-option');
	add_settings_field('sidebar-facebook', 'Facebook Handler', 'freelance_lifestyle_sidebar_facebook', 'freelance_lifestyle','freelance-lifestyle-sidebar-option');
	add_settings_field('sidebar-behance', 'Behance Handler', 'freelance_lifestyle_sidebar_behance', 'freelance_lifestyle','freelance-lifestyle-sidebar-option');
}
function freelance_lifestyle_sidebar_avatar() {
	$avatar = esc_attr( get_option('profile_picture'));
  	if (empty($avatar)) {
    	echo '<input type="button" id="upload_button" class=" button button-secondary" value="Upload Profile Picture" >  <input type="hidden" id="profile_picture" name="profile_picture" value=" " />';

  	} else{
    	echo '<input type="button" id="upload_button" class=" button button-secondary" value="Replace Profile Picture" >  <input type="hidden" id="profile_picture" name="profile_picture" value="'.$avatar.'" /> <input type="button" id="remove-picture" class=" button button-secondary" value="Remove"> ';
    }
}
function freelance_lifestyle_sidebar_options() {
	echo 'Customize Your basic Website Information';
}
function freelance_lifestyle_sidebar_name() {
	$firstName = esc_attr( get_option('first_name'));
	echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="Your Name"/> ';
}
function freelance_lifestyle_sidebar_description() {
	$description = esc_attr( get_option('user_description'));
	echo '<textarea row="30" cols="50" type="text" name="user_description" value="'.$description.'" placeholder="Type an about you paragraph">'.$description.'</textarea><p class="description"> To be filled in*</p>';
};
function freelance_lifestyle_sidebar_twitter() {
	$twitter = esc_attr( get_option('twitter_handler'));
	echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter Handler"/><p class="description">Input your Twitter Handler without the @ symbol</p>';
};
function freelance_lifestyle_sidebar_facebook() {
	$facebook = esc_attr( get_option('facebook_handler'));
	echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook Name"/>';
};
function freelance_lifestyle_sidebar_behance() {
	$behance = esc_attr( get_option('behance_handler'));
	echo '<input type="text" name="behance_handler" value="'.$behance.'" placeholder="Behance Handler"/>';
};
//Sanitization Custom Settings
function freelance_lifestyle_twitter_handler( $input ) {
	$output = sanitize_text_field( $input );
	$output = str_replace('@', '', $output);
	return $output;
	//Note: Never use echo for sanitization or variables, use return instead
}

function freelance_menu_theme_create_page(){
	require_once( get_template_directory(). '/includes/admin/freelance-admin.php');
}

function freelance_menu_theme_support_page(){

}
function freelance_menu_theme_settings_page(){

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
