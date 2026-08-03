<?php
get_header(); ?>

<main id="primary" class="site-main">
    <div class="container error-404-wrapper">
        <section class="error-404">
            <span class="error-icon">🍽️</span>
            <h1 class="error-title"><?php esc_html_e( '404', 'velvet-chili-restaurant' ); ?></h1>
            <h2 class="error-subtitle"><?php esc_html_e( 'Page Not Found', 'velvet-chili-restaurant' ); ?></h2>
            <p class="error-message">
                <?php esc_html_e( 'Oops! The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'velvet-chili-restaurant' ); ?>
            </p>
            <div class="error-actions">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
                    <i class="fa-solid fa-house"></i>
                    <?php esc_html_e( 'Go Home', 'velvet-chili-restaurant' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/menu' ) ); ?>" class="btn btn-secondary">
                    <i class="fa-solid fa-utensils"></i>
                    <?php esc_html_e( 'View Our Menu', 'velvet-chili-restaurant' ); ?>
                </a>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>