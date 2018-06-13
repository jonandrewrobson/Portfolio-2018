<?php
/**
 * Displays portfolio archives
 *
 * @package deppo
 */
get_header(); ?>

		<div id="primary" class="content-area portfolio-archive">
			<main id="main" class="site-main container container-medium" role="main">

				<header class="entry-header">
					<?php
						deppo_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="portfolio-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<?php if ( have_posts() ) : ?>

					<div id="post-load" class="row">

						<?php
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/content', 'portfolio' );

							endwhile;

						if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
						} else {
							deppo_numbers_pagination();
						}
						?>

					</div>

			<?php else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			</main>
		</div>

<?php get_footer(); ?>
