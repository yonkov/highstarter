<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Kickstarter
 * @since 1.0
 * @version 1.0
 * @copyright  Copyright (c) 2020, Atanas Yonkov
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
?>


<?php get_header(); ?>
<div>
    <!-- Start of main-content -->
    <section class="site-section py-sm">
        <div class="container">
            <div class="row">
                <div class="column">
                    <h2 class="mb-4"><?php _e('Search Results', 'kickstarter')?></h2>
                </div>
            </div>
            <div class="row blog-entries">
                <div class="col-md-12 col-lg-8 main-content">
                    <div>
                        <?php
                if ( have_posts() ) :
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part( 'template-parts/post/content', 'excerpt' );

                    endwhile; // End of the loop.

                else : ?>

                        <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'kickstarter' ); ?>
                        </p>
                        <?php
                        get_search_form();

                endif;
                ?>

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