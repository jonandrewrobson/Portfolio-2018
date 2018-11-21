<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package deppo
 */

if ( ! function_exists( 'deppo_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function deppo_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'deppo' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'deppo' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'deppo_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function deppo_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() || 'jetpack-portfolio' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */

		if ( 'jetpack-portfolio' == get_post_type() ) {
			$categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', '&emsp;', '' );
		} else {
			$categories_list = get_the_category_list( '&emsp;' );
		}

		if ( $categories_list && deppo_categorized_blog() ) {
			printf( '<span class="cat-links"><span class="meta-text">' . esc_html__( 'Posted in %1$s', 'deppo' ) . '</span>', '</span>' . $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		/* translators: used between list items, there is a space after the comma */
		if ( 'jetpack-portfolio' == get_post_type() ) {
			$tags_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-tag', '', ', ', '');
		} else {
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'deppo' ) );
		}

		if ( $tags_list ) {
			printf( '<span class="tags-links"><span class="meta-text">' . esc_html__( 'Tagged %1$s', 'deppo' ) . '</span>', '</span>' . $tags_list ); // WPCS: XSS OK.
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'deppo' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 *
 * Archive meta informations
 *
 */
function deppo_archive_meta() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'deppo' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'deppo' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	if ( 'jetpack-portfolio' == get_post_type() ) {
		$categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', ', ', '' );
	} else {
		$categories_list = get_the_category_list( ', ' );
	}

	if ( $categories_list && deppo_categorized_blog() ) {
		printf( '<span class="cat-links"><span class="meta-text">' . esc_html__( 'Posted in %1$s', 'deppo' ) . '</span>', '</span>' . $categories_list ); // WPCS: XSS OK.
	}

	echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}


/**
 *
 * Single meta informations
 *
 */

function deppo_single_header_meta() {
	if ( 'post' === get_post_type() ) {

		$categories_list = get_the_category_list( ', ' );

		if ( $categories_list && deppo_categorized_blog() ) {
			printf( '<span class="cat-links"><span class="meta-text">' . esc_html__( 'Posted in %1$s', 'deppo' ) . '</span>', '</span>' . $categories_list ); // WPCS: XSS OK.
		}

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( '%s', 'post date', 'deppo' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>';

	}
}

function deppo_single_footer_meta() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		$byline = '<span class="meta-text">' . esc_html__( 'Author', 'deppo' ) . '</span>' . '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

		echo '<span class="byline"> ' . $byline . '</span>';
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function deppo_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'deppo_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'deppo_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so deppo_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so deppo_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in deppo_categorized_blog.
 */
function deppo_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'deppo_categories' );
}
add_action( 'edit_category', 'deppo_category_transient_flusher' );
add_action( 'save_post',     'deppo_category_transient_flusher' );


/**
 * Displays post featured image
 *
 * @since  deppo 1.0
 */
function deppo_featured_image() {

	if ( has_post_thumbnail() ) :

		if ( is_single() ) { ?>

			<div class="featured-content featured-image <?php echo esc_attr( deppo_get_featured_image_class() ); ?>">
				<?php

				$url = wp_get_attachment_url( get_post_thumbnail_id( ) );
				$filetype = wp_check_filetype($url);
				if ($filetype['ext'] == 'gif') {
					$thumb_size = '';
				} else {
					$thumb_size = 'deppo-single-post';
				}

				the_post_thumbnail( $thumb_size ); ?>
			</div>

		<?php } else { ?>

			<div class="featured-content featured-image <?php echo esc_attr( deppo_get_featured_image_class() ); ?>">

				<?php

					$url = wp_get_attachment_url( get_post_thumbnail_id( ) );
					$filetype = wp_check_filetype($url);
					if ($filetype['ext'] == 'gif') {
						$thumb_size = '';
					} else if ( is_search()) {
						$thumb_size = 'deppo-search-post';
					} else {
						$thumb_size = 'deppo-archive-post';
					}
				?>

				<?php if ( 'image' == get_post_format() ) {

					$thumb_id        = get_post_thumbnail_id();
					$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'full', true );
					$thumb_url       = $thumb_url_array[0];

				?>
					<a href="<?php echo esc_url( $thumb_url ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" class="thickbox">
						<?php the_post_thumbnail($thumb_size); ?>
					</a>

				<?php } else { ?>

					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumb_size); ?></a>

				<?php } ?>

				<?php if ('link' != get_post_format() && 'quote' != get_post_format() && 'jetpack-portfolio' != get_post_type() ) {
					echo '<a class="more-link" href="' . esc_url(get_permalink()) . '">' . esc_html__('Read More','deppo') . '</a>';
				}
				?>

			</div>

		<?php }

	else :

		return;

	endif;
}

