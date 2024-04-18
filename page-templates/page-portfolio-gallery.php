<?php

/**
 * Template Name: Portfolios Gallery
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 */

get_header();
?>

<main>
    <!--Pageheader start-->
    <section class="py-5 py-lg-8">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12" data-cue="zoomIn">
                    <h1 class="mb-3">We take digital experiences to the next level</h1>
                    <p class="mb-0 lead">
                        Our dedicated services are developed to fulfill the whole product cycle. They range from
                        discovery, branding, design over to development and continuous improvements in order to
                        achieve the best outcome.‍
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--Pageheader end-->

    <section class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="button-group filter-button-group text-center mb-3" data-cue="zoomIn">
                        <button class="btn btn-primary" data-filter="*">All</button>

                        <?php
$terms = get_terms( array(
    'taxonomy' => 'portfolio_stack',
    'hide_empty' => false,
) );
foreach ($terms as $term){ ?>
                        <button class="btn btn-primary mb-2"
                            data-filter=".filter-<?= ygCleanCategoriesFilter($term->name);?>">
                            <?= $term->name?>
                        </button>
                        <?php }
?>
                    </div>
                </div>
            </div>
            <div class="row portfolio-container" data-cue="zoomIn">
                <?php
                            // First, initialize how many posts to render per page
$display_count = 2;
$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$offset = ( $page - 1 ) * $display_count;

              $args      = array(
                'post_type' =>"portfolio",
                  'orderby'    =>  'date',
                  'order'      =>  'desc',
                  'posts_per_page'   => -1,
              );
              $the_query = new WP_Query($args);
              if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post(); 
                $categories = get_the_terms( get_the_ID(), 'portfolio_stack' ); ?>

                <div class="col-lg-4 col-md-6 mb-2 portfolio-item 
                <?php if ($categories) foreach ( $categories as $category){ echo " filter-".ygCleanCategoriesFilter($category->name);} ?>
                ">
                    <div class="card card-lift">
                        <div class="card-body pb-0">
                            <div class="mb-6">
                                <?php the_title('<h2 class="blog-post-title h5">', '</h2>'); ?>
                                <?php    
                                if ($categories) :
                                    foreach ( $categories as $category){ ?>
                                <span
                                    class="badge bg-light-subtle border border-light-subtle text-light-emphasis rounded-2"><?= $category->name ?></span>
                                <?php  } endif;?>
                            </div>
                            <?php the_post_thumbnail('medium', array('class' => 'img-fluid rounded-top shadow-sm ')); ?>
                        </div>
                    </div>
                </div>
                <?php
                endwhile;
              endif;
              ?>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();