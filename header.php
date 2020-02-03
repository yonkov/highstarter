<?php
/**
 * The header for the Kickstarter theme
 *
 * This is the template that displays all of the <header> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Kickstarter
 * @since 1.0
 * @version 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes();?>>

<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head();?>
</head>

<body <?php body_class();?>>
    <a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'kickstarter'); ?></a>
    <header class="site-header">
        <div class="site-header-wrapper">
            <div class="site-logo-wrapper">
            <?php // Insert logo through WP admin here
               kickstarter_the_custom_logo(); ?>
            </div>
            <div class="main-navigation-container">
                <?php get_template_part('template-parts/header/navigation');?>
            </div>
        </div><!-- .header wrapper -->
        <?php get_template_part('template-parts/header/site-branding');?>
    </header><!-- .site-header -->

    <main class="site-content <?php echo $kickstarter_class; ?>">
        <div class="wrapper">