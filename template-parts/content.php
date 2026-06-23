<?php
/**
 * Template Part: Content
 * Displays a single post in the blog loop.
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item' ); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="post-item__thumbnail">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'medium_large' ); ?>
        </a>
    </div>
    <?php endif; ?>

    <div class="post-item__content">
        <header class="post-item__header">
            <?php the_title( '<h2 class="post-item__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>

            <div class="post-item__meta">
                <span class="post-item__date">
                    <i class="fa-regular fa-calendar"></i>
                    <?php echo get_the_date(); ?>
                </span>
                <span class="post-item__author">
                    <i class="fa-regular fa-user"></i>
                    <?php the_author(); ?>
                </span>
                <?php if ( has_category() ) : ?>
                <span class="post-item__categories">
                    <i class="fa-regular fa-folder"></i>
                    <?php the_category( ', ' ); ?>
                </span>
                <?php endif; ?>
            </div>
        </header>

        <div class="post-item__excerpt">
            <?php the_excerpt(); ?>
        </div>

        <footer class="post-item__footer">
            <a href="<?php the_permalink(); ?>" class="post-item__read-more">
                <?php esc_html_e( 'Read More', 'obydullah-restaurant' ); ?>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </footer>
    </div>

</article>