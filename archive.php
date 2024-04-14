<?php

/**
 * The template for displaying archive pages
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

        <?php bs_after_primary(); ?>

        <div class="row">
            <div class="<?= bootscore_main_col_class(); ?>">

                <main id="main" class="site-main">

                    <header class="page-header mb-4">
                        <?php the_archive_title('<h1>', '</h1>'); ?>
                        <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
                    </header>

                    <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>

                    <?php get_template_part('template-parts/content-postlist', 'postlist');?>

                    <?php endwhile; ?>
                    <?php endif; ?>

                    <footer class="entry-footer">
                        <?php bootscore_pagination(); ?>
                    </footer>

                </main>

            </div>
            <?php get_sidebar(); ?>
        </div>

    </div>
</div>

<?php
get_footer();