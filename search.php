<?php get_header(); ?>
<main>
  <section class="intro-content search">
    <div class="container">
      <div class="col">
        <div class="page-header">
          <h1><?php _e('Zoeken naar:', 'search'); ?> '<?php the_search_query(); ?>'</h1>
        </div>
        <?php if (have_posts()) {
          while (have_posts()) : the_post();
            ?>
            <div class="result">
              <?php
              $post_type = get_post_type(get_the_ID());
              if ($post_type == 'page'): $post_type = __('Pagina', 'search');
              endif;
              if ($post_type == 'post'): $post_type = __('Nieuws', 'search');
              endif;
              ?>
              <h2><span class="post-type"><?php echo $post_type; ?>:</span> <?php the_title(); ?></h2>
              <p class="clearfix">
                <?php if (get_field('intro')): ?>
                  <?php the_field('intro'); ?>
                  <?php
                else:
                  echo wp_trim_words(get_the_content(), $num_words = 75, '...');
                endif;
                ?>
              </p>
              <p><a class="btn btn-primary" href="<?php the_permalink(); ?>" role="button"><?php _e('Lees meer', 'search'); ?></a></p>
            </div>
            <hr>
          <?php endwhile;
          wp_reset_query();
          ?>
<?php } else { ?>
          <div class="result">
            <p><?php _e('Geen resultaten gevonden', 'search'); ?></p>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>