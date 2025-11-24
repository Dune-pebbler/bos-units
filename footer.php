</main>
<?php
$footer_links = get_field('footer_links', 'option');
?>
<footer>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="form-container">
                        <div class="form-title">
                            <h2 style="text-transform: uppercase;">Brochure ontvangen?</h2>
                            <p>Vul onderstaande gegevens in en we sturen u de digitale brochure met o.a. de
                                sfeerplattegronden.</p>
                        </div>
                        <div class="formbox" id="form">
                            <?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>
                        </div>
                        <?php
                        $footer_logo = get_field('footer_logo', 'option');
                        if ($footer_logo): ?>
                            <img class="form-logo" src="<?php echo esc_url($footer_logo['url']); ?>"
                                alt="<?php echo esc_attr($footer_logo['alt']); ?>">
                        <?php endif; ?>

                        <div class="basis-contact">
                            <?php
                            $contact_url = get_field('contact_url', 'option');
                            $contact_logo = get_field('contact_logo', 'option');
                            $contact_phone = get_field('contact_phone', 'option');
                            $contact_email = get_field('contact_email', 'option');

                            if ($contact_url): ?>
                                <a href="<?php echo esc_url($contact_url); ?>">
                                    <?php if ($contact_logo): ?>
                                        <img class="basis-logo"
                                            src="<?php echo esc_url($contact_logo['url']); ?>"
                                            alt="<?php echo esc_attr($contact_logo['alt']); ?>">
                                    <?php endif; ?>
                                    <p>
                                        <?php if ($contact_phone): ?>
                                            <?php echo esc_html($contact_phone); ?><br>
                                        <?php endif; ?>
                                        <?php if ($contact_email): ?>
                                            <?php echo esc_html($contact_email); ?>
                                        <?php endif; ?>
                                    </p>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="bottom-footer">
        <div class="container">
            <div class="row">
                <div class="col-12" style="justify-content:left;">
                    <div class="footer_links">
                        &copy; <?php echo date('Y'); ?>
                        <?php echo get_field('footer_content', 'option'); ?>
                        <?= $footer_links; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>