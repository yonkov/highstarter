<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Highstarter
 * 
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
?>

<?php get_header(); ?>
<div>
    <!-- Start of main-content -->
    <section class="site-section">
        <div class="container">
            <div class="row">
                <div class="post-title">
                    <h2><?php _e('Search Results', 'highstarter')?></h2>
                </div>
            </div>
            <div class="row blog-entries">
                <div class="main-content">
                    <div class="row">
                        <?php
                if ( have_posts() ) :
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/post/content', 'excerpt' );
                    endwhile; // End of the loop.
                else : ?>
                    <article class="hentry">
                        <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'highstarter' ); ?>
                        </p>
                        <?php
                        get_search_form(); ?>
                    </article>
                <?php endif; ?>
                    </div>
                </div>
                <!-- END of main-content -->
                <!-- Show Sidebar -->
                <?php get_sidebar() ?>
            </div>
        </div>
    </section>
</div>
<?php get_footer();