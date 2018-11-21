<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package deppo
 */

?>

<div class="big-search">
	<?php get_search_form(); ?>
</div>
<?php
	if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
		<aside id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</aside><!-- #secondary -->
	<?php
	} ?>
