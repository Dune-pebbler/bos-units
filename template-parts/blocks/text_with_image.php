<?php
// Define all ACF fields at the top
$background_color = esc_attr(get_sub_field('background_color'));
$reverse_layout = get_sub_field('reverse_layout');
$text_color = esc_attr(get_sub_field('text_color'));
$text_image_txt = get_sub_field('text_image_txt');
$button_group = get_sub_field('text_image_group');
$text_image_img = get_sub_field('text_image_map'); // Image field
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
            <!-- Image Section -->
            <div class="col-lg-6 col-sm-12 image" style="padding: 20px;">
                <?php if ($text_image_img): ?>
                    <div class="image-container">
                        <img src="<?php echo esc_url($text_image_img['url']); ?>" alt="<?php echo esc_attr($text_image_img['alt']); ?>" />
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