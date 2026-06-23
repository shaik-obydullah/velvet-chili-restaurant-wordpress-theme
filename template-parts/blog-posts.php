<?php
/**
 * Template Part: Blog Posts
 * Displays the blog posts loop when the plugin is inactive.
 */

?>

<div class="container blog-index">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e( 'Latest Posts', 'obydullah-restaurant' ); ?></h1>
    </header>

    <?php if ( have_posts() ) : ?>
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
    <p><?php esc_html_e( 'No posts found.', 'obydullah-restaurant' ); ?></p>
    <?php endif; ?>
</div>