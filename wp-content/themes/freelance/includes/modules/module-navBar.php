<nav role="navigation" id="main-nav">
  <div class="logo">
    <?php get_template_part('_build/icons/logo');?>
  </div>
  <?php wp_nav_menu(array(
    'theme_location'=>'primary',
    'menu_class'    => 'freelance-navbar',
    'walker'        => new Freelance_Walker_Nav_Primary
  )); ?>
</nav>
