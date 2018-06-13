<?php
/**
 * Template part for displaying gallery posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deppo
 */

?>



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="archive-background">

		<?php deppo_featured_image(); ?>

		<header class="entry-header clear">
			<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>
		</header><!-- .entry-header -->
	</div>

</article><!-- #post-## -->
