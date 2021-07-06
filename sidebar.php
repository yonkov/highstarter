<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Highstarter
 * 
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

if (is_active_sidebar('sidebar-1')): ?>
<aside id="secondary" class="sidebar-wrapper sidebar widget-area>" role="complementary"
    aria-label="<?php esc_attr_e('Main Sidebar', 'highstarter');?>">
    <?php dynamic_sidebar('sidebar-1');?>
</aside><!-- #secondary -->
<?php endif; // end primary widget area