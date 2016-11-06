<?php
/*

@package freelance

    ==================================
        Freelance Ajax Functions
    ==================================
*/

// NO priv is for guest users to be able to call the function
add_action( 'wp_ajax_nopriv_freelance_load_more', 'freelance_load_more' );
add_action( 'wp_ajax_freelance_load_more', 'freelance_load_more' );

function freelance_load_more(){

	$paged = $_POST["page"]+1;
	$prev = $_POST["prev"];
	$archive = $_POST["archive"];

	if( $prev == 1  && $_POST["page"] != 1 ){
		$paged = $_POST["page"]-1;

	}
	$pagNum = 'page/' . $paged;
	$args = array(
		'post_type' 		=> 'post',
		'post_status'		=> 'published',
		'posts_per_page' 	=> 2,
		'paged'				=> $paged
	);
	if ( $archive != '0' ){

		$archVal = explode( '/', $archive );
		$flipped = array_flip( $archVal );

		switch( isset( $flipped ) ){

			case $flipped["category"] :
				$type = "category_name";
		 		$key = "category";
				break;

			case $flipped["tag"]:
				$type = "tag";
				$key = $type;
				break;

			case $flipped["author"]:
				$type = "author";
				$key = $type;
				break;
		}

		$currKey = array_keys( $archVal,$key );
		$nextKey = $currKey[0] + 1;
		$value = $archVal[ $nextKey ];

		$args[ $type ] = $value;

		$page_trail = '/' . $archVal[1] . '/' . $archVal[2] . '/';
	}else{

		$page_trail = '';
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		if ( !empty($page_trail) ) {
			echo '<div class="page-limit" data-page="'. $page_trail .'page/' . $paged . '/">';
		}else{
			$paged = 'page/' . $paged;
			echo '<div class="page-limit" data-page="/blog/' . $paged . '/">';
		}
			while ( $query->have_posts() ) : $query->the_post();

				get_template_part('includes/post-format/content', get_post_format() );

			endwhile; ?>
		</div>
	<?php
		else:
			echo 0;
	endif;

	wp_reset_postdata();

	die();
}

function freelance_check_paged( $num = null ){
	$ouput = '';

	if( is_paged( ) ){
		$output = 'page/' . get_query_var( 'paged' );
	}
	if ( $num == 1 ){
		$paged = ( get_query_var( 'paged' ) == 0 ? 1 : get_query_var( 'paged' ) );
		return $paged;

	} else{
		return $ouput;
	}
}
?>
