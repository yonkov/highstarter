<?php

function kickstarter_setup() {
    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );
    //Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links');
    // This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'kickstarter' ),
		'social' => __( 'Social Links Menu', 'kickstarter' ),
	) );
    
    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

}

add_action( 'after_setup_theme', 'kickstarter_setup' );

if (isset( $content_width ))
    $kickstarter_content_width = 900;

//Register widget area.

function kickstarter_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'kickstarter' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'kickstarter' ),
		'before_widget' => '<section id="%1$s" class="sidebar-box">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="heading">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'kickstarter' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'kickstarter' ),
		'before_widget' => '<section id="%1$s" class="col-md-9">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="heading">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'kickstarter' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'kickstarter' ),
		'before_widget' => '<section id="%1$s" class="col-md-6">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'kickstarter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kickstarter_styles() {
	//Theme Navigation 
	wp_enqueue_script( 'navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(),'',true);
	//Theme stylesheet.
    wp_enqueue_style( 'kickstarter-css', get_template_directory_uri() . '/style.css', '', '1.0.1' );
}

add_action( 'wp_enqueue_scripts', 'kickstarter_styles' );

/**
 * Enqueue fonts to the footer for better peformance
 */

function kickstarter_fonts() { 
    //Add dashicons
    wp_enqueue_style( 'dashicons' );
    //Add google fonts 
    wp_enqueue_style( 'Merriweather', '//fonts.googleapis.com/css?family=Merriweather&display=swap' ); 
	wp_enqueue_style( 'OpenSans', '//fonts.googleapis.com/css?family=Open+Sans' ); 
}

add_action( 'wp_footer', 'kickstarter_fonts' ); 

function kickstarter_remove_image_size_attributes( $html ) {
    return preg_replace( '/(width|height)="\d*"/', '', $html );
}   
// Remove image size attributes from post thumbnails
add_filter( 'post_thumbnail_html', 'kickstarter_remove_image_size_attributes' );
    
// Remove image size attributes from images added to a WordPress post
add_filter( 'image_send_to_editor', 'kickstarter_remove_image_size_attributes' );

//Make drop down menu accessible by screen readers
function kickstarter_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
// Add [aria-haspopup] and [aria-expanded] to menu items that have children
    $item_has_children = in_array( 'menu-item-has-children', $item->classes );
    if ( $item_has_children ) {
        $atts['aria-haspopup'] = "true";
        $atts['aria-expanded'] = "false";
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'kickstarter_nav_menu_link_attributes', 10, 4 );

//Filter Classes of wp_list_pages items to match menu items

function kickstarter_filter_menu_item_classes( $css_class) {
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

add_filter( 'page_css_class', 'kickstarter_filter_menu_item_classes', 10, 5 );

/* Modify comments markup*/

function kickstarter_modify_comment_output( $comment, $depth, $args ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li'; ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>"
    <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent', $comment ); ?>>
    
    <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
        <footer class="comment-meta">
            <div class="comment-author vcard">
                <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                <?php
				/* translators: %s: comment author link */
				printf( __( '%s <span class="says">says:</span>', 'kickstarter' ),
						sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) )
				);
				?>
            </div><!-- .comment-author -->
            <div class="comment-metadata">
                <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                    <time datetime="<?php comment_time( 'c' ); ?>">
                        <?php
						printf( _x( '%s ago', '%s = human-readable time difference', 'kickstarter' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );
						?>
                    </time>
                </a>
                <?php edit_comment_link( __( 'edit', 'kickstarter' ), '<span class="edit-link">', '</span>' ); ?>
            </div><!-- .comment-metadata -->

            <?php if ( '0' == $comment->comment_approved ) : ?>
            <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'kickstarter' ); ?></p>
            <?php endif; ?>
        </footer><!-- .comment-meta -->
        <div class="comment-content">
            <?php comment_text(); ?>
        </div><!-- .comment-content -->
    </article><!-- .comment-body -->
    
    <?php
}

wp_list_comments("callback=kickstarter_modify_comment_output");

