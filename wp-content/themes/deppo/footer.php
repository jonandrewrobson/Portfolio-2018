<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package deppo
 */

$footer_copyright = get_theme_mod( 'deppo_footer_copyright', '' );

?>

	</div><!-- #content -->

	<div class="sidebar-hide-scroll">
		<div class="sidebar-holder">
			<?php get_sidebar(); ?>
		</div>
	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">

		<?php if ( '' == $footer_copyright ) { ?>

			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'deppo' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'deppo' ), 'WordPress' ); ?></a>
			<br/>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'deppo' ), 'deppo', '<a href="http://www.themeskingdom.com">Themes Kingdom</a>' );

			}
			else {

				printf( $footer_copyright );

			} ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