/**
 * Displays post featured image on slider
 *
 * @since  deppo 1.0
 */
function deppo_slider_featured_image() {

	if ( has_post_thumbnail() ) :

		?>

			<div class="featured-content featured-image <?php echo esc_attr( deppo_get_featured_image_class() ); ?>">
				<?php

					$display_post_nav = get_theme_mod( 'display-slider-settings', 1 );

					switch ( $display_post_nav ) {
						case 0:
							$classes[] = 'slider-text-side';
							break;
						default:
							$classes[] = 'slider-text-center';
					}

					$url = wp_get_attachment_url( get_post_thumbnail_id( ) );
					$filetype = wp_check_filetype($url);
					if ($filetype['ext'] == 'gif') {
						$thumb_size = '';
					} else {
						$thumb_size = 'full';
					}

					if ( $display_post_nav == 0 ) { ?>
						<a href="<?php the_permalink(); ?>">
					<?php }
						the_post_thumbnail($thumb_size);
 					if ( $display_post_nav == 0 ) { ?>
						</a>
					<?php } ?>
			</div>

		<?php

	else :

		return;

	endif;
}

/**
 * Display the archive title based on the queried object.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function deppo_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( '<span>%s</span>%s',
						 esc_html__( 'Category', 'deppo'),
						 single_cat_title( '', false )
				 );
	} elseif ( is_tag() ) {
		$title = sprintf( '<span>%s</span>%s',
						 esc_html__( 'Tag' , 'deppo'),
						 single_tag_title( '', false )
				 );
	} elseif ( is_author() ) {
		$title = sprintf( '<span>%s</span>%s',
						 esc_html__( 'Author' , 'deppo'),
						 get_the_author()
				 );
	} elseif ( is_year() ) {
		$title = sprintf( '<span>%s</span>%s',
						 esc_html__( 'Year' , 'deppo'),
						 get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'deppo' ) )  );
	} elseif ( is_month() ) {
		$title = sprintf( '<span>%s</span>%s',
						 esc_html__( 'Month' , 'deppo'),
						 get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'deppo' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( '<span>%s</span>%s',
						 esc_html__( 'Day' , 'deppo'),
						 get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'deppo' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'deppo' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'deppo' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'deppo' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'deppo' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'deppo' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'deppo' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'deppo' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'deppo' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'deppo' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( '%s',
						  post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf('<span>%1$s</span>%2$s',
						 $tax->labels->singular_name,
						 single_term_title( '', false )
				 );
	} else {
		$title = sprintf('<span>%s</span>',
					esc_html__( 'Archives', 'deppo' )
				 );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}

/**
 * Custom post navigation
 *
 * @since deppo 1.0
 */
function deppo_post_navigation() {

	$prev_post_navigation = '<span class="post-nav-text">' . esc_html__( 'previous', 'deppo' ) . '</span>';
	$next_post_navigation = '<span class="post-nav-text">' . esc_html__( 'next', 'deppo' ) . '</span>';
	$post_title           = '%title';
	$post_title_start     = '<div class="post-nav-title">';
	$post_title_end       = '</div>';

	the_post_navigation( array(
		'prev_text'                  =>  $prev_post_navigation . $post_title_start . $post_title . $post_title_end,
		'next_text'                  =>  $next_post_navigation . $post_title_start . $post_title . $post_title_end,
		'screen_reader_text' => esc_html__( 'Continue Reading',  'deppo' ),
	) );
}

/**
 * Custom post navigation
 *
 * @since deppo 1.0
 */
function deppo_portfolio_navigation() {

	$prev_post_navigation = '<span class="post-nav-text">' . esc_html__( 'Previous', 'deppo' ) . '</span>';
	$next_post_navigation = '<span class="post-nav-text">' . esc_html__( 'Next', 'deppo' ) . '</span>';
	$arrow_right          = '<span class="arrow-wrapper"><i class="right-arrow"></i></span>';
	$post_title           = '%title';
	$post_title_start     = '<div class="post-nav-title">';
	$post_title_end       = '</div>';

	echo '<div class="portfolio-item portfolio-navigation container container-x-medium">';

	the_post_navigation( array(
		'prev_text'                  =>  $prev_post_navigation . $arrow_right . $post_title_start . $post_title . $post_title_end,
		'next_text'                  =>  $post_title_start . $post_title . $post_title_end . $arrow_right . $next_post_navigation,
		'screen_reader_text' => esc_html__( 'Continue Reading',  'deppo' ),
	) );

	echo '</div>';
}

