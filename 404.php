<?php get_header(); ?>
<section class="error-404">
    <div class="container">
        <div class="row flex-center">
            <div class="col-12 col-lg-6 flex-center">
                <h1 style="margin: 0; padding: 15px 0;">Pagina niet gevonden</h1>
                <p>We hebben de pagina die u zocht niet kunnen vinden.</p>
                <div class="buttons">
                    <a href="<?= site_url(); ?>" class="btn">Terug naar homepagina</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>