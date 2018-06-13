<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deppo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="portfolio-images-wrapper">

		<header class="portfolio-item entry-header container container-small">
			<?php
				$title  = the_title('','',false);
				$title_length = strlen( $title );
				$length_class = 'xtra-long';

				if ( $title_length < 10 ) {
					$length_class = 'short';
				} else if ( $title_length < 18 ) {
					$length_class = 'medium';
				} else if ( $title_length < 26 ) {
					$length_class = 'long';
				} else {
					$length_class = 'xtra-long';
				}

				the_title( '<h1 class="entry-title ' . $length_class . '">', '</h1>' );
			?>
		</header><!-- .entry-header -->


		<?php
		$images = get_post_meta($post->ID, 'vdw_gallery_id', true);

		if ($images) {
			foreach ($images as $image) {
				echo '<div class="portfolio-item portfolio-image-wrapper">';
				//echo wp_get_attachment_link($image, 'large');
					echo '<div class="portfolio-image">';
						echo wp_get_attachment_image($image, 'full');
					echo '</div>';
				echo '</div>';
			}
		}

		deppo_portfolio_navigation();

		?>
	</div>

	<?php
	if ($images) { ?>
		<div class="slick-dots-wrapper hide">
			<span class="current">1</span>
			<span class="sep"> / </span>
			<span class="count"><?php echo count($images); ?></span>
		</div>
	<?php } ?>

	<?php
		if ( deppo_return_portfolio_pages_number() > 0 ) {
			$portfolio_archive_url = esc_url( get_permalink( deppo_return_portfolio_page( 'id' ) ) );
		} else {
			$portfolio_archive_url = esc_url( get_home_url() . '/portfolio' );
		}
	?>
	<a class="back-button" href="<?php echo $portfolio_archive_url; ?>">
		<span><?php echo esc_html__('All Projects', 'deppo') ?></span>
		<span class="arrow-wrapper"><i class="right-arrow"></i></span>
	</a>

	<button class="info-toggle clear-button">
		<span><?php echo esc_html__('Info', 'deppo') ?></span>
	</button>

	<div class="entry-content">
		<div class="entry-meta container container-large">
			<?php deppo_posted_on() ?>
			<?php the_title( '<h6 class="info-entry-title">', '</h6>' ); ?>
			<?php deppo_entry_footer(); ?>
		</div>
		<div class="info-text container container-x-medium">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'deppo' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'deppo' ),
					'after'  => '</div>',
				) );
			?>
		</div>
		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) { ?>
			<div class="comment-wrapper container container-large">
				<?php comments_template(); ?>
			</div>
		<?php
		};
		?>
	</div><!-- .entry-content -->
</article>
