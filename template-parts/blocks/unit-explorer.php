<?php
/**
 * Unit Explorer Block
 * Interactive SVG map with unit information
 */

$svg_file = get_sub_field('unit_map_svg');

// Pre-load all unit data for instant display
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
            $units_data[$bouwnummer] = array(
                'bouwnummer' => $bouwnummer,
                'status' => get_field('status', $post_id),
                'oppervlakte' => get_field('oppervlakte', $post_id),
                'prijs' => get_field('prijs', $post_id)
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
            <div class="unit-explorer-map">
                <?php
                // Get the SVG file content
                $svg_path = get_attached_file($svg_file['ID']);
                if (file_exists($svg_path)) {
                    echo file_get_contents($svg_path);
                }
                ?>
            </div>

            <!-- Hover tooltip -->
            <div class="unit-tooltip" id="unit-tooltip">
                <div class="unit-tooltip-content" id="unit-tooltip-content">
                    <!-- Content loaded via JavaScript -->
                </div>
            </div>

            <!-- Modal for unit details -->
            <div class="unit-modal" id="unit-modal">
                <div class="unit-modal-overlay"></div>
                <div class="unit-modal-content">
                    <button class="unit-modal-close" id="unit-modal-close">&times;</button>
                    <div class="unit-modal-body" id="unit-modal-body">
                        <!-- Content loaded via JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
