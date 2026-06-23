<?php
/**
 * Archive Template
 * Displays category, tag, date, author archives.
 */

get_header(); ?>

<style>

</style>

<main id="primary" class="site-main">
    <div class="container archive-wrapper">

        <?php if ( have_posts() ) : ?>

        <header class="archive-header">
            <?php
                the_archive_title( '<h1 class="archive-title">', '</h1>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
        </header>

        <div class="posts-grid">
            <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'template-parts/content', get_post_type() ); ?>
            <?php endwhile; ?>
        </div>

        <div class="pagination-wrapper">
            <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '&laquo; Previous', 'obydullah-restaurant' ),
                    'next_text' => __( 'Next &raquo;', 'obydullah-restaurant' ),
                ) );
                ?>
        </div>

        <?php else : ?>

        <p class="no-content"><?php esc_html_e( 'No content found.', 'obydullah-restaurant' ); ?></p>

        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>