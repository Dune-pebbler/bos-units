<?php
// Includes the header.php file, which contains your site's header and navigation.
get_header();
?>
<section class="single-cpt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <?php if (have_posts()): ?>
                    <?php while (have_posts()):
                        the_post(); ?>

                        <div class="featured-image">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('full', array('class' => 'img')); ?>
                            <?php endif; ?>
                        </div>

                        <div class="content">
                            <h1><?php the_title(); ?></h1>
                            <div class="post-content">
                                <?php the_content(); ?>
                            </div>
                        </div>

                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Geen project gevonden.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php
// Includes the footer.php file, which contains your site's footer and scripts.
get_footer();
?>
