<?php

function highstarter_setup() {
	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );
	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'top'    => __( 'Top Menu', 'highstarter' ),
			'social' => __( 'Social Links Menu', 'highstarter' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'search-form'
		)
	);

	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'align-wide' );
}

add_action( 'after_setup_theme', 'highstarter_setup' );

if ( isset( $content_width ) ) {
	$highstarter_content_width = 900;
}

// Register widget area.

function highstarter_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Main Sidebar', 'highstarter' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'highstarter' ),
			'before_widget' => '<section id="%1$s" class="sidebar-box">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="heading">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'highstarter' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'highstarter' ),
			'before_widget' => '<section id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="heading">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'highstarter' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'highstarter' ),
			'before_widget' => '<section id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'highstarter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function highstarter_styles() {
	 // Theme Navigation
	wp_enqueue_script( 'highstarter-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '', true );
	// Toggle Dark Theme Mode
	wp_enqueue_script( 'highstarter-dark-mode', get_template_directory_uri() . '/assets/js/toggleDarkMode.js', array(), '', true );
	// Theme stylesheet.
	wp_enqueue_style( 'highstarter-style', get_template_directory_uri() . '/style.css', '', '2.2.2' );
}

add_action( 'wp_enqueue_scripts', 'highstarter_styles', 99 );

/**
 * Enqueue fonts to the footer for better peformance.
 */
function highstarter_fonts() {
	// Add dashicons
	wp_enqueue_style( 'dashicons' );
	// Add google fonts
	wp_enqueue_style( 'Merriweather', '//fonts.googleapis.com/css?family=Merriweather&display=swap' );
	wp_enqueue_style( 'OpenSans', '//fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap' );
}

add_action( 'wp_footer', 'highstarter_fonts' );

// Make drop down menu accessible by screen readers
function highstarter_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
	// Add [aria-haspopup] and [aria-expanded] to menu items that have children
	$item_has_children = in_array( 'menu-item-has-children', $item->classes );
	if ( $item_has_children ) {
		$atts['aria-haspopup'] = 'true';
		$atts['aria-expanded'] = 'false';
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'highstarter_nav_menu_link_attributes', 10, 4 );

// Filter Classes of wp_list_pages items to match menu items

function highstarter_filter_menu_item_classes( $css_class ) {
	// Add current menu item class.
	if ( in_array( 'current_page_item', $css_class, true ) ) {
		$css_class[] = 'current-menu-item';
	}
	// Add menu item has children class.
	if ( in_array( 'page_item_has_children', $css_class, true ) ) {
		$css_class[] = 'menu-item-has-children';
	}

	return $css_class;
}

add_filter( 'page_css_class', 'highstarter_filter_menu_item_classes', 10, 5 );

/* Modify comments markup*/

function highstarter_modify_comment_output( $comment, $depth, $args ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li'; ?>
<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>"
	<?php comment_class( empty( $args['has_children'] ) ? '' : 'parent', $comment ); ?>>

	<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<footer class="comment-meta">
			<div class="comment-author vcard">
				<?php
				if ( 0 != $args['avatar_size'] ) {
					echo get_avatar( $comment, $args['avatar_size'] );
				}
				?>
				<?php
				/* translators: %s: comment author link */
				printf(
					__( '%s <span class="says">says:</span>', 'highstarter' ),
					sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) )
				);
				?>
			</div><!-- .comment-author -->
			<div class="comment-metadata">
				<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
					<time datetime="<?php comment_time( 'c' ); ?>">
						<?php
						printf( _x( '%s ago', '%s = human-readable time difference', 'highstarter' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );
						?>
					</time>
				</a>
				<?php edit_comment_link( __( 'edit', 'highstarter' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .comment-metadata -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
			<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'highstarter' ); ?>
			</p>
			<?php endif; ?>
		</footer><!-- .comment-meta -->
		<div class="comment-content">
			<?php comment_text(); ?>
		</div><!-- .comment-content -->
	</article><!-- .comment-body -->

	<?php
}

wp_list_comments( 'callback=highstarter_modify_comment_output' );

// IMPLEMENT SIMPLE PAGINATION

function highstarter_numeric_posts_nav() {
	return the_posts_pagination(
		array(
			'mid_size'  => 2,
			'prev_text' => __( '&#x00AB', 'highstarter' ),
			'next_text' => __( '&#x00BB', 'highstarter' ),
		)
	);
}

function highstarter_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
		the_custom_logo();
	}
}

function highstarter_dark_mode_logo() {
	if ( get_theme_mod( 'dark_mode_logo' ) ) : ?>
		<a class="custom-logo-link dark-mode-logo" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
			<img class="custom-logo" src="<?php echo esc_attr( get_theme_mod('dark_mode_logo') ); ?>" />
		</a>
	<?php endif;
}

if ( function_exists( 'get_parent_theme_file_path' ) ) { // Since WP 4.7
	// ADD OPTIONS TO THEME CUSTOMIZER
	include get_parent_theme_file_path( '/inc/customizer.php' );

	// IMPLEMENT CUSTOM HEADER FEATURE.
	include get_parent_theme_file_path( '/inc/custom-header.php' );
} else { // Prior WP 4.7
	include get_template_directory() . '/inc/customizer.php';
	include get_template_directory() . '/inc/custom-header.php';
}

// Post navigation after post content
function highstarter_the_posts_navigation() {
	$args = array(
		'prev_text' => __( 'Previous Post: ', 'highstarter' ) . '<span>%title</span>',
		'next_text' => __( 'Next Post: ', 'highstarter' ) . '<span>%title</span>',
	);

	the_post_navigation( $args );
}

