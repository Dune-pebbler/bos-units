<?php
// Define all ACF fields at the top
$background_color = esc_attr(get_sub_field('background_color'));
$reverse_layout = get_sub_field('reverse_layout');
$text_color = esc_attr(get_sub_field('text_color'));
$text_image_txt = get_sub_field('text_image_txt');
$button_group = get_sub_field('text_image_group');
$text_image_map = get_sub_field('text_image_map');
$text_image_btn = get_sub_field('text_image_btn'); // Assuming this is an array with 'url' and 'title'
$text_image_btn_link = $text_image_btn['url'] ?? '';
$text_image_btn_title = $text_image_btn['title'] ?? '';
?>

<section id="locatie" class="text-with-image" style="background-color: <?php echo $background_color; ?>;">
    <div class="container-fluid">
        <div class="row<?php echo $reverse_layout ? ' reverse ' : ''; ?> <?php echo $text_color; ?>">
            <!-- Text Section -->
            <div class="col-lg-1 col-sm-2"></div>
            <div class="col-lg-4 col-sm-8" style="display: flex; align-items: center;">
                <div class="text_image">
                    <?php
                    if ($text_image_txt):
                        echo $text_image_txt;
                    else:
                        echo '<p>No text content available.</p>';
                    endif;
                    ?>

                    <?php if ($button_group): ?>
                        <div class="button-wrapper" style="margin-top: 20px;">
                            <?php
                            // Define button fields in $button_group
                            $button_text = $button_group['button_text'] ?? '';
                            $button_url = $button_group['button_url'] ?? '';
                            $button_style = $button_group['button_style'] ?? '';

                            if ($button_text && $button_url && $button_style): ?>
                                <a href="<?php echo esc_url($button_url); ?>" class="<?php echo esc_attr($button_style); ?>">
                                    <?php echo esc_html($button_text); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-1 col-sm-2"></div>
            <!-- Map Section -->
            <div class="col-lg-6 col-sm-12 map" style="padding: 0px;">
                <?php if ($text_image_map): ?>
                    <div class="map-embed-container">
                        <?php echo $text_image_map; ?>
                    </div>
                <?php endif; ?>

                <?php if ($text_image_btn_title && $text_image_btn_link): ?>
                    <div class="btn">
                        <a target="_blank" href="<?php echo esc_url($text_image_btn_link); ?>">
                            <?php echo esc_html($text_image_btn_title); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
    .map-embed-container {
        width: 100%;
        height: 100%;
        min-height: 400px;
    }

    .map-embed-container iframe {
        width: 100%;
        height: 100%;
        min-height: 400px;
        border: none;
    }
</style>