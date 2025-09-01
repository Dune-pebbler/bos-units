<?php
// Retrieve all ACF fields at the top
$images = [
    'big' => get_sub_field('image_big'),
    'small' => get_sub_field('image_small'),
    'small_below' => get_sub_field('image_small_below')
];
$text_field = get_sub_field('3_text_field');
?>

<section class="three-images">
    <div class="container-fluid">
        <div class="row">
            <!-- Images Fields -->
            <div class="col-1"></div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 d-flex" style="align-items:center;">
                <div class="owl-carousel image-carousel">
                    <?php
                    // Filter out empty images
                    $valid_images = array_filter($images);

                    foreach ($valid_images as $key => $image):
                        if ($image):
                            ?>
                            <div class="carousel-item <?php echo $key; ?>">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                                    class="<?php echo 'image_' . $key; ?>" />
                            </div>
                            <?php
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>

            <!-- WYSIWYG Field -->
            <div class="col-1"></div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3 justify-content-center d-flex">
                <?php if ($text_field): ?>
                    <div class="text-field">
                        <?php echo $text_field; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>