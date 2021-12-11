<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Unikforce
 */

get_header();
?>
<?php
if (get_theme_mod('show_breadcrumbs', true) === true) {
    ?>
    <div class="breadcrumbs">

        <?php unikforce_breadcrumb_trail(); ?>

    </div>
    <?php
}
?>


    <main id="primary" class="site-main">
        <?php
        get_sidebar();
        ?>
        <div class="contentSection">
            <?php
            while (have_posts()) :
                the_post();

                get_template_part('template-parts/content', get_post_type());

                the_post_navigation(
                    array(
                        'prev_text' => '<i class="fa fa-angle-left"></i> <span class="nav-subtitle">' . esc_html__('Previous:', 'unikforce') . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'unikforce') . '</span> <span class="nav-title">%title</span> <i class="fa fa-angle-right"></i>',
                    )
                );

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </div>
    </main><!-- #main -->

<?php
get_footer();
