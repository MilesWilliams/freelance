<?php
/*
@package freelance

    ==============================
        Theme Header
    ==============================
*/
 ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <title><?php wp_title(); ?></title>
    <meta name="description" content="<?php bloginfo('description') ?>">
    <meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if( is_singular() && pings_open( get_queried_object() ) ): ?>
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header>
      <?php get_template_part('includes/modules/module', 'navBar'); ?>
      <div class="header-image" style="background-image:url(<?php echo freelance_get_attachment(); ?>)">
        <?php if ( is_front_page() ):
           the_title('<h1>', '</h1>');
        endif; ?>
      </div>
    </header>
  	<main id="main" class="site-main" role="main">
