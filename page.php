<?php get_header(); ?>
<div class="container">
    <div class="row justify-content-center" style="padding:200px 0px;">
        <div class="col-12 col-xl-6 col-lg-8 privacy">
            <?php the_content(); ?>
        </div>
    </div>
</div>
<style>
    .privacy p {
        color: black;

    }

    .privacy h2 {
        color: black;
    }

    .privacy * {
        z-index: 999;
        position: relative;
    }
</style>

<?php get_footer(); ?>