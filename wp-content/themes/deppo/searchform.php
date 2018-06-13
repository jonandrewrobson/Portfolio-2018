<?php
/**
 * Template for displaying search forms in deppo
 * code taken from Twenty Seventeen
 *
 * @package WordPress
 * @subpackage deppo
 * @since 1.0
 * @version 1.0
 */
?>

<?php $unique_id = uniqid( 'search-form-' ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr($unique_id); ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'deppo' ); ?></span>
	</label>
	<input type="search" id="<?php echo esc_attr($unique_id); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'deppo' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit clear-button">
		<span class="screen-reader-text"><?php echo esc_html__( 'Search', 'deppo' ); ?></span>
		<i class="icon-arrow-right"></i>
	</button>
</form>
