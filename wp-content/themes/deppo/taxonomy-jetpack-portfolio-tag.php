<?php
/**
 * Displays portfolio archives
 *
 * @package deppo
 */
get_header(); ?>

		<div id="primary" class="content-area portfolio-archive">
			<main id="main" class="site-main container container-medium" role="main">

				<?php
					if ( isset( get_queried_object()->name ) ) {
						$term_name = get_queried_object()->name;
					} else {
						$term_name = 0;
					}
				?>
				<header class="entry-header">
					<?php printf( '<h2 class="page-title">%s</h2>', esc_html( $term_name ) ); ?>

					<?php
						$type_description = get_queried_object()->description;

						if ($type_description) {
					?>
						<div class="portfolio-description">
							<?php
								echo esc_html( $type_description );
							?>
						</div>
					<?php }; ?>
				</header>

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

					</div><!-- .masonry -->

					<?php
						wp_reset_postdata();
					?>

					<?php else : ?>

						<section class="no-results not-found">

							<header class="page-header">
								<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'deppo' ); ?></h1>
							</header>
							<div class="page-content">
								<?php if ( current_user_can( 'publish_posts' ) ) : ?>

									<p><?php printf( wp_kses( __( 'Ready to publish your first project? <a href="%1$s">Get started here</a>.', 'deppo' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php?post_type=jetpack-portfolio' ) ) ); ?></p>

								<?php else : ?>

									<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'deppo' ); ?></p>
									<?php get_search_form(); ?>
									<div class="search-instructions"><?php esc_html_e( 'Press Enter / Return to begin your search.', 'deppo' ); ?></div>

								<?php endif; ?>
							</div>

						</section>

					<?php endif; ?>

			</main>
		</div>

<?php get_footer(); ?>
