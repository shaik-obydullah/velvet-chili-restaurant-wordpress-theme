<?php
/**
 * Single Post Template
 * Displays a single blog post with full content, featured image, and comments.
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="single-post-wrapper">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php if ( has_post_thumbnail() ) : ?>
            <div class="single-post__thumbnail">
                <?php the_post_thumbnail( 'large' ); ?>
            </div>
            <?php endif; ?>

            <header class="single-post__header">
                <h1 class="single-post__title"><?php the_title(); ?></h1>

                <div class="single-post__meta">
                    <span class="single-post__date">
                        <i class="fa-regular fa-calendar"></i>
                        <?php echo get_the_date(); ?>
                    </span>
                    <span class="single-post__author">
                        <i class="fa-regular fa-user"></i>
                        <?php the_author(); ?>
                    </span>
                    <?php if ( has_category() ) : ?>
                    <span class="single-post__categories">
                        <i class="fa-regular fa-folder"></i>
                        <?php the_category( ', ' ); ?>
                    </span>
                    <?php endif; ?>
                </div>
            </header>

            <div class="single-post__content">
                <?php the_content(); ?>
            </div>

        </article>

        <!-- Post Navigation -->
        <?php
        $prev_post = get_previous_post();
        $next_post = get_next_post();
        if ( $prev_post || $next_post ) : ?>
        <div class="single-post__navigation">
            <?php if ( $prev_post ) : ?>
            <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="single-post__nav-link">
                &laquo; <?php echo esc_html( $prev_post->post_title ); ?>
            </a>
            <?php endif; ?>

            <?php if ( $next_post ) : ?>
            <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="single-post__nav-link">
                <?php echo esc_html( $next_post->post_title ); ?> &raquo;
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Comments -->
        <div class="single-post__comments">
            <?php if ( comments_open() || get_comments_number() ) : ?>
            <?php comments_template(); ?>
            <?php endif; ?>
        </div>

        <?php endwhile; endif; ?>

    </div>
</main>

<?php get_footer(); ?>