<?php
// Retrieve all ACF fields at the top
$vinkjes_groep_links = get_sub_field('vinkjes_groep_links');
$vinkjes_groep_rechts = get_sub_field('vinkjes_groep_rechts');

// Prepare repeater data
$left_repeater = $vinkjes_groep_links['left_repeater'] ?? [];
$right_repeater = $vinkjes_groep_rechts['right_repeater'] ?? [];
?>

<?php if (!empty($left_repeater) || !empty($right_repeater)): ?>
    <section class="vinkjes">
        <div class="container">
            <div class="row">
                <!-- Left Column -->
                <div class="col-12 col-lg-6">
                    <?php if (!empty($left_repeater)): ?>
                        <?php foreach ($left_repeater as $item): ?>
                            <?php $vinkje_tekst = $item['vinkje_tekst'] ?? ''; ?>
                            <?php if ($vinkje_tekst): ?>
                                <div class="vinkje-item d-flex align-items-center">
                                    <!-- Replace SVG with PNG -->
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/check.png" alt="Check" width="20"
                                        height="16" class="me-2">

                                    <?php echo esc_html($vinkje_tekst); ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Right Column -->
                <div class="col-12 col-lg-6">
                    <?php if (!empty($right_repeater)): ?>
                        <?php foreach ($right_repeater as $item): ?>
                            <?php $vinkje_tekst = $item['vinkje_tekst'] ?? ''; ?>
                            <?php if ($vinkje_tekst): ?>
                                <div class="vinkje-item d-flex align-items-center rechts">
                                    <!-- Replace SVG with PNG -->
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/check.png" alt="Check" width="20"
                                        height="16" class="me-2">

                                    <?php echo esc_html($vinkje_tekst); ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>