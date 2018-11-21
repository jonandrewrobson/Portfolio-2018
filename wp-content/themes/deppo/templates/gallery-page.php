<?php
/**
 * Template Name: Portfolio
 *
 * @package deppo
 */

get_header();

$page_id = get_the_ID();
if ($page_id) {
	$display_page_title = get_post_meta( $page_id, 'deppo_page_title', 0 );
	if ($display_page_title) {
		$hide_show_title = ' ';
	} else {
		$hide_show_title = ' screen-reader-text ';
	}
} else {
	$hide_show_title = ' ';
}
?>

		<div id="primary" class="content-area portfolio-archive">

			<main id="main" class="site-main container container-medium" role="main">

				<?php while ( have_posts() ) : the_post(); ?>
					<header class="entry-header <?php echo $hide_show_title ?>">
						<?php the_title( '<h1 class="page-title">', '</h1>' );

						$thecontent = get_the_content();
						if(!empty($thecontent)) { ?>
						<div class="portfolio-description">
							<?php echo $thecontent; ?>
						</div>

						<?php } ?>
					</header><!-- .entry-header -->
				<?php endwhile; // End of the loop.
				wp_reset_postdata();
				?>

				<?php
					global $paged, $wp_query, $wp;
					$args = wp_parse_args($wp->matched_query);
					if ( !empty ( $args['paged'] ) && 0 == $paged ) {
						$wp_query->set('paged', $args['paged']);
						$paged = $args['paged'];
					}
					$paged          = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					$default_posts_per_page = get_option( 'posts_per_page' );
					$posts_per_page = get_option( 'jetpack_portfolio_posts_per_page', $default_posts_per_page );

					$args = array(
						'post_type'      => 'jetpack-portfolio',
						'posts_per_page' => $posts_per_page,
						'paged'			 => $paged
					);

					$wp_query = new WP_Query ( $args );

					?>


					<?php

					if ( post_type_exists( 'jetpack-portfolio' ) && $wp_query->have_posts() ) :
					?>

						<div id="post-load" class="row">

							<?php

								while ( $wp_query->have_posts() ) : $wp_query->the_post();

									get_template_part( 'template-parts/content', 'portfolio' );

								endwhile;
							?>

						</div><!-- .masonry -->

						<?php
							deppo_numbers_pagination();
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
