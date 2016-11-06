<?php
/*
@package freelance

    ==============================
        Standard Post Format
    ==============================
*/
 ?>
<article <?php post_class(); ?>>
    <div class="post-header">
        <div class="post-image"><?php the_post_thumbnail(); ?></div>
        <div class="meta-content">
            <p>
                <?php  echo freelance_posted_meta(); ?>
            </p>
        </div>
    </div>
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title('<h1>', '</h1>'); ?></a>
    <?php the_excerpt(); ?>
    <div class="post-footer">
        <?php echo freelance_posted_footer();?>
    </div>
    <div class="category-wrapper">
        <?php
        $output = '';
            foreach (get_the_category() as $category) {
                $category_id = get_cat_ID( $category->cat_name );
                $category_link = get_category_link( $category_id );
                $output .= '<span class="cat"><a href="'.$category_link.'">'.$category->cat_name.'</a></span>';
            }
            echo $output;
        ?>
    </div>
    <div class=" post-share">
        <?php get_template_part('/includes/modules/module', 'socialShare'); ?>
    </div>
</article>
