<?php
// Define all ACF fields at the top
$background_color = esc_attr(get_field('background_color', 'option'));
$inspiratie_images = get_field('inspiratie_images', 'option');
$inspiratie_url = get_field('btn_url', 'option');
$inspiratie_text = get_field('btn_txt', 'option') ?: 'Default Text';
$button_style = get_field('btn_color', 'option');

// Ensure the URL is properly handled (whether it's a string or an array)
$url = is_array($inspiratie_url) ? esc_url($inspiratie_url['url']) : esc_url($inspiratie_url);
?>

<section class="inspiratie" style="background-color: <?php echo $background_color; ?>">
    <div class="container-fluid">
        <div class="row">
            <?php if ($inspiratie_images): ?>
                <?php foreach ($inspiratie_images as $image): ?>
                    <div class="col-lg-4">
                        <div class="inspiratie__img-container">
                            <img src="<?php echo esc_url($image['inspiratie_img']['url']); ?>"
                                alt="<?php echo esc_attr($image['inspiratie_img']['alt']); ?>" class="img-fluid">
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-12" style="display: flex; justify-content: center;">
                <a style="margin-top: 20px;" class="<?= esc_attr($button_style) ?>" href="<?= $url; ?>"><?= esc_html($inspiratie_text); ?></a>
            </div>
        </div>
    </div>
</section>