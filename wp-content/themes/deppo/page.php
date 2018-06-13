<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deppo
 */

get_header(); ?>

	<div id="primary" class="content-area container container-large">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->

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
