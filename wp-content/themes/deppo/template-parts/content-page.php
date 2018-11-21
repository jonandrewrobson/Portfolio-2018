<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package deppo
 */

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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'container container-medium'); ?>>
	<div class="entry-content">
		<?php
			the_content();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
