<?php

/*

@package freelance

    ==============================
        Admin Enqueue Functions
    ==============================
*/

function freelance_load_ladmin_scripts( $hook ){
  if( 'toplevel_page_freelance_lifestyle' != $hook){
    return;
  }
  wp_register_style('freelance_admin', get_template_directory_uri() . '/includes/admin/css/admin.css', array(), '1.0.0', 'all');
  wp_enqueue_style( 'freelance_admin');

  wp_enqueue_media();

  wp_register_script('freelance_adminJS', get_template_directory_uri() . '/includes/admin/js/min/admin-min.js', array('jquery'),'1.0.0', true);
  wp_enqueue_script('freelance_adminJS');
  wp_register_script('freelance_jquery', get_stylesheet_directory_uri() . '/_build/js/min/jquery-3.1.1.min.js', array(),'', false);
  wp_enqueue_script('freelance_jquery');
}

add_action('admin_enqueue_scripts', 'freelance_load_ladmin_scripts');