/**
 * deppo custom paging function
 *
 * Creates and displays custom page numbering pagination in bottom of archives
 *
 * @since deppo 1.0
 */

function deppo_numbers_pagination() {

	global $wp_query, $wp_rewrite;

	if ( $wp_query->max_num_pages > 1 ) :

		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

		$pagination = array(
			'base'      => @add_query_arg( 'paged', '%#%' ),
			'format'    => '',
			'total'     => $wp_query->max_num_pages,
			'current'   => $current,
			'end_size'  => 1,
			'type'      => 'list',
			'prev_next' => true,
			'prev_text' => esc_html__( 'Prev', 'deppo' ),
			'next_text' => esc_html__( 'Next', 'deppo' )
		);

		if ( $wp_rewrite->using_permalinks() )
			$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

		if ( ! empty( $wp_query->query_vars['s'] ) ) {
			$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
		}

		// Display pagination
		printf( '<nav class="navigation paging-navigation archive-item fp-auto-height"><h1 class="screen-reader-text">%1$s</h1>%2$s</nav>',
			esc_html__( 'Page navigation', 'deppo' ),
			paginate_links( $pagination )
		);

	endif;

}

function call_featured_slider() {

	if (deppo_has_featured_posts()) { ?>
		<!-- Featured posts slider -->

		<?php
			$slider_autoplay = get_theme_mod( 'autoplay-slider-settings', 0 );
			$slider_autoplay_class = '';

			if ( $slider_autoplay == 1) {
				$slider_autoplay_class = 'autoplay-slider';
			}


		?>
		<div class="featured-slider-wrapper">
			<div class="featured-slider <?php echo $slider_autoplay_class; ?>">

				<?php

					$settings = Featured_Content::get_setting();

					$the_query = new WP_Query( array(
						'tag'            => $settings['tag-name'],
						'posts_per_page' => 12,
						'post_type'=> array( 'post', 'jetpack-portfolio'),
					) );

					$query_count = $the_query->post_count;

					if ( $the_query->have_posts() ) {

						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							get_template_part( 'template-parts/content', 'slider' );
						}

						wp_reset_postdata();

					}

				?>
			</div>

			<div class="slick-dots-wrapper">
				<span class="current">1</span>
				<span class="sep"> / </span>
				<span class="count"><?php echo $query_count; ?></span>
			</div>
		</div>
	<?php
	};
}

function call_header_video() {

	if ( has_custom_header() ) {?>
		<div class="header-video-wrapper">
			<?php
			the_custom_header_markup();

			?>
		</div>

		<?php
		$page_id = get_the_ID();
		$display_page_title = get_post_meta( $page_id, 'deppo_page_title', 0 );
		if (!$display_page_title) {
			$hide_show_title = ' screen-reader-text ';
		} else {
			$hide_show_title = ' ';
		}

		$header_section_text = the_title('','',false);
		if ($header_section_text != '') {

			$header_section_length = strlen( $header_section_text );
			$header_text_color = get_theme_mod( 'header_section_color', '');
			$length_class = 'xtra-long';

			if ( $header_section_length < 10 ) {
				$length_class = 'short';
			} else if ( $header_section_length < 18 ) {
				$length_class = 'medium';
			} else if ( $header_section_length < 26 ) {
				$length_class = 'long';
			} else {
				$length_class = 'xtra-long';
			}

			echo '<h1 class="video-header-text ' . $hide_show_title . ' ' . $length_class . '" style="color:' . $header_text_color . '">';
			echo $header_section_text;
			echo '</h1>';
		}
		?>
		<?php
	}
}

/**
 * Get the number of porfolio pages
 *
 * @return  String [Pages count]
 */
function deppo_return_portfolio_pages_number() {
    $pages = get_pages( array(
        'meta_key'   => '_wp_page_template',
        'meta_value' => 'templates/gallery-page.php'
    ) );

    if ( !empty( $pages ) ) {
        return count($pages);
    } else {
        return 0;
    }
}

/**
 * Get title of page that uses portfolio template
 *
 * @return  String [Page title]
 */
