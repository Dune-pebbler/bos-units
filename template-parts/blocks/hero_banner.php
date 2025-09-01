<?php
// Define all ACF fields at the top
$overlay_text = get_sub_field('overlay_text');
$hero_background_img = get_sub_field('hero_background_img');
$sales_banner = get_sub_field('sales_banner');
?>

<section class="hero">
    <img class="offset-img" src="<?php echo get_template_directory_uri(); ?>/images/kleur_logo.png" alt="Kleur logo">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="hero-banner">
                    <?php if ($hero_background_img): ?>
                        <img src="<?php echo esc_url($hero_background_img['url']); ?>"
                            alt="<?php echo esc_attr($hero_background_img['alt']); ?>" />
                    <?php endif; ?>
                    <div class="hero__banner-overlay">
                        <div class="hero__overlay-text big-h1">
                            <?php echo $overlay_text; ?>
                        </div>
                        <div class="button-container">
                            <a target="_blank" href="#form">Ik heb interesse</a>
                        </div>
                        <div class="sales-banner">
                            <img src="<?= $sales_banner['url']; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>