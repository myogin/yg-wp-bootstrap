<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 */

get_header();
?>

<div class="pattern-square"></div>
<!--Pageheader start-->
<section class="py-5 py-lg-8">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="text-center">
                    <h1 class="mb-3">Exploring the Tapestry of Ideas</h1>
                    <p class="mb-0">Discover the story behind our blog and the passionate minds behind the exploration
                        of ideas.

                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Pageheader end-->

<div id="content" class="site-content <?= bootscore_container_class(); ?> py-5 mt-4">
    <div id="primary" class="content-area">

        <!-- Hook to add something nice -->
        <?php bs_after_primary(); ?>

        <main id="main" class="site-main">

            <!-- Header -->
            <!-- <div class="py-3 py-md-5 text-center">
                <h1 class="display-1"><?php bloginfo('name'); ?></h1>
                <p class="lead"><?php bloginfo('description'); ?></p>
            </div> -->

            <!-- Sticky Post -->
            <?php if (is_sticky() && is_home() && !is_paged()) : ?>
            <div class="row">
                <div class="col">
                    <?php
              $args      = array(
                'posts_per_page'      => 2,
                'post__in'            => get_option('sticky_posts'),
                'ignore_sticky_posts' => 2
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
              wp_reset_postdata();
              ?>
                </div>

                <!-- col -->
            </div>
            <!-- row -->
            <?php endif; ?>
            <!-- Post List -->
            <div class="row">
                <div class="<?= bootscore_main_col_class(); ?>">
                    <!-- Grid Layout -->
                    <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                    <?php if (is_sticky()) continue; //ignore sticky posts
                ?>

                    <?php get_template_part('template-parts/content-postlist', 'postlist');?>
                    <?php endwhile; ?>
                    <?php endif; ?>

                    <footer class="entry-footer">
                        <?php bootscore_pagination(); ?>
                    </footer>

                </div>
                <!-- col -->
                <?php get_sidebar(); ?>
            </div>
            <!-- row -->
        </main><!-- #main -->

    </div><!-- #primary -->
</div><!-- #content -->
<?php
get_footer();