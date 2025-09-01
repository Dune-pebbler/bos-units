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
                        <img class="form-logo" src="<?php echo get_template_directory_uri(); ?>/images/wit_logo.png"
                            alt="Wit logo">
                        <div class="basis-contact">
                            <a href="https://basis.nl/">
                                <img class="basis-logo"
                                    src="<?php echo get_template_directory_uri(); ?>/images/basis.png"
                                    alt="logo van basis">
                                <p>(071) 5 233 277<br>
                                    leiden@basis.nl</p>
                            </a>
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