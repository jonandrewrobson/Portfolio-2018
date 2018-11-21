<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package deppo
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main archive-wrapper" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header container container-large">
				<h1 class="page-title"><span class="screen-reader-text"><?php echo esc_html__( 'Search Results for', 'deppo' ); ?> </span> <?php echo get_search_query(); ?></h1>
				<span class="results-count"><?php
					deppo_search_results_count();
				?>
				</span>
			</header><!-- .page-header -->

			<div id="post-load" class="search-list container container-large">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

				endwhile;

				if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
				} else {
					deppo_numbers_pagination();
				}

			?>
			</div> <?php

		else :
			?> <div class="search-list container container-large"> <?php
				get_template_part( 'template-parts/content', 'none' );
			?> </div> <?php

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
