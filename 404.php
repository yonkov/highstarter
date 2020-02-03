<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Kickstarter
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

get_header(); ?>

<section class="site-section py-sm">
    <div class="container">
        <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">
                <h2 class="mb-4"><?php _e( 'Oops! That page can&rsquo;t be found.', 'nasio' ); ?></h2>

                <div class="row">
                    <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'nasio' ); ?>
                    </p>

                    <?php get_search_form(); ?>

                </div>
				</div>
				
                <?php get_sidebar(); ?>
        </div>
</section>
</div>

<?php get_footer();