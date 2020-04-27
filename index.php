<?php get_header(); ?>
    <!-- Start of main-content -->
    <section id="content" class="site-section">
        <div class="container">
            <div class="row">
                <div class="post-title">
                    <h3><?php _e( 'Posts', 'highstarter'); ?></h3>
                </div>
            </div>
            <div class="row blog-entries">
                <div class="main-content">
                    <div class="row">
                        <?php
                    //Dynamic content here
                    if (have_posts() ) :
                        while (have_posts() ) : the_post();
                        	get_template_part( 'template-parts/post/content', 'excerpt', get_post_format() );
                        endwhile;
                    highstarter_numeric_posts_nav();
                    else :
                        _e( 'There are no posts!', 'highstarter');                
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
<?php get_footer(); ?>