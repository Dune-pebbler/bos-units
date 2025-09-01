<?php
/**
 * The template for displaying the archive for the "nieuws-bericht" custom post type.
 * This template uses Bootstrap 5 classes for layout and structure.
 */

get_header(); ?>

<section class="archive-cpt">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h1>Nieuws Archief</h1>
            </div>
        </div>
        <div class="row">
            <?php
            // Set up pagination
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            // Arguments for the custom query
            $args = array(
                'post_type' => 'nieuws-bericht',
                'posts_per_page' => 9,
                'paged' => $paged,
            );

            $nieuws_query = new WP_Query($args);

            // The Loop
            if ($nieuws_query->have_posts()):
                while ($nieuws_query->have_posts()):
                    $nieuws_query->the_post(); ?>

                    <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100 w-100'); ?>>
                            <?php if (has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('full', array('class' => 'card-img-top')); ?>
                                </a>
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column">
                                <h3 class="card-title h5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="card-text">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="archive-btn">
                                    <a href="<?php the_permalink(); ?>">Lees
                                        meer</a>
                                </div>
                            </div>
                        </article>
                    </div>

                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <p>Er zijn geen nieuwsberichten gevonden.</p>
                </div>
            <?php endif; ?>
        </div> <!-- .row -->

        <div class="row">
            <div class="col-12">
                <nav class="pagination-container d-flex justify-content-center">
                    <?php
                    // Pagination logic
                    $big = 999999999; // an unlikely integer
                    echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $nieuws_query->max_num_pages,
                        'prev_text' => __('&laquo; Vorige'),
                        'next_text' => __('Volgende &raquo;'),
                        'type' => 'list', // Outputs the links in a <ul>
                    ));

                    // Reset post data to the main query
                    wp_reset_postdata();
                    ?>
                </nav>
            </div>
        </div>
    </div> <!-- .container -->
</section>

<?php get_footer(); ?>