<?php
/**
 * Template Part for displaying the three most recent "partner" posts
 * as static cards in a row.
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
            <!-- Partners Grid Container -->
            <div class="partners-grid">
                <?php while ($latest_partners_query->have_posts()):
                    $latest_partners_query->the_post(); ?>

                    <div class="partner-item">
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