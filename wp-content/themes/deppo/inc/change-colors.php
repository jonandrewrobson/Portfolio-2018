<?php
/**
 * Change colors regarding user choices in customizer
 *
 * @package deppo
 */


function deppo_change_colors() {

/**
 * GENERAL THEME COLORS
 */

$body_bg_color         = get_theme_mod( 'deppo_body_background_color', '#fff' );
$body_text_color       = get_theme_mod( 'deppo_body_text_color', '#000' );
$nav_text_color        = get_theme_mod( 'deppo_nav_text_color', '#000' );
$sidebar_bg_color      = get_theme_mod( 'deppo_sidebar_background_color', '#fff' );
$sidebar_text_color    = get_theme_mod( 'deppo_sidebar_text_color', '#000' );

if ('jetpack-portfolio' == get_post_type() && is_single()) {
	$portfolio_single_id = get_the_ID();

	if ($portfolio_single_id) {

		$portfolio_single_color = get_post_meta( $portfolio_single_id, 'deppo_portfolio_bg_color', $body_bg_color );

		if ( $portfolio_single_color != $body_bg_color && $portfolio_single_color != '' ) {
			$body_bg_color = $portfolio_single_color;

			if ($body_bg_color == '') {
				$body_bg_color = '#fff';
			}
		}
	}
}

$slider_text_color = get_theme_mod( 'header_section_color', '');
$slider_text_blend = get_theme_mod( 'slider-title-blend-settings', 0);
$nav_text_blend    = get_theme_mod( 'nav-blend-settings', 0);


$change_colors_style = '

	/* Body BG color */

	body,
	.main-navigation ul ul,
	.single-jetpack-portfolio .entry-content,
	.comment-list .comment-respond,
	input,
	textarea {
		background-color:'. esc_attr( $body_bg_color ) .';
	}

	.header-video-wrapper {
		background:'. esc_attr( $body_bg_color ) .';
	}

	.single-jetpack-portfolio .entry-meta {
		background: '. esc_attr( $body_bg_color ) .';
		box-shadow: 0 0 100px 60px '. esc_attr( $body_bg_color ) .';
	}

	.comment-body .reply a {
		color:'. esc_attr( $body_bg_color ) .';
		background:'. esc_attr( $body_text_color ) .';
	}

	@media screen and (max-width: 600px) {
		.main-navigation .menu > ul,
		.main-navigation ul.menu {
			background: ' . deppo_hex2rgba( $body_bg_color , 0.98 ) .';
		}

		.show-info .info-toggle span:after {
			background: '. esc_attr( $body_bg_color ) .';
			box-shadow: 0px -5px 25px 10px '. esc_attr( $body_bg_color ) .';
		}
	}

	/* Body Text color */

	body,
	button,
	input,
	select,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="number"],
	input[type="tel"],
	input[type="range"],
	input[type="date"],
	input[type="month"],
	input[type="week"],
	input[type="time"],
	input[type="datetime"],
	input[type="datetime-local"],
	input[type="color"],
	textarea,
	mark,
	body #infinite-handle span,
	.slick-dots li button,
	button.clear-button:hover,
	button.clear-button:focus,
	button.clear-button:active {
		color: '. esc_attr( $body_text_color ) .';
	}

	a,
	a:visited,
	.featured-slider h2 a:hover,
	.featured-slider h2 a:focus,
	.featured-slider h2 a:active,
	.portfolio-hover-title .portfolio-archive .row .featured-content + .entry-header a:hover,
	.portfolio-hover-title .portfolio-archive .row .featured-content + .entry-header a:focus,
	.portfolio-hover-title .portfolio-archive .row .featured-content + .entry-header a:active {
		color: '. esc_attr( $body_text_color ) .';
	}

	a:hover,
	a:focus,
	a:active,
	.comment-respond p.comment-subscription-form label {
		color: ' . deppo_hex2rgba( $body_text_color , 0.5 ) .';
	}

	pre,
	code,
	kbd,
	tt,
	var,
	mark,
	ins {
		background: ' . deppo_hex2rgba( $body_text_color , 0.1 ) .';
	}

	abbr,
	acronym {
		border-bottom-color: ' . deppo_hex2rgba( $body_text_color , 0.4 ) .';
	}

	.search-form input::-webkit-input-placeholder {
		color: '. esc_attr( $body_text_color ) .';
	}

	.search-form input:-moz-placeholder {
		color: '. esc_attr( $body_text_color ) .';
	}

	.search-form input::-moz-placeholder {
		color: '. esc_attr( $body_text_color ) .';
	}

	@media screen and (min-width: 1201px) {
		.post-navigation a:hover {
			color: '. esc_attr( $body_text_color ) .';
		}
	}

	.paging-navigation .current:before,
	.paging-navigation .current:after,
	#comments .comment.parent > .comment-body:before,
	.comment-list .comment-respond:before,
	.infinite-loader:before {
		background: '. esc_attr( $body_text_color ) .';
	}

	.entry-content td,
	.entry-content th,
	.comment-content td,
	.comment-content th {
		border-color: '. esc_attr( $body_text_color ) .';
	}

	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"] {
		border-color: '. esc_attr( $body_text_color ) .';
	}

	button:hover,
	input[type="button"]:hover,
	input[type="reset"]:hover,
	input[type="submit"]:hover,
	button:focus,
	input[type="button"]:focus,
	input[type="reset"]:focus,
	input[type="submit"]:focus,
	button:active,
	input[type="button"]:active,
	input[type="reset"]:active,
	input[type="submit"]:active {
		background: '. esc_attr( $body_text_color ) .';
		color: '. esc_attr( $body_bg_color ) .';
	}

	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="number"],
	input[type="tel"],
	input[type="range"],
	input[type="date"],
	input[type="month"],
	input[type="week"],
	input[type="time"],
	input[type="datetime"],
	input[type="datetime-local"],
	input[type="color"],
	textarea {
		border-bottom-color: ' . deppo_hex2rgba( $body_text_color , 0.4 ) .';
	}

	select {
		border-color: '. esc_attr( $body_text_color ) .';
	}

	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="url"]:focus,
	input[type="password"]:focus,
	input[type="search"]:focus,
	input[type="number"]:focus,
	input[type="tel"]:focus,
	input[type="range"]:focus,
	input[type="date"]:focus,
	input[type="month"]:focus,
	input[type="week"]:focus,
	input[type="time"]:focus,
	input[type="datetime"]:focus,
	input[type="datetime-local"]:focus,
	input[type="color"]:focus,
	textarea:focus {
		color: '. esc_attr( $body_text_color ) .';
	}

	.form-submit input[type="submit"],
	.form-submit input[type="submit"]:hover,
	.form-submit input[type="submit"]:focus,
	.form-submit input[type="submit"]:active {
		color: '. esc_attr( $body_text_color ) .';
	}

	body .contact-submit input[type="submit"] {
		color: '. esc_attr( $body_text_color ) .';
	}

	.header-video-wrapper .wp-custom-header-video-play:before,
	.header-video-wrapper .wp-custom-header-video-play:after {
		background: '. esc_attr( $body_bg_color ) .';
	}

	.header-video-wrapper .wp-custom-header-video-pause:before {
		border-left-color: '. esc_attr( $body_bg_color ) .';
	}

	input[type="checkbox"] + label:before,
	label.checkbox:before {
		background: '. esc_attr( $body_text_color ) .';
	}

	input[type="checkbox"] + label:after,
	label.checkbox:after {
		border-color: '. esc_attr( $body_text_color ) .';
	}

	input[type="checkbox"]:checked + label:before,
	label.checkbox.checked:before {
		background: '. esc_attr( $body_bg_color ) .';
	}

	input[type="checkbox"]:checked + label:after,
	label.checkbox.checked:after {
		background: '. esc_attr( $body_text_color ) .';
	}

	input[type="radio"] + label:after,
	label.radio:after {
		border-color: '. esc_attr( $body_text_color ) .';
	}

	input[type="radio"]:checked + label:before,
	label.radio.checked:before {
		background: '. esc_attr( $body_text_color ) .';
	}

	.right-arrow:before {
		background: '. esc_attr( $body_text_color ) .';
	}

	.right-arrow:after {
		border-left-color: '. esc_attr( $body_text_color ) .';
	}

	::-moz-selection { /* Gecko Browsers */
		background: '. esc_attr( $body_text_color ) .';
		color: '. esc_attr( $body_bg_color ) .';
	}
	::selection {  /* WebKit/Blink Browsers */
		background: '. esc_attr( $body_text_color ) .';
		color: '. esc_attr( $body_bg_color ) .';
	}

	.mCS-minimal.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar {
		background-color: '. esc_attr( $body_text_color ) .';
		background-color: ' . deppo_hex2rgba( $body_text_color , 0.2 ) .';
	}

	.mCS-minimal.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar,
	.mCS-minimal.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar{
		background-color: '. esc_attr( $body_text_color ) .';
		background-color: ' . deppo_hex2rgba( $body_text_color , 0.5 ) .';
	}

	body .contact-form label span {
		color: ' . deppo_hex2rgba( $body_text_color , 0.4 ) .';
	}

	/* Nav bg color */

	.main-navigation a,
	.main-navigation a:visited,
	.site-title a,
	.site-title a:visited,
	.jetpack-social-navigation a,
	.jetpack-social-navigation a:visited,
	.site-footer a,
	.site-footer a:visited,
	.main-navigation .menu-toggle,
	.main-navigation .menu-toggle:hover,
	.main-navigation .menu-toggle:focus,
	.view-post-link a,
	.view-post-link a:hover,
	.view-post-link a:focus,
	.view-post-link a:active {
		color: '. esc_attr( $nav_text_color ) .';
	}

	.main-navigation a:hover,
	.main-navigation a:focus,
	.main-navigation a:active,
	.site-title a:hover,
	.site-title a:focus,
	.site-title a:active,
	.site-description,
	.jetpack-social-navigation a:hover,
	.jetpack-social-navigation a:focus,
	.jetpack-social-navigation a:active,
	.site-footer a:hover,
	.site-footer a:focus,
	.site-footer a:active,
	.main-navigation .menu-toggle:active {
		color: ' . deppo_hex2rgba( $nav_text_color , 0.5 ) .';
	}

	.site-footer {
		color: ' . deppo_hex2rgba( $nav_text_color , 0.6 ) .';
	}

	.sidebar-icon i,
	.dropdown-symbol:before,
	.dropdown-symbol:after {
		background: '. esc_attr( $nav_text_color ) .';
	}

	.main-navigation ul ul {
		border-color: ' . deppo_hex2rgba( $nav_text_color , 0.4 ) .';
	}

	.info-toggle,
	.clear-button.info-toggle:hover,
	.clear-button.info-toggle:focus,
	.clear-button.info-toggle:active,
	.back-button,
	.back-button:visited,
	.back-button:hover,
	.back-button:focus,
	.back-button:active,
	.slick-dots-wrapper {
		color: '. esc_attr( $nav_text_color ) .';
	}

	.back-button .right-arrow:before,
	.view-post-link .right-arrow:before,
	.info-toggle:before {
		background: '. esc_attr( $nav_text_color ) .';
	}

	.back-button .right-arrow:after,
	.view-post-link .right-arrow:after {
		border-left-color: '. esc_attr( $nav_text_color ) .';
	}

	.rtl .back-button .right-arrow:after,
	.rtl .view-post-link .right-arrow:after {
		border-right-color: '. esc_attr( $nav_text_color ) .';
	}

	/* Sidebar colors */

	.sidebar-hide-scroll input,
	.sidebar-hide-scroll textarea {
		background-color:'. esc_attr( $sidebar_bg_color ) .';
	}

	.sidebar-hide-scroll {
		background-color:'. esc_attr( $sidebar_bg_color ) .';
		color:'. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-open .sidebar-icon i {
		background:'. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-holder .mCS-minimal.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar {
		background-color: '. esc_attr( $sidebar_text_color ) .';
		background-color: ' . deppo_hex2rgba( $sidebar_text_color , 0.2 ) .';
	}

	.sidebar-holder .mCS-minimal.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar,
	.sidebar-holder .mCS-minimal.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar{
		background-color: '. esc_attr( $sidebar_text_color ) .';
		background-color: ' . deppo_hex2rgba( $sidebar_text_color , 0.5 ) .';
	}

	.sidebar-holder button,
	.sidebar-holder input,
	.sidebar-holder select,
	.sidebar-holder input[type="button"],
	.sidebar-holder input[type="reset"],
	.sidebar-holder input[type="submit"],
	.sidebar-holder input[type="text"],
	.sidebar-holder input[type="email"],
	.sidebar-holder input[type="url"],
	.sidebar-holder input[type="password"],
	.sidebar-holder input[type="search"],
	.sidebar-holder input[type="number"],
	.sidebar-holder input[type="tel"],
	.sidebar-holder input[type="range"],
	.sidebar-holder input[type="date"],
	.sidebar-holder input[type="month"],
	.sidebar-holder input[type="week"],
	.sidebar-holder input[type="time"],
	.sidebar-holder input[type="datetime"],
	.sidebar-holder input[type="datetime-local"],
	.sidebar-holder input[type="color"],
	.sidebar-holder textarea,
	.sidebar-holder mark,
	.sidebar-holder button.clear-button:hover,
	.sidebar-holder button.clear-button:focus,
	.sidebar-holder button.clear-button:active {
		color: '. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-holder a,
	.sidebar-holder a:visited {
		color: '. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-holder a:hover,
	.sidebar-holder a:focus,
	.sidebar-holder a:active {
		color: ' . deppo_hex2rgba( $sidebar_text_color , 0.5 ) .';
	}

	.sidebar-holder pre,
	.sidebar-holder code,
	.sidebar-holder kbd,
	.sidebar-holder tt,
	.sidebar-holder var,
	.sidebar-holder mark,
	.sidebar-holder ins {
		background: ' . deppo_hex2rgba( $sidebar_text_color , 0.1 ) .';
	}

	.sidebar-holder abbr,
	.sidebar-holder acronym {
		border-bottom-color: ' . deppo_hex2rgba( $sidebar_text_color , 0.4 ) .';
	}

	.sidebar-holder .search-form input::-webkit-input-placeholder {
		color: '. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-holder .search-form input:-moz-placeholder {
		color: '. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-holder .search-form input::-moz-placeholder {
		color: '. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-holder .entry-content td,
	.sidebar-holder .entry-content th {
		border-color: '. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-holder button,
	.sidebar-holder input[type="button"],
	.sidebar-holder input[type="reset"],
	.sidebar-holder input[type="submit"] {
		border-color: '. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-holder button:hover,
	.sidebar-holder input[type="button"]:hover,
	.sidebar-holder input[type="reset"]:hover,
	.sidebar-holder input[type="submit"]:hover,
	.sidebar-holder button:focus,
	.sidebar-holder input[type="button"]:focus,
	.sidebar-holder input[type="reset"]:focus,
	.sidebar-holder input[type="submit"]:focus,
	.sidebar-holder button:active,
	.sidebar-holder input[type="button"]:active,
	.sidebar-holder input[type="reset"]:active,
	.sidebar-holder input[type="submit"]:active {
		background: '. esc_attr( $sidebar_text_color ) .';
		color: '. esc_attr( $sidebar_bg_color ) .';
	}

	.sidebar-holder button.clear-button:hover,
	.sidebar-holder button.clear-button:focus,
	.sidebar-holder button.clear-button:active {
		background: transparent;
	}

	.sidebar-holder input[type="text"],
	.sidebar-holder input[type="email"],
	.sidebar-holder input[type="url"],
	.sidebar-holder input[type="password"],
	.sidebar-holder input[type="search"],
	.sidebar-holder input[type="number"],
	.sidebar-holder input[type="tel"],
	.sidebar-holder input[type="range"],
	.sidebar-holder input[type="date"],
	.sidebar-holder input[type="month"],
	.sidebar-holder input[type="week"],
	.sidebar-holder input[type="time"],
	.sidebar-holder input[type="datetime"],
	.sidebar-holder input[type="datetime-local"],
	.sidebar-holder input[type="color"],
	.sidebar-holder textarea {
		border-bottom-color: ' . deppo_hex2rgba( $sidebar_text_color , 0.4 ) .';
	}

	.sidebar-holder select {
		border-color: '. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-holder input[type="text"]:focus,
	.sidebar-holder input[type="email"]:focus,
	.sidebar-holder input[type="url"]:focus,
	.sidebar-holder input[type="password"]:focus,
	.sidebar-holder input[type="search"]:focus,
	.sidebar-holder input[type="number"]:focus,
	.sidebar-holder input[type="tel"]:focus,
	.sidebar-holder input[type="range"]:focus,
	.sidebar-holder input[type="date"]:focus,
	.sidebar-holder input[type="month"]:focus,
	.sidebar-holder input[type="week"]:focus,
	.sidebar-holder input[type="time"]:focus,
	.sidebar-holder input[type="datetime"]:focus,
	.sidebar-holder input[type="datetime-local"]:focus,
	.sidebar-holder input[type="color"]:focus,
	.sidebar-holder textarea:focus {
		color: '. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-holder input[type="checkbox"] + label:before,
	.sidebar-holder label.checkbox:before {
		background: '. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-holder input[type="checkbox"] + label:after,
	.sidebar-holder label.checkbox:after {
		border-color: '. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-holder input[type="checkbox"]:checked + label:before,
	.sidebar-holder label.checkbox.checked:before {
		background: '. esc_attr( $sidebar_bg_color ) .';
	}

	.sidebar-holder input[type="checkbox"]:checked + label:after,
	.sidebar-holder label.checkbox.checked:after {
		background: '. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-holder input[type="radio"] + label:after,
	.sidebar-holder label.radio:after {
		border-color: '. esc_attr( $sidebar_text_color ) .';
	}

	.sidebar-holder input[type="radio"]:checked + label:before,
	.sidebar-holder label.radio.checked:before {
		background: '. esc_attr( $sidebar_text_color ) .';
	}

	body .widget .a-stats a {
		background: '. esc_attr( $sidebar_text_color ) .';
		color: '. esc_attr( $sidebar_bg_color ) .';
	}

	body .widget .a-stats a:hover {
		background: '. esc_attr( $sidebar_text_color ) .';
		color: '. esc_attr( $sidebar_bg_color ) .';
	}

	.widget .milestone-header {
		background-color: '. esc_attr( $sidebar_text_color ) .';
		color: '. esc_attr( $sidebar_bg_color ) .';
	}

	.widget .milestone-countdown,
	.widget .milestone-message {
		border-color: '. esc_attr( $sidebar_text_color ) .';
		color: '. esc_attr( $sidebar_text_color ) .';
	}

	body #eu-cookie-law input {
		border-color: ' . deppo_hex2rgba( $sidebar_text_color , 0.2 ) .';
		color: '. esc_attr( $sidebar_text_color ) .';
	}

	body #eu-cookie-law.negative input {
		border-color: ' . deppo_hex2rgba( $sidebar_bg_color , 0.2 ) .';
	}

	body #eu-cookie-law.negative {
		background-color: '. esc_attr( $sidebar_text_color ) .';
		color: '. esc_attr( $sidebar_bg_color ) .';
	}

	body #eu-cookie-law input:focus,
	body #eu-cookie-law input:hover {
		background: '. esc_attr( $sidebar_text_color ) .';
		color: '. esc_attr( $sidebar_bg_color ) .';
		border-color: '. esc_attr( $sidebar_text_color ) .';
	}

	body #eu-cookie-law.negative input:focus,
	body #eu-cookie-law.negative input:hover {
		background: '. esc_attr( $sidebar_bg_color ) .';
		border-color: '. esc_attr( $sidebar_bg_color ) .';
		color: '. esc_attr( $sidebar_text_color ) .';
	}

	body #eu-cookie-law {
		background-color: '. esc_attr( $sidebar_bg_color ) .';
		border-color: ' . deppo_hex2rgba( $sidebar_text_color , 0.2 ) .';
		color: '. esc_attr( $sidebar_text_color ) .';
	}

	/* comment */
	.entry-content a:after {
		background: '. esc_attr( $body_text_color ) .';
	}

	.main-navigation a:after {
		background: '. esc_attr( $nav_text_color ) .';
	}

	.widget a:after {
		background: '. esc_attr( $sidebar_text_color ) .';
	}

	.entry-content a:hover {
		color: '. esc_attr( $body_text_color ) .';
	}

	.main-navigation li a:hover {
		color: '. esc_attr( $nav_text_color ) .';
	}

	.widget a:hover {
		color: '. esc_attr( $sidebar_text_color ) .';
	}

	';


	/* Slider title color */

	$change_colors_style .= '
		.page-template-home-slider .featured-slider-wrapper .entry-header a {
			color: '. esc_attr( $slider_text_color ) .';
		}

		.featured-slider-wrapper .entry-header .right-arrow:before {
			background: '. esc_attr( $slider_text_color ) .';
		}

		.featured-slider-wrapper .entry-header .right-arrow:after {
			border-left-color: '. esc_attr( $slider_text_color ) .';
		}
	';


	if ($slider_text_blend == 1) {
		$change_colors_style .= '

		@supports ( mix-blend-mode: difference ) {

			.featured-slider article {
				background-color: '. esc_attr( $body_bg_color ) .';
			}

			.page-template-home-slider .featured-slider-wrapper .entry-header,
			.view-post-link,
			.page-template-home-slider .slick-dots-wrapper,
			.video-header-text {
				mix-blend-mode: difference;
			}

			.page-template-home-slider .featured-slider-wrapper .entry-header a,
			.view-post-link a,
			.view-post-link a:hover,
			.view-post-link a:focus,
			.view-post-link a:active,
			.page-template-home-slider .slick-dots-wrapper {
				color: #fff;
			}

			.video-header-text {
				color: #fff !important;
			}

			.view-post-link .right-arrow:before {
				background: #fff;
			}

			.view-post-link .right-arrow:after {
				border-left-color: #fff;
			}

			.rtl .view-post-link .right-arrow:after {
				border-right-color: #fff;
			}
		}
		';
	}

	if ($nav_text_blend == 1) {
		$change_colors_style .= '

		@supports ( mix-blend-mode: difference ) {
			#page {
				background-color: '. esc_attr( $body_bg_color ) .';
				min-height: 100vh;
			}

			.header-video-wrapper:before {
				content: "";
				background: '. esc_attr( $body_bg_color ) .';
				position: fixed;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
			}

			.social-wrapper,
			.site-branding,
			.view-post-link,
			.site-footer,
			.info-toggle,
			.back-button,
			.slick-dots-wrapper {
				mix-blend-mode: difference;
			}

			.site-title a,
			.site-title a:visited,
			.jetpack-social-navigation a,
			.jetpack-social-navigation a:visited,
			.site-footer a,
			.site-footer a:visited,
			.main-navigation .menu-toggle,
			.main-navigation .menu-toggle:hover,
			.main-navigation .menu-toggle:focus,
			.view-post-link a,
			.view-post-link a:hover,
			.view-post-link a:focus,
			.view-post-link a:active,
			.info-toggle,
			.clear-button.info-toggle:hover,
			.clear-button.info-toggle:focus,
			.clear-button.info-toggle:active,
			.back-button,
			.back-button:visited,
			.back-button:hover,
			.back-button:focus,
			.back-button:active,
			.slick-dots-wrapper {
				color: #fff;
			}

			.site-title a:hover,
			.site-title a:focus,
			.site-title a:active,
			.site-description,
			.jetpack-social-navigation a:hover,
			.jetpack-social-navigation a:focus,
			.jetpack-social-navigation a:active,
			.site-footer a:hover,
			.site-footer a:focus,
			.site-footer a:active,
			.main-navigation .menu-toggle:active {
				color: rgba(255,255,255,0.5);
			}

			.main-navigation a:after {
				background: #fff;
			}

			.main-navigation li a:hover {
				color: #fff;
			}

			.site-footer {
				color: rgba(255,255,255,0.6);
			}

			.sidebar-icon i,
			.sidebar-open .sidebar-icon i,
			.dropdown-symbol:before,
			.dropdown-symbol:after,
			.back-button .right-arrow:before,
			.view-post-link .right-arrow:before,
			.info-toggle:before {
				background: #fff;
			}

			.back-button .right-arrow:after,
			.view-post-link .right-arrow:after {
				border-left-color: #fff;
			}

			.rtl .back-button .right-arrow:after,
			.rtl .view-post-link .right-arrow:after {
				border-right-color: #fff;
			}

			.post-nav-side.single-post .nav-previous,
			.post-nav-side.single-post .nav-next {
				mix-blend-mode: difference;
			}

			.post-nav-side.single-post .nav-previous a,
			.post-nav-side.single-post .nav-next a {
				color: #fff;
			}


			.navigation-wrapper {
				mix-blend-mode: difference;
			}

			.main-navigation ul ul {
				background-color: transparent;
				border-color: #fff;
			}

			.main-navigation ul ul ul {
				background-color: rgba(0,0,0,0.9);
			}

			.main-navigation a,
			.main-navigation a:visited {
				color: #fff;
			}

			.main-navigation a:hover,
			.main-navigation a:focus,
			.main-navigation a:active {
				color: rgba(255,255,255,0.5);
			}

			@media screen and (max-width: 600px) {
				.main-navigation .menu > ul,
				.main-navigation ul.menu {
					background: transparent;
				}

				.site-header:before {
					content: "";
					display: block;
					opacity: 0;
					visibility: hidden;
					position: fixed;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					background: '. esc_attr( $body_bg_color ) .';
					background: ' .deppo_hex2rgba( $body_bg_color , 0.9 ) . ';
					-webkit-transition: opacity .4s 0s cubic-bezier(0.075, 0.82, 0.165, 1), visibility 0s .4s;
					-moz-transition: opacity .4s 0s cubic-bezier(0.075, 0.82, 0.165, 1), visibility 0s .4s;
					-ms-transition: opacity .4s 0s cubic-bezier(0.075, 0.82, 0.165, 1), visibility 0s .4s;
					-o-transition: opacity .4s 0s cubic-bezier(0.075, 0.82, 0.165, 1), visibility 0s .4s;
					transition: opacity .4s 0s cubic-bezier(0.075, 0.82, 0.165, 1), visibility 0s .4s;
					z-index: 1;
				}

				.main-menu-open .site-header:before {
					opacity: 1;
					visibility: visible;
					-webkit-transition: opacity .4s cubic-bezier(0.075, 0.82, 0.165, 1), visibility 0s;
					-moz-transition: opacity .4s cubic-bezier(0.075, 0.82, 0.165, 1), visibility 0s;
					-ms-transition: opacity .4s cubic-bezier(0.075, 0.82, 0.165, 1), visibility 0s;
					-o-transition: opacity .4s cubic-bezier(0.075, 0.82, 0.165, 1), visibility 0s;
					transition: opacity .4s cubic-bezier(0.075, 0.82, 0.165, 1), visibility 0s;
				}

				.main-menu-open .site-branding,
				.main-menu-open .slick-dots-wrapper {
					display: none;
				}

			}

			@media screen and (max-width: 600px) {

				.show-info .info-toggle span:after {
					display: none;
				}
			}



		}
		';

	}


	return $change_colors_style;

}

?>
