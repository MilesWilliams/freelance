<?php
/*
@package freelance

    ==============================
        Qoute Post Format
    ==============================
*/
//$class = get_query_var('post-class');
 ?>
 <article <?php post_class( array('freelance-quote-post-format') ); ?>>
     <blockquote cite="http://">
        <div class="row">
             <h1 class="quote-content"><?php echo get_the_content(); ?></h1>
             <?php esc_html_e(the_title('<h2 class="quote-author">', '</h2>') ); ?>
             <div class="post-footer">
                 <?php echo freelance_posted_footer();?>
             </div>
        </div>
     </blockquote>
 </article>
