<?php
// Define all ACF fields at the top
$background_color = esc_attr(get_sub_field('background_color'));
$text_color = esc_attr(get_sub_field('text_color'));
$text_block = get_sub_field('text_block');
?>

<section class="text_block" style="background-color: <?php echo $background_color; ?>;">
    <div class="container">
        <div class="row <?php echo $text_color; ?>">
            <div class="col-md-2 "></div>
            <div class="col-md-8 col-sm-12">
                <div class="wsy h2-big">
                    <?php
                    if ($text_block):
                        echo $text_block;
                    else:
                        echo '<p>No text content available.</p>';
                    endif;
                    ?>
                </div>
            </div>
            <div class=" col-md-2"></div>
        </div>
    </div>
</section>