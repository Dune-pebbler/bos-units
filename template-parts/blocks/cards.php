<?php
// Define all ACF fields at the top
$background_color = esc_attr(get_sub_field('background_color'));
$show_white_block = get_sub_field('show_white-block');
$cards = get_sub_field('cards');
?>

<section class="cards" style="background-color: <?php echo $background_color; ?>;">
    <div class="container-fluid">
        <?php if ($show_white_block): ?>
            <div class="white-block"></div>
        <?php endif; ?>
        <div class="row">

            <?php if ($cards): ?>
                <?php foreach ($cards as $card): ?>
                    <?php
                    $card_img = $card['card_img'];
                    $card_text = $card['card_text'];
                    $card_url = $card['card_url'];

                    // Ensure card_img is an array and get the URL
                    $card_img_url = isset($card_img['url']) ? $card_img['url'] : '';
                    ?>

                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card">
                            <a href="<?php echo esc_url($card_url); ?>">
                                <div class="card__image-container">
                                    <img src="<?php echo esc_url($card_img_url); ?>" alt="<?php echo esc_attr($card_text); ?>">
                                </div>
                                <div class="text_content">
                                    <?php echo wp_kses_post($card_text); ?>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No cards found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>