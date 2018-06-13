<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package deppo
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found container container-large">
				<header class="page-header">
					<h1 class="page-title">
						<?php esc_html_e( 'Ooops!', 'deppo' ); ?>
						<span><?php esc_html_e( 'That page can&rsquo;t be found.', 'deppo' ); ?></span>
					</h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p>
						<a href="<?php echo get_home_url(); ?>"><?php esc_html_e( 'Go back home', 'deppo' ); ?></a>
						<?php esc_html_e( ' and try your luck there.', 'deppo' ); ?>
					</p>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