function highstarter_thumbnail( $size = '' ) {
	if ( has_post_thumbnail() ) {
		?>
	<div class="post-thumbnail">
		<?php if ( ! is_single() ) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail( $size ); ?>
		</a>
		<?php else : ?>
			<?php the_post_thumbnail( $size ); ?>
		<?php endif; ?>
	</div><!-- .post-thumbnail -->
		<?php
	}
}

// Display post meta data before and after post content
function highstarter_post_meta_header() {
	if ( is_new_day() ) :
		?>
	<span class="posted-date"><?php the_date(); ?></span>
	 <?php endif; ?>

	<span class="posted-author"><?php the_author_posts_link(); ?></span>

	<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
	<span class="comments-number">
		<?php comments_popup_link( esc_html__( 'Leave a comment', 'highstarter' ), esc_html__( '1 Comment', 'highstarter' ), /* translators: number of comments */esc_html__( '% Comments', 'highstarter' ), 'comments-link' ); ?>
	</span>
	<?php endif; ?>

	<?php
}

function highstarter_post_meta_footer() {
	if ( 'post' === get_post_type() ) :
		?>

		<?php $category_list = get_the_category_list( esc_html( ', ' ) ); ?>
		<?php if ( $category_list ) : ?>
	<span class="cat-links">
			<?php printf( /* category list */esc_html( '%s' ), $category_list ); // xss ok. ?>
	</span>
		<?php endif; ?>

		<?php $tag_list = get_the_tag_list( '', esc_html( ', ' ) ); ?>

		<?php if ( $tag_list ) : ?>
	<span class="tags-links">
			<?php printf( /* tag list */esc_html( '%s' ), $tag_list ); // xss ok. ?>
	</span>
		<?php endif; ?>

		<?php
	endif;
}

// Add very simple breadcrumps
function highstarter_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	?>

	<a href="<?php echo esc_url( home_url() ); ?>"><?php _e( 'Home', 'highstarter' ); ?></a>

	<?php
	if ( is_category() || is_single() ) {
		echo '&nbsp;&nbsp;&#187;&nbsp;&nbsp;';
		the_category( ' &bull; ' );
		if ( is_single() ) {
			echo ' &nbsp;&nbsp;&#187;&nbsp;&nbsp; ';
			the_title();
		}
	} elseif ( is_page() ) {
		echo '&nbsp;&nbsp;&#187;&nbsp;&nbsp;';
		echo the_title();
	} elseif ( is_search() ) {
		echo '&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ';
		echo '"<em>';
		echo the_search_query();
		echo '</em>"';
	}
}

// Add post navigation to previous and next post after post content
function highstarter_post_nav( $args = array() ) {
	if ( ! is_rtl() ) {
		$defaults = (array) apply_filters(
			'highstarter_post_nav_default_args',
			array(
				'prev_text' => '&larr; %title',
				'next_text' => '%title &rarr;',
			)
		);
		$args     = wp_parse_args( $args, $defaults );
		the_post_navigation( $args );
	} else {
		$defaults = (array) apply_filters(
			'highstarter_post_nav_default_args',
			array(
				'prev_text' => '%title &larr;',
				'next_text' => '&rarr; %title',
			)
		);
		$args     = wp_parse_args( $args, $defaults );
		the_post_navigation( $args );
	}
}

// Call to action button on homepage
function highstarter_call_to_action() {
	if ( is_front_page() || is_home() ) :

		$banner_label = get_theme_mod( 'banner_label', __( 'Get Started', 'highstarter' ) );
		$banner_link  = get_theme_mod( 'banner_link', '#' );

		if ( $banner_label && $banner_link ) :
			?>
	
		<p>
			<a class="button" 
				href="<?php echo esc_url( $banner_link ); ?>" 
				aria-label="<?php printf( /* translators: continue reading */ esc_attr__( 'Continue Reading', 'highstarter' ) ); ?>">
					<?php printf( /* translators: right arrow (LTR) / left arrow (RTL) */ esc_html( $banner_label ) . ' ' . '%s', is_rtl() ? '&larr;' : '&rarr;' ); ?>
			</a>
		</p>

			<?php
		endif;

	endif;
}

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * backwards compatibility for wp_body_open action prior WordPress 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/**
 * Enable dark theme mode
 * Hook js right after the body tag to avoid light flash of unstyled content.
 */
function highstarter_dark_mode() {
	?>
		<script>
			if (localStorage.getItem('highstarterNightMode')) {
				document.body.className +=' dark-mode';
			}
		</script>
	<?php
}
add_action( 'wp_body_open', 'highstarter_dark_mode' );

/**
 * Facebook Open Graph.
 *
 * @since 2.0.8
 * Display the featured post image as og:image on the single post page
 * @see   https://stackoverflow.com/questions/28735174/wordpress-ogimage-featured-image
 */
function highstarter_fb_open_graph() {
	if ( is_single() && has_post_thumbnail() ) {
		echo '<meta property="og:image" content="' . esc_attr( get_the_post_thumbnail_url( get_the_ID() ) ) . '" />';
	}
}

add_action( 'wp_head', 'highstarter_fb_open_graph' );

/**
 * Adds no-sidebar class when sidebar is empty
 * @since 2.1.4
 */
function highstarter_body_classes( $classes ){
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'highstarter_body_classes' );