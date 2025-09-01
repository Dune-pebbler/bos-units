<?php
// Retrieve all ACF fields at the top
$downloads_groep_links = get_sub_field('download_groep_links');
$downloads_groep_rechts = get_sub_field('download_groep_rechts');

// Prepare repeater data
$left_repeater = $downloads_groep_links['left_repeater'] ?? [];
$right_repeater = $downloads_groep_rechts['right_repeater'] ?? [];
?>

<?php if (!empty($left_repeater) || !empty($right_repeater)): ?>
    <section id="download" class="downloads">


        <div class="container">
            <h2>Downloads</h2>
            <div class="row">
                <!-- Left Column -->
                <div class="col-12 col-lg-6">
                    <?php if (!empty($left_repeater)): ?>
                        <?php foreach ($left_repeater as $item): ?>
                            <?php $download_tekst = $item['download_tekst'] ?? ''; ?>
                            <?php $download_pdf = $item['download_pdf']['url'] ?? ''; ?>
                            <?php if ($download_tekst && $download_pdf): ?>
                                <div class="download-item d-flex align-items-center">
                                    <!-- Replace SVG with PNG -->
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/Download-icon.png" alt="Download-icon"
                                        width="20" height="16" class="me-2">

                                    <a target="_blank" href="<?php echo $download_pdf ?>"><?php echo esc_html($download_tekst); ?></a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Right Column -->
                <div class="col-12 col-lg-6">
                    <?php if (!empty($right_repeater)): ?>
                        <?php foreach ($right_repeater as $item): ?>
                            <?php $download_tekst = $item['download_tekst'] ?? ''; ?>
                            <?php $download_pdf = $item['download_pdf']['url'] ?? ''; ?>
                            <?php if ($download_tekst && $download_pdf): ?>
                                <div class="download-item d-flex align-items-center">
                                    <!-- Replace SVG with PNG -->
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/Download-icon.png" alt="Download-icon"
                                        width="20" height="16" class="me-2">

                                    <a target="_blank" href="<?php echo $download_pdf ?>"><?php echo esc_html($download_tekst); ?></a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>