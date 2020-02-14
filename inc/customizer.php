<?php
/**
 * Kickstarter theme Customizer
 *
 * @package WordPress
 * @subpackage Kickstarter
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Call Custom Sanitization Functions
 */
require get_template_directory() . '/inc/sanitization-functions.php';

/*
 ** Allow users to change theme colors through the WordPress Customizer
 */

function kickstarter_customize_colors($wp_customize) {

    //Primary menu background color
    $wp_customize->add_setting('header_background_color', array(
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_background_color', array(
        'label' => esc_html__('Header Background Color', 'kickstarter'),
        'section' => 'colors',
    )));

    //Site title color
    $wp_customize->add_setting('site_title_textcolor', array(
        'default' => "#fff",
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'site_title_textcolor', array(
        'label' => esc_html__('Site Title Color', 'kickstarter'),
        'section' => 'colors',
    )));

    // Links Text color
    $wp_customize->add_setting('link_textcolor', array(
        'default' => "#007bff",
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_textcolor', array(
        'label' => esc_html__('Links Color', 'kickstarter'),
        'section' => 'colors',
    )));

    // Headings color
    $wp_customize->add_setting('header_textcolor', array(
        'default' => "#333",
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_textcolor', array(
        'label' => esc_html__('Headings Text Color', 'kickstarter'),
        'section' => 'colors',
    )));

    //Buttons
    $wp_customize->add_setting('button_color', array(
        'default' => "#ff6663",
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_color', array(
        'label' => esc_html__('Buttons', 'kickstarter'),
        'section' => 'colors',
    )));

}
add_action('customize_register', 'kickstarter_customize_colors');

function kickstarter_customize_colors_css() { ?>
<style type="text/css">
body h1,
body h2,
body h3 {
    color: #<?php echo esc_attr(get_theme_mod('header_textcolor', "#333"));
    ?>;
}
body a {
    color: <?php echo esc_attr(get_theme_mod('link_textcolor', '007bff'));
    ?>;
}
.site-header-wrapper {
    background-color: <?php echo esc_attr(get_theme_mod('header_background_color', "#fff"));
    ?>;
}
.hero-text .site-title a,
.hero-text p {
    color: <?php echo esc_attr(get_theme_mod('site_title_textcolor', "#fff"));
    ?>;
}
button,
a.button,
a.button:visited,
input[type="button"],
input[type="reset"],
input[type="submit"] {
    background-color: <?php echo esc_attr(get_theme_mod('button_color', "#ff6663"));
    ?>;
}
</style>
<?php
}
add_action('wp_footer', 'kickstarter_customize_colors_css');

/*
 * Allow users to change or remove the call to action on the Homepage 
 * and customize the header image
 */

