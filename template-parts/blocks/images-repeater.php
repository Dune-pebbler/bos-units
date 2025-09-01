<?php
// Retrieve all ACF fields at the top
$image_repeater = have_rows('image_repeater'); // Check if the repeater field exists
$image_repeater_items = []; // Initialize an empty array to store image data

if ($image_repeater) {
    while (have_rows('image_repeater')) {
        the_row();
        $image = get_sub_field('image'); // Fetch the 'image' subfield for each repeater row
        if ($image) {
            $image_repeater_items[] = [
                'url' => esc_url($image['url']),
                'alt' => esc_attr($image['alt']),
            ];
        }
    }
}
?>

<section class="images-repeater">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if (!empty($image_repeater_items)): ?>
                    <div class="owl-carousel image-repeater-carousel">
                        <?php foreach ($image_repeater_items as $image_item): ?>
                            <div class="carousel-item">
                                <img src="<?php echo $image_item['url']; ?>" alt="<?php echo $image_item['alt']; ?>"
                                    class="img-fluid">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No images found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>