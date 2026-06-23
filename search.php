<?php
get_header(); ?>

<main id="primary" class="site-main">
    <div class="container search-wrapper">

        <header class="search-header">
            <h1 class="search-title">
                <?php
                printf(
                    esc_html__( 'Search Results for: %s', 'obydullah-restaurant' ),
                    '<span>' . get_search_query() . '</span>'
                );
                ?>
            </h1>

            <?php if ( have_posts() ) : ?>
            <p class="search-results-count">
                <?php
                    printf(
                        esc_html( _n( '%d result found', '%d results found', $wp_query->found_posts, 'obydullah-restaurant' ) ),
                        $wp_query->found_posts
                    );
                    ?>
            </p>
            <?php endif; ?>
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

        <div class="no-results">
            <span class="no-results-icon">🔍</span>
            <h2 class="no-results-title"><?php esc_html_e( 'No Results Found', 'obydullah-restaurant' ); ?></h2>
            <p class="no-results-message">
                <?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'obydullah-restaurant' ); ?>
            </p>
            <?php get_search_form(); ?>
        </div>

        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>