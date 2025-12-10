<?php
$svg_file = get_sub_field('unit_map_svg');
$title = get_sub_field('unit_explorer_title');

$units_data = array();
$args = array(
    'post_type' => 'unit',
    'posts_per_page' => -1,
    'meta_key' => 'bouwnummer',
    'orderby' => 'meta_value_num',
    'order' => 'ASC'
);
$query = new WP_Query($args);
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        $bouwnummer = get_field('bouwnummer', $post_id);
        if ($bouwnummer) {
            // Get featured image
            $featured_image_url = '';
            if (has_post_thumbnail($post_id)) {
                $featured_image_url = get_the_post_thumbnail_url($post_id, 'large');
            }

            $units_data[$bouwnummer] = array(
                'id' => $post_id,
                'bouwnummer' => $bouwnummer,
                'status' => get_field('status', $post_id),
                'oppervlakte' => get_field('oppervlakte', $post_id),
                'prijs' => get_field('prijs', $post_id),
                'featured_image' => $featured_image_url,
                'download_brochure' => get_field('download_brochure', $post_id)['url'] ?? '',
                'download_ingetekende_plattegrond' => get_field('download_ingetekende_plattegrond', $post_id)['url'] ?? '',
                'download_plattegrond' => get_field('download_plattegrond', $post_id)['url'] ?? '',
                'download_technische_omschrijving' => get_field('download_technische_omschrijving', $post_id)['url'] ?? '',
                'download_inschrijflijst' => get_field('download_inschrijflijst', $post_id)['url'] ?? '',
            );
        }
    }
    wp_reset_postdata();
}
?>

<?php if ($svg_file): ?>
    <script>
        var unitExplorerData = <?php echo json_encode($units_data); ?>;
    </script>
    <section class="unit-explorer">
        <div class="container">
            <?php if ($title): ?>
                <h2 class="unit-explorer-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <div class="unit-explorer-map">
                <?php
                $svg_path = get_attached_file($svg_file['ID']);
                if (file_exists($svg_path)) {
                    echo file_get_contents($svg_path);
                }
                ?>
            </div>

            <div class="unit-tooltip" id="unit-tooltip">
                <div class="unit-tooltip-content" id="unit-tooltip-content"></div>
            </div>

            <div class="unit-modal" id="unit-modal">
                <div class="unit-modal-overlay"></div>
                <div class="unit-modal-content">
                    <button class="unit-modal-close" id="unit-modal-close">&times;</button>
                    <div class="unit-modal-body" id="unit-modal-body"></div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
