<?php
/**
 * Tag Archive Template
 * Displays posts for a specific tag.
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container archive-wrapper">

        <header class="archive-header">
            <h1 class="archive-title">
                <?php
                printf(
                    esc_html__( 'Tag: %s', 'obydullah-restaurant' ),
                    '<span>' . single_tag_title( '', false ) . '</span>'
                );
                ?>
            </h1>
            <?php if ( tag_description() ) : ?>
            <div class="archive-description"><?php echo tag_description(); ?></div>
            <?php endif; ?>
        </header>

        <?php if ( have_posts() ) : ?>
        <div class="posts-grid">
            <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'template-parts/content', get_post_type() ); ?>
            <?php endwhile; ?>
        </div>
        <div class="pagination-wrapper">
            <?php the_posts_pagination(); ?>
        </div>
        <?php else : ?>
        <p><?php esc_html_e( 'No posts found.', 'obydullah-restaurant' ); ?></p>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>