function kickstarter_customize_register_banner_and_header($wp_customize) {

    $wp_customize->add_section('banner_options', array(
        'title' => esc_html__('Call to Action', 'kickstarter'),
        'description' => esc_html__('Customize the button on the header of the Homepage.
        You can change the default text of the button, add link to it or completely hide it.', 'kickstarter'),
    ));

    /**
     * CALL TO ACTION
     */

    //Banner label
    $wp_customize->add_setting(
        'banner_label',
        array(
            'default' => esc_html__('Get Started', 'kickstarter'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'banner_label',
        array(
            'label' => esc_html__('Banner Text', 'kickstarter'),
            'section' => 'banner_options',
            'description' => esc_html__('Change the default text of the button.', 'kickstarter'),
            'type' => 'text',
        )
    );

    //Banner Link
    $wp_customize->add_setting(
        'banner_link',
        array(
            'default' => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'banner_link',
        array(
            'label' => esc_html__('Banner Link', 'kickstarter'),
            'section' => 'banner_options',
            'description' => esc_html__('Add link to the button. You can link it to the about page or the Contact page or a specific section from the Homepage.', 'kickstarter'),
            'type' => 'url',
        )
    );

    /**
     * HEADER IMAGE OPTIONS
     * 
     */

    $wp_customize->add_section('header_options', array(
        'title' => esc_html__('Header Options', 'kickstarter'),
        'description' => esc_html__('Customize the header image to taste with the options below. Change width, height and position of the image. Choose to add or remove the parallax effect of the image.', 'kickstarter'),
        'priority' => 99,
    ));

    // Header background size
    $wp_customize->add_setting(
        'header-background-size',
        array(
            'default' => 'cover',
            'sanitize_callback' => 'kickstarter_sanitize_select',
        )
    );

    $wp_customize->add_control(
        'header-background-size',
        array(
            'label' => esc_html__('Header Background Size', 'kickstarter'),
            'section' => 'header_options',
            'description' => esc_html__('Resize the header image to adjust to the width of the whole screen or choose to keep its initial width.', 'kickstarter'),
            'type' => 'select',
            'choices' => array(
                'initial' => esc_html('initial'),
                'cover' => esc_html('cover'),
            ),
        )
    );

    // Header Image Position
    $wp_customize->add_setting(
        'header-background-position',
        array(
            'default' => 'center',
            'sanitize_callback' => 'kickstarter_sanitize_select',
        )
    );

    $wp_customize->add_control(
        'header-background-position',
        array(
            'label' => esc_html__('Header Background Position', 'kickstarter'),
            'section' => 'header_options',
            'description' => esc_html__('Choose how you want to position the header image.', 'kickstarter'),
            'type' => 'select',
            'choices' => array(
                'top' => esc_html('top'),
                'center' => esc_html('center'),
                'bottom' => esc_html('bottom'),
            ),
        )
    );

    //Header Height

    $wp_customize->add_setting(
        'header_image_height',
        array(
            'default' => '380px',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'header_image_height',
        array(
            'label' => esc_html__('Header Image Height', 'kickstarter'),
            'section' => 'header_options',
            'type' => 'text',
            'description' => esc_html__('Change the height of the header image. Write below a number in pixels (default is 380px).', 'kickstarter'),
        )
    );

    //Header Parallax Effect
    $wp_customize->add_setting(
        'header-background-attachment',
        array(
            'default' => 1,
            'sanitize_callback' => 'kickstarter_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'header-background-attachment',
        array(
            'label' => esc_html__('Header Image Parallax', 'kickstarter'),
            'section' => 'header_options',
            'description' => esc_html__('Add beautiful parallax effect on the header image.', 'kickstarter'),
            'type' => 'checkbox',
        )
    );

    // Header Overlay

    function kickstarter_customize_opacity_range() {

        return apply_filters(
            'kickstarter_customize_opacity_range',
            array(
                'min' => 0,
                'max' => 9,
                'step' => 1,
            )
        );
    }

    $wp_customize->add_setting(
        'cover_template_overlay_opacity',
        array(
            'default' => '1',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        'cover_template_overlay_opacity',
        array(
            'label' => __('Header Overlay Opacity', 'kickstarter'),
            'description' => __('Make sure that the contrast is high enough so that the text is readable.', 'kickstarter'),
            'section' => 'header_options',
            'type' => 'range',
            'input_attrs' => kickstarter_customize_opacity_range(),
        )
    );

}

add_action('customize_register', 'kickstarter_customize_register_banner_and_header');


/*
 **Allow users to change page layout (Right sidebar or Fullwidth) via Theme Customizer
 */

function kickstarter_register_theme_customizer($wp_customize) {

    $wp_customize->add_section('layout_options', array(
        'title' => esc_html__('Page Layout', 'kickstarter'),
        'description' => esc_html__('Change the layout of the whole website. You can choose to display or to hide the right sidebar.', 'kickstarter'),
    ));

    $wp_customize->add_setting('page_layout', array(
        'default' => 'one',
        'sanitize_callback' => 'kickstarter_sanitize_radio',
    ));

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'layout_options',
        array(
            'label' => esc_html__('Page Layout', 'kickstarter'),
            'section' => 'layout_options',
            'settings' => 'page_layout',
            'type' => 'radio',
            'choices' => array(
                'one' => esc_html__('Right Sidebar', 'kickstarter'),
                'two' => esc_html__('Full-width', 'kickstarter'),
                ),
            )
        )
    );
}

add_action('customize_register', 'kickstarter_register_theme_customizer');

function kickstarter_customize_css() {

    $layout = get_theme_mod('page_layout');

    if ($layout == 'two'): ?>

    <style type="text/css">
    .main-content {
        max-width: 100% !important;
        flex: 100% !important;
    }

    .blog-entries .blog-entry img {
        width: 100% !important;
    }

    .sidebar {
        display: none;
    }
    </style>

    <?php endif;
}
add_action('wp_footer', 'kickstarter_customize_css');