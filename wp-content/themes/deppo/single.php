<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package deppo
 */

get_header(); ?>

	<div id="primary" class="content-area container container-large">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

			deppo_post_navigation();

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->

		<?php
			if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
				echo '<div class="related-holder container container-medium">';
			    echo deppo_do_shortcode_function('jetpack-related-posts');
			    echo '</div>';
			}
		?>

		<?php
		while ( have_posts() ) : the_post();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) : ?>
				<div class="comment-wrapper">
					<?php comments_template(); ?>
				</div>
			<?php
			endif;

		endwhile; // End of the loop.
		?>

	</div><!-- #primary -->

<?php
get_footer();
