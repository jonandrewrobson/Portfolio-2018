<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deppo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-item'); ?>>
	
	<div class="archive-item-holder">

		<?php deppo_featured_image(); ?>

		<div class="text-wrapper">
			<header class="entry-header">
				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php deppo_archive_meta(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
					the_excerpt();
				?>
			</div><!-- .entry-content -->
		</div>
	</div>
</article><!-- #post-## -->