// IMPLEMENT SIMPLE PAGINATION
function kickstarter_numeric_posts_nav() {
 
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation"><ul>' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link('&#x00AB') );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>...</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>...</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link('&#x00BB') );
 
    echo '</ul></div>' . "\n";
}

function kickstarter_the_custom_logo() {

    if (function_exists('the_custom_logo') && has_custom_logo()) {
        the_custom_logo();
    }
}

if ( function_exists( 'get_parent_theme_file_path' ) ){ // Since WP 4.7
	// ADD OPTIONS TO THEME CUSTOMIZER
	require get_parent_theme_file_path( '/inc/customizer.php' );
	 
	//IMPLEMENT CUSTOM HEADER FEATURE.
 	require get_parent_theme_file_path( '/inc/custom-header.php' );
}
else{ //Prior WP 4.7
	require get_template_directory() . '/inc/customizer.php';
	require get_template_directory() . '/inc/custom-header.php';
}

//Post navigation after post content
function kickstarter_the_posts_navigation() {

    $args = array(
        'prev_text' => __('Previous Post: ', 'kickstarter') . '<span>%title</span>',
        'next_text' => __('Next Post: ', 'kickstarter') . '<span>%title</span>',    
    );

    the_post_navigation($args);
}

function kickstarter_thumbnail($size = '') {

    if (has_post_thumbnail()) {?>
        <div class="post-thumbnail">
            <?php if (!is_single()): ?>
            <a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">
                <?php the_post_thumbnail(null, $size);?>
            </a>
            <?php else: ?>
            <?php the_post_thumbnail(null, $size);?>
            <?php endif;?>
        </div><!-- .post-thumbnail -->
    <?php
    }

}
//Display post meta data before and after post content
function kickstarter_post_meta_header() {

    if (is_new_day()): ?>
        <span class="posted-date"><?php the_date();?></span>
    <?php endif;?>

        <span class="posted-author"><?php the_author_posts_link();?></span>

    <?php if (!post_password_required() && (comments_open() || get_comments_number())): ?>
        <span class="comments-number">
            <?php comments_popup_link(esc_html__('Leave a comment', 'kickstarter'), esc_html__('1 Comment', 'kickstarter'), /* translators: number of comments */esc_html__('% Comments', 'kickstarter'), 'comments-link');?>
        </span>
    <?php endif;?>
    
    <?php
}

function kickstarter_post_meta_footer() {
    if ('post' === get_post_type()): ?>
    
    <?php $category_list = get_the_category_list(esc_html(', '));?>
        <?php if ($category_list): ?>
            <span class="cat-links">
                <?php printf( /* category list */esc_html('%s'), $category_list); // xss ok. ?>
            </span>
        <?php endif;?>

        <?php $tag_list = get_the_tag_list('', esc_html(', '));?>

        <?php if ($tag_list): ?>
            <span class="tags-links">
                <?php printf( /* tag list */esc_html('%s'), $tag_list); // xss ok. ?>
            </span>
        <?php endif;?>

    <?php endif;
}

// Add very simple breadcrumps
function kickstarter_breadcrumbs() { ?> 
    <a href="<?php echo home_url();?>"><?php _e( 'Home', 'kickstarter' ); ?></a>
    <?php
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
                echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
                the_title();
            }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}
// Add post navigation to previous and next post after post content 
function  kickstarter_post_nav($args = array()) {
    $defaults = (array) apply_filters( 'kickstarter_post_nav_default_args', array(
		'prev_text' => '&larr; %title',
		'next_text' => '%title &rarr;',
	) );
	$args = wp_parse_args( $args, $defaults );
    the_post_navigation( $args );
}

//  Call to action button on homepage
function kickstarter_call_to_action(){
    if( is_front_page() || is_home() ) :
        $banner_label = get_theme_mod('banner_label', __( 'Get Started', 'kickstarter' ));
        $banner_link = get_theme_mod( 'banner_link', '#' );
        if ( $banner_label && $banner_link ) : ?>
            <p>
                <a class="button" href="<?php echo esc_url($banner_link); ?>" 
                    aria-label="Continue reading"><?php echo esc_attr($banner_label); ?> &rarr;
                </a>
            </p>
        <?php endif;
    endif;
}