<?php
/**
 * Template Name: Home Slider
 *
 * @package deppo
 */

get_header();

$page_id = get_the_ID();
$display_page_title = get_post_meta( $page_id, 'deppo_page_title', 0 );
if ($display_page_title) {
	$hide_show_title = ' ';
} else {
	$hide_show_title = ' screen-reader-text ';
}
?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php

				if ( has_custom_header() ) {
					call_header_video();
				} else if ( deppo_has_featured_posts() ) {
					call_featured_slider();
					?>
					<header class="entry-header slider-page-header screen-reader-text">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->
					<?php
				} else {
					?>
					<header class="entry-header slider-page-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->
					<?php
				}?>

			</main>
		</div>

<?php get_footer(); ?>
