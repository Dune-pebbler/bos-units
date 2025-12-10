<?php
/**
 * Unit Explorer Block
 * Interactive SVG map with unit information
 */

$svg_file = get_sub_field('unit_map_svg');
?>

<?php if ($svg_file): ?>
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
