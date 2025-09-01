<section id="project" class="slider">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (have_rows('slider_images')): ?>
                    <div class="owl-carousel owl-theme">
                        <?php while (have_rows('slider_images')):
                            the_row();
                            $image = get_sub_field('slider_img');
                            if ($image): ?>
                                <div class="item">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                                        class="img-fluid">
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>