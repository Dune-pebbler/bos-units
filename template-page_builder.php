<?php
/*
 * Template Name: Page Builder
 */
?>

<?php get_header(); ?>

<?php if (have_rows('pagebuilder')): ?>
    <?php while (have_rows('pagebuilder')):
        the_row(); ?>

        <?php if (get_row_layout() === 'text_block'): ?>
            <?php get_template_part('template-parts/blocks/text_block'); ?>
        <?php endif; ?>

        <?php if (get_row_layout() === 'hero_banner'): ?>
            <?php get_template_part('template-parts/blocks/hero_banner'); ?>
        <?php endif; ?>

        <?php if (get_row_layout() === 'text_with_image'): ?>
            <?php get_template_part('template-parts/blocks/text_with_image'); ?>
        <?php endif; ?>

        <?php if (get_row_layout() === 'text_with_small_image'): ?>
            <?php get_template_part('template-parts/blocks/text_with_small_image'); ?>
        <?php endif; ?>

        <?php if (get_row_layout() === 'text_block_svg'): ?>
            <?php get_template_part('template-parts/blocks/text_block_svg'); ?>
        <?php endif; ?>

        <?php if (get_row_layout() === 'cards'): ?>
            <?php get_template_part('template-parts/blocks/cards'); ?>
        <?php endif; ?>

        <?php if (get_row_layout() === 'inspiratie'): ?>
            <?php get_template_part('template-parts/blocks/inspiration'); ?>
        <?php endif; ?>

        <?php if (get_row_layout() === 'vinkjes'): ?>
            <?php get_template_part('template-parts/blocks/vinkjes'); ?>
        <?php endif; ?>

        <?php if (get_row_layout() === 'download'): ?>
            <?php get_template_part('template-parts/blocks/downloads'); ?>
        <?php endif; ?>

        <?php if (get_row_layout() === 'images_repeater'): ?>
            <?php get_template_part('template-parts/blocks/images-repeater'); ?>
        <?php endif; ?>

        <?php if (get_row_layout() === '3_image_block'): ?>
            <?php get_template_part('template-parts/blocks/3-images'); ?>
        <?php endif; ?>

        <?php if (get_row_layout() === 'slider'): ?>
            <?php get_template_part('template-parts/blocks/slider'); ?>
        <?php endif; ?>

        <?php if (get_row_layout() === 'latest-news'): ?>
            <?php get_template_part('template-parts/blocks/news-snippet'); ?>
        <?php endif; ?>

        <?php if (get_row_layout() === 'partners_snippet'): ?>
            <?php get_template_part('template-parts/blocks/partners-snippet'); ?>
        <?php endif; ?>

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>