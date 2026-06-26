<?php
/**
 * Theme Name: Velvet Chili Restaurant 
 * Description: Velvet Chili Restaurant Theme Functions
 *
 * ================================================================
 *                         INDEX
 * ================================================================
 * 1. Assets
 * 2. Theme Setup
 * 3. Sidebar / Widget Area
 * 4. Fallback Menus
 * 5. Customizer Settings
 * 6. Admin Notice
 * ================================================================
 */

/* ======================================================
   1. Assets
====================================================== */

function velvet_chili_restaurant_assets() {

    wp_enqueue_style(
        'font-awesome',
        get_template_directory_uri() . '/assets/vendor/fontawesome/css/all.min.css',
        [],
        '7.2.0'
    );

    wp_enqueue_style(
        'vcr-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'vcr-base',
        get_template_directory_uri() . '/assets/css/base.css',
        [],
        '1.0'
    );

    wp_enqueue_style(
        'vcr-theme',
        get_template_directory_uri() . '/assets/css/theme.css',
        ['vcr-base'],
        '1.0'
    );

    wp_enqueue_script(
        'vcr-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'velvet_chili_restaurant_assets');

function vcr_enqueue_booking_assets() {
    if ( defined( 'OBIRC_VERSION' ) ) {
        wp_enqueue_script(
            'obirc-booking',
            get_template_directory_uri() . '/assets/js/booking.js',
            array( 'jquery' ),
            '1.0',
            true
        );
        wp_localize_script( 'obirc-booking', 'obirc_booking_ajax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'obirc_booking_nonce' ),
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'vcr_enqueue_booking_assets' );


/* ======================================================
   2. Theme Setup
====================================================== */
function velvet_chili_restaurant_setup() {

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');

    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');

    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ]);

    register_nav_menus([
        'primary' => __('Primary Menu', 'velvet-chili-restaurant'),
    ]);
}
add_action('after_setup_theme', 'velvet_chili_restaurant_setup');


/* ======================================================
   3. Sidebar / Widget Area
====================================================== */
function velvet_chili_restaurant_widgets_init() {

    register_sidebar([
        'name'          => __('Sidebar', 'velvet-chili-restaurant'),
        'id'            => 'sidebar-1',
        'description'   => __('Main sidebar area', 'velvet-chili-restaurant'),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'velvet_chili_restaurant_widgets_init');


/* ======================================================
 *  4. Fallback Menus
 * ====================================================== */
function vcr_primary_menu_fallback() {
    ?>
<ul class="nav__list">
    <li class="nav__item">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="nav__link nav__link--active">
            <?php esc_html_e( 'Home', 'velvet-chili-restaurant' ); ?>
        </a>
    </li>
    <li class="nav__item"><a href="#chefSpecial" class="nav__link">
            <?php esc_html_e( 'Chef Special', 'velvet-chili-restaurant' ); ?></a></li>
    <li class="nav__item"><a href="#ourMenu" class="nav__link">
            <?php esc_html_e( 'Our Menu', 'velvet-chili-restaurant' ); ?></a></li>
    <li class="nav__item"><a href="#testimonials" class="nav__link">
            <?php esc_html_e( 'Testimonials', 'velvet-chili-restaurant' ); ?></a></li>
    <li class="nav__item"><a href="#book" class="nav__link nav__link--cta">
            <?php esc_html_e( 'Book A Table', 'velvet-chili-restaurant' ); ?></a></li>
</ul>
<?php
}

function vcr_mobile_menu_fallback() {
    ?>
<ul class="mobile-nav__list">
    <li class="mobile-nav__item">
        <a href="<?php echo esc_url(home_url('/')); ?>"
            class="mobile-nav__link mobile-nav__link--active"><?php esc_html_e( 'Home', 'velvet-chili-restaurant' ); ?></a>
    </li>
    <li class="mobile-nav__item"><a href="#chefSpecial"
            class="mobile-nav__link"><?php esc_html_e( 'Chef Special', 'velvet-chili-restaurant' ); ?></a></li>
    <li class="mobile-nav__item"><a href="#ourMenu"
            class="mobile-nav__link"><?php esc_html_e( 'Our Menu', 'velvet-chili-restaurant' ); ?></a></li>
    <li class="mobile-nav__item"><a href="#testimonials"
            class="mobile-nav__link"><?php esc_html_e( 'Testimonials', 'velvet-chili-restaurant' ); ?></a></li>
    <li class="mobile-nav__item"><a href="#book"
            class="mobile-nav__link mobile-nav__link--cta"><?php esc_html_e( 'Book A Table', 'velvet-chili-restaurant' ); ?></a>
    </li>
</ul>
<?php
}

/* ======================================================
 *  5. Customizer Settings
 * ====================================================== */

function velvet_chili_restaurant_customize_register($wp_customize) {

    $wp_customize->add_section('velvet_chili_restaurant_contact_info', [
        'title'    => __('Contact Info', 'velvet-chili-restaurant'),
        'priority' => 30,
    ]);

    $wp_customize->add_setting('velvet_chili_restaurant_phone', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('velvet_chili_restaurant_phone', [
        'label'   => __('Phone Number', 'velvet-chili-restaurant'),
        'section' => 'velvet_chili_restaurant_contact_info',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('velvet_chili_restaurant_hours', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('velvet_chili_restaurant_hours', [
        'label'   => __('Opening Hours', 'velvet-chili-restaurant'),
        'section' => 'velvet_chili_restaurant_contact_info',
        'type'    => 'text',
    ]);
}
add_action('customize_register', 'velvet_chili_restaurant_customize_register');


/* ======================================================
 *  6. Admin Notice
 * ====================================================== */
function velvet_chili_restaurant_admin_notice() {
    $screen = get_current_screen();
    if ( $screen && $screen->base !== 'themes' ) {
        return;
    }

    $core_active = defined( 'OBIRC_VERSION' );
    $cf7_active  = defined( 'WPCF7_VERSION' );

    if ( $core_active && $cf7_active ) {
        return;
    }
    ?>
<div class="notice notice-info is-dismissible">
    <p><strong><?php esc_html_e( 'Velvet Chili Restaurant Theme', 'velvet-chili-restaurant' ); ?></strong> —
        <?php esc_html_e( 'Install recommended plugins:', 'velvet-chili-restaurant' ); ?></p>
    <ul style="list-style: disc; margin-left: 1.5em;">
        <?php if ( ! $core_active ) : ?>
        <li><strong>Velvet Chili Restaurant Core</strong> –
            <?php esc_html_e( 'menu & testimonials system', 'velvet-chili-restaurant' ); ?></li>
        <?php endif; ?>
        <?php if ( ! $cf7_active ) : ?>
        <li><strong>Contact Form 7</strong> –
            <?php esc_html_e( 'contact form support', 'velvet-chili-restaurant' ); ?></li>
        <?php endif; ?>
    </ul>
    <p>
        <a href="<?php echo esc_url( admin_url( 'plugin-install.php?s=velvet+chili+restaurant+core&tab=search&type=term' ) ); ?>"
            class="button button-primary">
            <?php esc_html_e( 'Install Plugins', 'velvet-chili-restaurant' ); ?>
        </a>
    </p>
</div>
<?php
}
add_action( 'admin_notices', 'velvet_chili_restaurant_admin_notice' );