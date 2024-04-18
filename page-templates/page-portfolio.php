<?php

/**
 * Template Name: Portfolios
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 */

get_header();
?>

<div class="pattern-square"></div>
<div id="content" class="site-content <?= bootscore_container_class(); ?> py-5 mt-5">
    <div id="primary" class="content-area">

        <!-- Hook to add something nice -->
        <?php bs_after_primary(); ?>

        <div class="row">
            <div class="<?= bootscore_main_col_class(); ?>">

                <main id="main" class="site-main">

                    <div class="row">
                        <div class="<?= bootscore_main_col_class(); ?>">
                            <?php
                            // First, initialize how many posts to render per page
$display_count = 2;
$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$offset = ( $page - 1 ) * $display_count;

              $args      = array(
                'post_type' =>"portfolio",
                  'orderby'    =>  'date',
                  'order'      =>  'desc',
                  'page'       =>  $page,
                  'offset'     =>  $offset
              );
              $the_query = new WP_Query($args);
              if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                                <?php get_template_part('template-parts/content-postlist', 'postlist');?>
                            </article>
                            <?php
                endwhile;
              endif;
              ?>
                            <footer class="entry-footer">
                                <?php bootscore_pagination_custom_type(new WP_Query($args)); ?>
                            </footer>
                        </div>

                        <!-- col -->
                    </div>

                </main><!-- #main -->

            </div><!-- col -->
            <?php get_sidebar(); ?>
        </div><!-- row -->

    </div><!-- #primary -->
</div><!-- #content -->
<?php
get_footer();