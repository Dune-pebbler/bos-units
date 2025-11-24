<?php
/**
 * Template Part for displaying the three most recent "partner" posts
 * as an Owl Carousel slider on a homepage or other section.
 *
 * This template uses Owl Carousel 2 for the slider functionality.
 */

// Get the section title from ACF
$section_title = get_sub_field('partners_title') ?: 'Partners';

// Arguments for the custom query to get the 3 most recent posts.
$args = array(
    'post_type' => 'partner',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC',
);

$latest_partners_query = new WP_Query($args);
?>

<section class="latest-news-section py-5">

    <div class="container">
        <div class="title-container">
            <h2><?php echo esc_html($section_title); ?></h2>
        </div>
        <?php if ($latest_partners_query->have_posts()): ?>
            <!-- Owl Carousel Container -->
            <div class="owl-carousel owl-theme partners-slider">
                <?php while ($latest_partners_query->have_posts()):
                    $latest_partners_query->the_post(); ?>

                    <div class="item">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100'); ?>>
                            <?php if (has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('full', array('class' => 'card-img-top')); ?>
                                </a>
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column">
                                <h3 class="card-title h5">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="card-text">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </article>
                    </div>

                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="col-12">
                <p>Er zijn geen partners gevonden.</p>
            </div>
        <?php endif;
        // Restore original Post Data to avoid conflicts
        wp_reset_postdata();
        ?>
    </div>
</section>

<style>
    /* Additional positioning for carousel container */
    .partners-slider {
        position: relative;
        padding: 0 40px;
        /* Add padding for navigation buttons */
    }

    /* Ensure cards use existing styling from SCSS */
    .partners-slider .item {
        padding: 0 15px;
    }

    /* Remove margin on smaller screens where nav is hidden */
    @media (max-width: 767px) {
        .partners-slider {
            padding: 0;
        }
    }
</style>

<script>
    jQuery(document).ready(function ($) {
        $('.partners-slider').owlCarousel({
            items: 3,
            loop: false,
            margin: 30,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            navText: [
                '<svg viewBox="0 0 24 24"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>',
                '<svg viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>'
            ],
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                    dots: true,
                    margin: 15
                },
                768: {
                    items: 2,
                    nav: false,
                    dots: true,
                    margin: 20
                },
                1024: {
                    items: 3,
                    nav: false,
                    dots: true,
                    margin: 30
                }
            }
        });
    });
</script>