function deppo_return_portfolio_page( $type ) {
	$pages = get_pages( array(
		'meta_key'   => '_wp_page_template',
		'meta_value' => 'templates/gallery-page.php'
	) );

	if ( !empty( $pages ) ) {
		if ( 'id' == $type ) {
			return $pages[0]->ID;
		} else {
			return $pages[0]->post_title;
		}
	}
}

/**
* A title for the search.php template that displays the total number of search results and search terms
*
* @return  String [Search results count]
*/
function deppo_search_results_count() {
	global $wp_query;

	$result_count = esc_html__( 'Results', 'deppo' );
	$result_count .= ' ';

	$result_count .= $wp_query->found_posts;

	echo $result_count;
}

// Change Fonts

function deppo_change_fonts() {

	// Get all customizer font settings
	$headings_font_family   = get_theme_mod( 'headings_font_family', 'default' );
	$paragraphs_font_family  = get_theme_mod( 'paragraphs_font_family', 'default' );
	$navigation_font_family = get_theme_mod( 'navigation_font_family', 'default' );

	$change_fonts_style = '';

	// Headings
	if ( 'default' != $headings_font_family ) {

		$headings_font_weight = get_theme_mod( 'headings_font_weight', 'normal' );
		$headings_font_italic = false;

		if ( strpos( $headings_font_weight, 'italic' ) !== false ) {
			$headings_font_italic = true;
			$headings_font_weight = str_replace( 'italic', '', $headings_font_weight );
		}

		if ( 'regular' == $headings_font_weight ) {
			$headings_font_weight = '';
		}

		if ( $headings_font_italic ) {
			$headings_font_italic_css = 'font-style: italic;';
		} else {
			$headings_font_italic_css = 'font-style: normal;';
		}

		$change_fonts_style .= '

			h1:not(.site-title), h1:not(.site-title)>a, h2, h2>a, h3, h3>a, h4, h4>a, h5, h5>a, h6, h6>a {
				font-family: '. esc_html( $headings_font_family ) .', "Helvetica Neue", Helvetica, Arial, sans-serif;
				font-weight: '. esc_html( $headings_font_weight == '' ? 'normal' : $headings_font_weight ).';
				'. $headings_font_italic_css .'
			}
		';
	}

	// Paragraph
	if ( 'default' != $paragraphs_font_family ) {

		$paragraphs_font_weight = get_theme_mod( 'paragraphs_font_weight', 'normal' );
		$paragraphs_font_italic = false;

		if ( strpos( $paragraphs_font_weight, 'italic' ) !== false ) {
			$paragraphs_font_italic = true;
			$paragraphs_font_weight = str_replace( 'italic', '', $paragraphs_font_weight );
		}

		if ( 'regular' == $paragraphs_font_weight ) {
			$paragraphs_font_weight = '';
		}

		if ( $paragraphs_font_italic ) {
			$paragraphs_font_italic_css = 'font-style: italic;';
		} else {
			$paragraphs_font_italic_css = 'font-style: normal;';
		}

		$change_fonts_style .= '

			body {
				font-family: '.esc_html( $paragraphs_font_family ).', "Helvetica Neue", Helvetica, Arial, sans-serif;
				font-weight: '.esc_html( $paragraphs_font_weight == '' ? 'normal' : $paragraphs_font_weight ).';
				'. $paragraphs_font_italic_css .'
			}

		';
	}

	// Header Navigation
	if ( 'default' != $navigation_font_family ) {

		$navigation_font_weight = get_theme_mod( 'navigation_font_weight', 'normal' );
		$navigation_font_italic = false;

		if ( strpos( $navigation_font_weight, 'italic' ) !== false ) {
			$navigation_font_italic = true;
			$navigation_font_weight = str_replace( 'italic', '', $navigation_font_weight );
		}

		if ( 'regular' == $navigation_font_weight ) {
			$navigation_font_weight = '';
		}

		if ( $navigation_font_italic ) {
			$navigation_font_italic_css = 'font-style: italic;';
		} else {
			$navigation_font_italic_css = 'font-style: normal;';
		}

		$change_fonts_style .= '

			.site-title, .site-title a, #site-navigation a, #bigSocialWrap a, .site-info {
				font-family: '.esc_html( $navigation_font_family ).', "Helvetica Neue", Helvetica, Arial, sans-serif;
				font-weight: '.esc_html( $navigation_font_weight == '' ? '500' : $navigation_font_weight ).';
				'. $navigation_font_italic_css .'
			}

		';

	}

	if ( 'default' != $headings_font_family || 'default' != $paragraphs_font_family || 'default' != $navigation_font_family ) {

		return $change_fonts_style;

	}

}
