<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
        <div class="contentSection">
            <?php if (have_posts()) : ?>
                <?php
                /* Start the Loop */
                while (have_posts()) :
                    the_post();

                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */
                    get_template_part('template-parts/content', 'search');

                endwhile;
                ?>
                <div class="pagination-wrap">
                    <?php
                    the_posts_pagination(
                        array(
                            'mid_size' => 3,
                            'prev_text' => '<i class="fa fa-angle-left"></i><span class="screen-reader-text">' . esc_html__('Previous', 'unikforce') . '</span>&nbsp;',
                            'next_text' => '&nbsp;<i class="fa fa-angle-right"></i><span class="screen-reader-text">' . esc_html__('Next', 'unikforce') . '</span>',
                        )
                    );
                    ?>
                </div>
            <?php
            else :

                get_template_part('template-parts/content', 'none');

            endif;
            ?>
        </div>
        <?php
        get_sidebar();
        ?>
    </main><!-- #main -->

<?php
get_footer();
