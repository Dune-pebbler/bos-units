<?php
$categories = get_sub_field('sales_download_categories');
?>

<?php if (!empty($categories)): ?>
    <section class="sales-downloads">
        <div class="container">
            <h2>Downloads</h2>

            <div class="sales-downloads-content">
                <?php foreach ($categories as $category): ?>
                    <?php
                    $category_title = $category['category_title'] ?? '';
                    $download_items = $category['download_items'] ?? [];
                    ?>

                    <?php if ($category_title && !empty($download_items)): ?>
                        <div class="sales-download-category">
                            <h3><?php echo esc_html($category_title); ?></h3>

                            <ul class="sales-download-list">
                                <?php foreach ($download_items as $item): ?>
                                    <?php
                                    $item_title = $item['item_title'] ?? '';
                                    $item_file = $item['item_file'] ?? '';
                                    $file_url = is_array($item_file) ? ($item_file['url'] ?? '') : $item_file;
                                    ?>

                                    <?php if ($item_title && $file_url): ?>
                                        <li>
                                            <a href="<?php echo esc_url($file_url); ?>" target="_blank">
                                                <?php echo esc_html($item_title); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>