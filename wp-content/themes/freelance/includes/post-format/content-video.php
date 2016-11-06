<?php
/*
@package freelance

    ==============================
        Video Post Format
    ==============================
*/
 ?>
 <article <?php post_class(); ?>>
    <div class="post-header">
        <div class="post-image"><?php echo freelance_get_embeded_media ( array('video', 'iframe' ) ); ?></div>
        <div class="meta-content">
            <p>
                <?php  echo freelance_posted_meta(); ?>
            </p>
        </div>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title('<h1>', '</h1>'); ?></a>
    </div>
    <div class="entry-content">
        <?php
            echo the_excerpt();
         ?>
    </div>
    <div class="post-footer">
        <?php echo freelance_posted_footer();?>
    </div>
</article>
