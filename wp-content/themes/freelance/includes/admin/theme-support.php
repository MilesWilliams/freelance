<?php

/*

@package freelance

    ==============================
        Theme Support Options
    ==============================
*/

$options = get_option('post_formats');
$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
$output = array();
foreach ($formats as $format) {
	$output[] = ( @$options[$format] == 1 ? $format : '');
}
if ( !empty($options) ) {
  add_theme_support('post-formats', $output );
}

$header = get_option('custom_header');
if(@$header == 1){
  add_theme_support('custom-header');
}
$background = get_option('custom_background');
if(@$background == 1){
  add_theme_support( 'custom-background', apply_filters( '
    freelance_custom_background_args', array(
      'default-color' => 'ffffff',
      'default-image' => '',
    ))
  );
}

$siteTitle = esc_attr( get_option('site_title'));
$siteDescription = esc_attr( get_option('site_description'));
$logoWidth = esc_attr( get_option('logo_width'));
$logoHeight = esc_attr( get_option('logo_height'));
$logo = get_option('custom_logo');
if(@$logo == 1){
  add_theme_support( 'custom-logo', array(
    'height'      => $logoWidth,
    'width'       => $logoHeight,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( $siteTitle, $siteDescription ),
  ) );
}

$feedLinks = get_option('automatic_feed_links');
if(@$feedLinks == 1){
  add_theme_support( 'automatic-feed-links' );
}
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array(
  'search-form',
  'comment-form',
  'comment-list',
  'gallery',
  'caption',
) );


function freelance_register_nav_menu(){

  register_nav_menus( array(
    'primary' => esc_html__( 'Header', 'freelance' ),
  ) );
  register_nav_menus( array(
    'secondary' => esc_html__( 'Footer', 'freelance' ),
  ) );

}
add_action('after_setup_theme', 'freelance_register_nav_menu' );

/*
    =================================
        Blog Loop Custom Functions
    =================================
*/

function freelance_posted_meta(){
  $author = get_the_author();
  //Option1
  $pubDate = human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago';
  //Option2
  // $pubDate = get_the_date('F j Y');
  return '<span class="posted-by">' . $author . '</span> / <span class="posted-date">' . $pubDate . '</span>';
}

function freelance_posted_footer(){

	$comments_num = get_comments_number();
	if( comments_open() ){
		if ( $comments_num == 0 ) {
			$comments = 0;
		}elseif ( $comments_num > 1) {
			$comments = $comments_num . __('');
		}else{
			$comments = $comments_num . __('');
		}
		$comments = '<a href="' . get_comments_link() . '">' . $comments .'</a>';
	}else{
		$comments = __('Comments are Closed');
	}
	return '<div class="post-stats"><div class="likes"><div class="icon icon-likes"></div></div><div class="comments"><div class="icon icon-comment"> </div><div>' . $comments . '</div></div></div><span></span>';

}

function freelance_get_embeded_media( $type = array() ){

	$content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
	$embed = get_media_embedded_in_content( $content, array( 'audio', 'iframe' ) );

	if ( in_array( 'audio', $type ) ) {
		$output = str_replace('?visual=true', '?visual=false', $embed[0] );
	}else{
		$output = $embed[0];
	}

	return $output;
}
