<?php
// Define all ACF fields at the top
$background_color = esc_attr(get_sub_field('background_color'));
$reverse_layout = get_sub_field('reverse_layout');
$text_color = esc_attr(get_sub_field('text_color'));
$text_image_txt = get_sub_field('text_image_txt');
$button_group = get_sub_field('text_image_group');
$text_image_map = get_sub_field('text_image_map');
$text_image_btn = get_sub_field('text_image_btn'); // Assuming this is an array with 'url' and 'title'
$text_image_btn_link = $text_image_btn['url'] ?? '';
$text_image_btn_title = $text_image_btn['title'] ?? '';
?>

<section id="locatie" class="text-with-image" style="background-color: <?php echo $background_color; ?>;">
    <div class="container-fluid">
        <div class="row<?php echo $reverse_layout ? ' reverse ' : ''; ?> <?php echo $text_color; ?>">
            <!-- Text Section -->
            <div class="col-lg-1 col-sm-2"></div>
            <div class="col-lg-4 col-sm-8" style="display: flex; align-items: center;">
                <div class="text_image">
                    <?php
                    if ($text_image_txt):
                        echo $text_image_txt;
                    else:
                        echo '<p>No text content available.</p>';
                    endif;
                    ?>

                    <?php if ($button_group): ?>
                        <div class="button-wrapper" style="margin-top: 20px;">
                            <?php
                            // Define button fields in $button_group
                            $button_text = $button_group['button_text'] ?? '';
                            $button_url = $button_group['button_url'] ?? '';
                            $button_style = $button_group['button_style'] ?? '';

                            if ($button_text && $button_url && $button_style): ?>
                                <a href="<?php echo esc_url($button_url); ?>" class="<?php echo esc_attr($button_style); ?>">
                                    <?php echo esc_html($button_text); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-1 col-sm-2"></div>
            <!-- Map Section -->
            <div class="col-lg-6 col-sm-12 map" style="padding: 0px;">
                <?php if ($text_image_map): ?>
                    <div class="acf-map" data-zoom="<?php echo esc_attr($text_image_map['zoom']); ?>">
                        <div class="marker" data-lat="<?php echo esc_attr($text_image_map['lat']); ?>"
                            data-lng="<?php echo esc_attr($text_image_map['lng']); ?>">
                            <h4><?php echo esc_html($text_image_map['address']); ?></h4>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($text_image_btn_title && $text_image_btn_link): ?>
                    <div class="btn">
                        <a target="_blank" href="<?php echo esc_url($text_image_btn_link); ?>">
                            <?php echo esc_html($text_image_btn_title); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
    .acf-map {
        width: 100%;
        height: 400px;
        border: none;
    }

    /* Fixes potential theme CSS conflict */
    .acf-map img {
        max-width: inherit !important;
    }
</style>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_js(acf_get_setting('google_api_key')); ?>"></script>
<script type="text/javascript">
    (function($) {
        /**
         * initMap
         * Renders a Google Map onto the selected jQuery element
         */
        function initMap($el) {
            // Find marker elements within map.
            var $markers = $el.find('.marker');

            // Create generic map.
            var mapArgs = {
                zoom: $el.data('zoom') || 16,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map($el[0], mapArgs);

            // Add markers.
            map.markers = [];
            $markers.each(function() {
                initMarker($(this), map);
            });

            // Center map based on markers.
            centerMap(map);

            // Return map instance.
            return map;
        }

        /**
         * initMarker
         * Creates a marker for the given jQuery element and map.
         */
        function initMarker($marker, map) {
            // Get position from marker.
            var lat = $marker.data('lat');
            var lng = $marker.data('lng');
            var latLng = {
                lat: parseFloat(lat),
                lng: parseFloat(lng)
            };

            // Create marker instance.
            var marker = new google.maps.Marker({
                position: latLng,
                map: map
            });

            // Append to reference for later use.
            map.markers.push(marker);

            // If marker contains HTML, add it to an infoWindow.
            if ($marker.html()) {
                // Create info window.
                var infowindow = new google.maps.InfoWindow({
                    content: $marker.html()
                });

                // Show info window when marker is clicked.
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map, marker);
                });
            }
        }

        /**
         * centerMap
         * Centers the map showing all markers in view.
         */
        function centerMap(map) {
            // Create map boundaries from all map markers.
            var bounds = new google.maps.LatLngBounds();
            map.markers.forEach(function(marker) {
                bounds.extend({
                    lat: marker.position.lat(),
                    lng: marker.position.lng()
                });
            });

            // Case: Single marker.
            if (map.markers.length == 1) {
                map.setCenter(bounds.getCenter());
            }
            // Case: Multiple markers.
            else {
                map.fitBounds(bounds);
            }
        }

        // Render maps on page load.
        $(document).ready(function() {
            $('.acf-map').each(function() {
                var map = initMap($(this));
            });
        });

    })(jQuery);
</script>