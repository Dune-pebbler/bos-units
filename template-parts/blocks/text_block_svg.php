<?php
// Define all ACF fields at the top
$title = esc_html(get_sub_field('text_block_svg_title')); // Title
$image = get_sub_field('tekst_blok_svg_img'); // SVG Image
$text = esc_html(get_sub_field('text_block_svg_text')); // Text block
$button = get_sub_field('svg_btn'); // Button field

// Validate button fields
$link = isset($button['url']) ? esc_url($button['url']) : '';
$link_title = isset($button['title']) ? esc_html($button['title']) : '';
?>

<section class="text_block_svg">
    <div class="image-container">
        <?php if ($image && isset($image['url'], $image['alt'])): ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-12 col-lg-8">
                <div class="text_block_svg_content">
                    <?php if ($title): ?>
                        <h2 class="text_block_svg_title"><?php echo $title; ?></h2>
                    <?php endif; ?>

                    <?php if ($text): ?>
                        <div class="text_block_svg_body">
                            <p><?php echo $text; ?></p>
                        </div>
                    <?php else: ?>
                        <div class="text_block_svg_body">
                            <p>No additional text content available.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($link && $link_title): ?>
                <div class="col-lg-8">
                    <div class="btn">
                        <a href="<?php echo $link; ?>"><?php echo $link_title; ?></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>