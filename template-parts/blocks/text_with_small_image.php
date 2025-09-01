<?php
// Define all ACF fields at the top
$background_color = esc_attr(get_sub_field('background_color'));
$text_image_txt = get_sub_field('text_image_txt');
$button_group = get_sub_field('text_image_group');
$text_image_img = get_sub_field('text_image_img');
?>

<section class="text-with-small-image" style="background-color: <?php echo $background_color; ?>;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="image-container">
                    <img src="<?php echo esc_url($text_image_img['url']); ?>"
                        alt="<?php echo esc_attr($text_image_img['alt']); ?>" />
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="text-content">
                    <?php
                    if ($text_image_txt):
                        echo $text_image_txt;
                    else:
                        echo '<p>No text content available.</p>';
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>