<?php
/**
 * Add 2 places to insert widgets in the Footer
 *
 * @package Highstarter
 * 
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

?>


<aside class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'highstarter' ); ?>">
    <?php
//Add content to the footer
if ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) ) : ?>

    <?php
		if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
    <div class="widget-column footer-widget-1">
        <?php dynamic_sidebar( 'sidebar-2' ); ?>
    </div>
    <?php }
		if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
    <div class="widget-column footer-widget-2">
        <?php dynamic_sidebar( 'sidebar-3' ); ?>
    </div>
    <?php } ?>

    <?php endif; ?>
</aside><!-- .widget-area -->