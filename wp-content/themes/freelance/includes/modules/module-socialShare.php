<?php

 ?>
 <div class="share-wrapper">

     <div id="share" class="share-text">
         <div class="icon">
            <?php get_template_part('_build/icons/icon', 'share'); ?>
         </div>
         <p>
             Share
         </p>
     </div>
    <ul id="hidden" class="hidden-menu">
        <?php
        // Get current page URL
        $socialURL = get_permalink();
        // Get current page title
        $socialTitle = str_replace( ' ', '%20', get_the_title() );
        $twitterURL = 'https://twitter.com/intent/tweet?text='.$socialTitle.'&amp;url='.$socialURL.'&amp;via=CascadesCentre';
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$socialURL;

        ?>
        <li class="share share-facebook">
            <a href="<?php echo $facebookURL ?>" target="_blank" ><div class="icon icon-facebook"><?php get_template_part( '_build/icons/icon', 'facebook' ); ?></div></a>
        </li>
        <li class="share share-twitter">
            <a href="<?php echo $twitterURL ?>" target="_blank"><div class="icon icon-twitter" ><?php get_template_part( '_build/icons/icon', 'twitter' ); ?></div></a>
        </li>
        <li class="share share-email">
            <a href="mailto:?subject=I wanted you to see this post&amp;body=View it at <?php echo get_permalink( $post->ID ); ?>" title="Share by Email" ><div class="icon icon-email"><?php get_template_part( '_build/icons/icon', 'email' ); ?></div></a>
        </li>
    </ul>
 </div>
