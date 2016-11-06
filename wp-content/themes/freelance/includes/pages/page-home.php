<div class="splash" style="display:none;">
  <div class="splash-image">

  </div>
  <a href="#">Enter Website</a>
</div>
<section class="about-info">
  <h1>Who Am I</h1>
  <div class="content-wrapper">
    <?php the_content(); ?>
  </div>
</section>
<section>
  <div class="cta-image">
    <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h2>
  </div>
</section>
<section class="services">
  <?php get_template_part('includes/modules/module', 'services'); ?>
</section>
<section class="featured-site">
  <?php get_template_part('includes/modules/module', 'featuredSite'); ?>
</section>
<section class="latest-posts">
  <?php get_template_part('includes/modules/module', 'latestPosts'); ?>
</section>
