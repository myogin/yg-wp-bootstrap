<?php

/**
 * Template part for displaying Post List
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 * @version 5.3.4
 */


// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>
<div class="card horizontal mb-4 border-0 bg-transparent">
    <div class="row g-0">

        <?php if (has_post_thumbnail()) : ?>
        <div class="col-lg-6 col-xl-5 col-xxl-4 yg-thumbnail">
            <div class="yg-thumbnail-frame">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium', array('class' => 'card-img-lg-start')); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>

        <div class="col">
            <div class="card-body ">

                <?php bootscore_category_badge(); ?>

                <a class="text-body text-decoration-none" href="<?php the_permalink(); ?>">
                    <?php the_title('<h2 class="blog-post-title">', '</h2>'); ?>
                </a>

                <?php if ('post' === get_post_type()) : ?>
                <p class="meta small mb-2 text-body-tertiary">
                    <?php
                            bootscore_date();
                            bootscore_author();
                            bootscore_comments();
                            bootscore_edit();
                            ?>
                </p>
                <?php endif; ?>

                <p class="card-text">
                    <a class="text-body text-decoration-none" href="<?php the_permalink(); ?>">
                        <?= strip_tags(get_the_excerpt()); ?>
                    </a>
                </p>

                <p class="card-text">
                    <a class="read-more" href="<?php the_permalink(); ?>">
                        <?php _e('Read more »', 'bootscore'); ?>
                    </a>
                </p>

                <?php bootscore_tags(); ?>

            </div>
        </div>
    </div>
</div>
<hr>