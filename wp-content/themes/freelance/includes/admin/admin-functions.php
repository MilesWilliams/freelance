<?php

/*------------     freelance Custom Admin Menu Page    -----------*/

function freelance_admin_page(){
  //Generate freelance Admin Page
	add_menu_page( 'Freelance Theme Options', 'Freelance', 'manage_options', 'freelance_lifestyle', 'freelance_menu_theme_create_page' );
	//Generate Studio Republika Admin Sub Pages
	add_submenu_page('freelance_lifestyle','Freelance Theme Options','General', 'manage_options','freelance_lifestyle', 'freelance_menu_theme_create_page');

	add_submenu_page('freelance_lifestyle','Freelance Theme Settings', 'Theme Options', 'manage_options', 'freelance_theme_settings', 'freelance_settings_page');

	add_submenu_page('freelance_lifestyle','Freelance Contact Form', 'Contact Form', 'manage_options', 'freelance_theme_contact', 'freelance_contact_form_page');

	add_action('admin_init', 'freelance_custom_settings');
  }
add_action('admin_menu', 'freelance_admin_page');

function freelance_custom_settings(){
	//Sidebar Options
	register_setting('freelance-settings-group','profile_picture');
	register_setting('freelance-settings-group','first_name');
	register_setting('freelance-settings-group','last_name');
	register_setting('freelance-settings-group','user_description');
	register_setting('freelance-settings-group','twitter_handler', 'freelance_lifestyle_twitter_handler');
	register_setting('freelance-settings-group','facebook_handler');
	register_setting('freelance-settings-group','behance_handler');

	add_settings_section('freelance-lifestyle-sidebar-option','Theme Sidebar Options','freelance_lifestyle_sidebar_options','freelance_lifestyle');
  add_settings_field('sidebar-avatar','Profile Picture','freelance_lifestyle_sidebar_avatar','freelance_lifestyle','freelance-lifestyle-sidebar-option');
	add_settings_field('sidebar-name','Full Name','freelance_sidebar_name','freelance_lifestyle','freelance-lifestyle-sidebar-option');
	add_settings_field('sidebar-description','Description','freelance_lifestyle_sidebar_description','freelance_lifestyle','freelance-lifestyle-sidebar-option');
	add_settings_field('sidebar-twitter', 'Twitter Handler', 'freelance_lifestyle_sidebar_twitter', 'freelance_lifestyle','freelance-lifestyle-sidebar-option');
	add_settings_field('sidebar-facebook', 'Facebook Handler', 'freelance_lifestyle_sidebar_facebook', 'freelance_lifestyle','freelance-lifestyle-sidebar-option');
	add_settings_field('sidebar-behance', 'Behance Handler', 'freelance_lifestyle_sidebar_behance', 'freelance_lifestyle','freelance-lifestyle-sidebar-option');

	/* Theme Support Options */
	register_setting('freelance-theme-support-group','post_formats');
	register_setting('freelance-theme-support-group','custom_logo');
	register_setting('freelance-theme-support-group','site_title');
	register_setting('freelance-theme-support-group','site_description');
	register_setting('freelance-theme-support-group','logo_width');
	register_setting('freelance-theme-support-group','logo_height');
	register_setting('freelance-theme-support-group','custom_header');
	register_setting('freelance-theme-support-group','custom_background');
	register_setting('freelance-theme-support-group','automatic_feed_links');

	add_settings_section('freelance-theme-options','Theme Options','freelance_theme_options','freelance_settings_page');
	add_settings_field('post-formats','Post Formats','freelance_post_formats','freelance_settings_page','freelance-theme-options');
	add_settings_field('custom-logo','Custom Logo and Its Settings','freelance_custom_logo','freelance_settings_page','freelance-theme-options');
	add_settings_field('custom-header','Custom Header','freelance_custom_header','freelance_settings_page','freelance-theme-options');
	add_settings_field('custom-background','Custom Background','freelance_custom_background','freelance_settings_page','freelance-theme-options');
	add_settings_field('automatic-feed-links','Automatic Feed Links','freelance_automatic_feed_links','freelance_settings_page','freelance-theme-options');


	/* Contact Form Settings */
	register_setting('freelance-contact-options', 'activate_contact');
	add_settings_section('freelance-contact-section', 'Contact Form', 'freelance_contact_section', 'freelance_theme_contact' );
	add_settings_field('activate-form','Activate Contact Form ','freelance_activate_contact','freelance_theme_contact','freelance-contact-section');

}

