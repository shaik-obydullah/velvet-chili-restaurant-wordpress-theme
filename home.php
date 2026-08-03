<?php
get_header(); ?>

<main id="primary" class="site-main">
    <?php if ( defined( 'OBIRC_VERSION' ) ) : ?>
    <?php get_template_part( 'template-parts/hero', 'section' ); ?>
    <?php get_template_part( 'template-parts/chef', 'special' ); ?>
    <?php get_template_part( 'template-parts/our', 'menu' ); ?>
    <?php get_template_part( 'template-parts/testimonials' ); ?>
    <?php get_template_part( 'template-parts/reservation' ); ?>
    <?php else : ?>
    <?php get_template_part( 'template-parts/blog', 'posts' ); ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>