function freelance_lifestyle_sidebar_avatar() {
	$avatar = esc_attr( get_option('profile_picture'));
  	if (empty($avatar)) {
    	echo '<input type="button" id="upload-button" class=" button button-secondary" value="Upload Profile Picture" >  <input type="hidden" id="profile-picture" name="profile_picture" value=" " />';

  	} else{
    	echo '<input type="button" id="upload-button" class=" button button-secondary" value="Replace Profile Picture" >  <input type="hidden" id="profile-picture" name="profile_picture" value="'.$avatar.'" /> <input type="button" id="remove-picture" class=" button button-secondary" value="Remove"> ';
    }
}
function freelance_lifestyle_sidebar_options() {
	echo 'Customize Your basic Website Information';
}
function freelance_sidebar_name() {
	$firstName = esc_attr( get_option('first_name'));
	$surName = esc_attr( get_option('last_name'));
	echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="Your First Name"/> <input type="text" name="last_name" value="'.$surName.'" placeholder="Your Surname"/> ';
}
function freelance_lifestyle_sidebar_description() {
	$description = esc_attr( get_option('user_description'));
	echo '<textarea row="30" cols="50" type="text" name="user_description" value="'.$description.'" placeholder="Type an about you paragraph">'.$description.'</textarea>';
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

//Calling Theme Templates for Dashboard sub menu pages
function freelance_menu_theme_create_page(){
	require_once( get_template_directory(). '/includes/admin/Templates/freelance-admin.php');
}
function freelance_settings_page(){
	require_once( get_template_directory() . '/includes/admin/Templates/freelance-theme-support.php' );
}
function freelance_contact_form_page(){
	require_once( get_template_directory() . '/includes/admin/Templates/freelance-contact-form.php' );
}

function freelance_custom_header(){
	$options = get_option('custom_header');
	$checked = ( @$options == 1 ? 'checked' : '');
	echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' />Activate Custom Header</label>';

}
function freelance_custom_logo(){
	$siteTitle = esc_attr( get_option('site_title'));
	$siteDescription = esc_attr( get_option('site_description'));
	$logoWidth = esc_attr( get_option('logo_width'));
	$logoHeight = esc_attr( get_option('logo_height'));
	$options = get_option('custom_logo');
	$checked = ( @$options == 1 ? 'checked' : '');
	echo '<label><input type="checkbox" id="custom_logo" name="custom_logo" value="1" '.$checked.' />Enable Custom Logo for the Customizer</label><br/>';

	if (@$options == 1) {
		echo '<label><input type="number" id="logo_width" name="logo_width" value="'.$logoWidth.'" max="1000"/> Logo Width(px)</label><br/><label><input type="number" id="logo_height" name="logo_height" value="'.$logoHeight.'" max="1000" /> Logo Height(px)</label><br/><br/>';
		echo '<input type="text" name="site_title" value="'.$siteTitle.'" placeholder="Enter the site title"/><br/><textarea row="30" cols="50" type="text" name="site_description" value="'.$siteDescription.'" placeholder="Enter your sites description">'.$siteDescription.'</textarea>';
	}
}
function freelance_automatic_feed_links(){
	$options = get_option('automatic_feed_links');
	$checked = ( @$options == 1 ? 'checked' : '');
	echo '<label><input type="checkbox" id="automatic_feed_links" name="automatic_feed_links" value="1" '.$checked.' />Enable Automatic Feed Links in the Header</label>';

}
function freelance_custom_background(){
	$options = get_option('custom_background');
	$checked = ( @$options == 1 ? 'checked' : '');
	echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' />Activate Custom Background</label>';

}
function freelance_theme_options(){
	echo "Activate and Deactivate Theme Settings";
}
function freelance_post_formats(){
	$options = get_option('post_formats');
	$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
	$output = '';
	foreach ($formats as $format) {
		$checked = ( @$options[$format] == 1 ? 'checked' : '');
		$output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' />'.$format.'</label><br>';
	}
	echo $output;
}

function freelance_contact_section(){
	echo 'Activate and Deactivate the Built-in Contact Form';
}
function freelance_activate_contact(){
	$options = get_option('activate_contact');
	$checked = ( @$options == 1 ? 'checked' : '');
	echo '<label><input type="checkbox" id="activate_contact" name="activate_contact" value="1" '.$checked.' /></label>';

}
