<?php
/*
 * =================================================================
 * Theme Name: Obydullah Restaurant
 * Version: 1.0.3
 * Author: Shaik Obydullah
 * Author URI: https://obydullah.com
 * Purpose: Obydullah Restaurant Theme Functions
 * =================================================================
 */

/**
 * INDEX
 * 1. Assets
 * 2. Theme Setup
 * 3. Sidebar / Widget Area
 * 4. Customizer Settings
 * 5. Admin Notice
 */

/* ======================================================
   1. Assets
====================================================== */

function obirc_assets() {

    wp_enqueue_style(
        'obirc-font-awesome',
        get_template_directory_uri() . '/assets/vendor/fontawesome/css/all.min.css',
        [],
        '7.2.0'
    );

    wp_enqueue_style(
        'obirc-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'obirc-base',
        get_template_directory_uri() . '/assets/css/obirc-base.css',
        [],
        '1.0'
    );

    wp_enqueue_style(
        'obirc-theme',
        get_template_directory_uri() . '/assets/css/obirc-theme.css',
        ['obirc-base'],
        '1.0'
    );

    wp_enqueue_script(
        'obirc-js',
        get_template_directory_uri() . '/assets/js/obirc-main.js',
        [],
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'obirc_assets');

function obirc_theme_enqueue_booking_assets() {
    if ( defined( 'OBIRC_VERSION' ) ) {
        wp_enqueue_script(
            'obirc-booking',
            get_template_directory_uri() . '/assets/js/obirc-booking.js',
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
add_action( 'wp_enqueue_scripts', 'obirc_theme_enqueue_booking_assets' );


/* ======================================================
   2. Theme Setup
====================================================== */
function obirc_setup() {

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
        'primary' => __('Primary Menu', 'obydullah-restaurant'),
    ]);
}
add_action('after_setup_theme', 'obirc_setup');


/* ======================================================
   3. Sidebar / Widget Area
====================================================== */
function obirc_widgets_init() {

    register_sidebar([
        'name'          => __('Sidebar', 'obydullah-restaurant'),
        'id'            => 'sidebar-1',
        'description'   => __('Main sidebar area', 'obydullah-restaurant'),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'obirc_widgets_init');

/* ======================================================
 *  4. Customizer Settings
 * ====================================================== */

function obirc_customize_register($wp_customize) {

    $wp_customize->add_section('obirc_contact_info', [
        'title'    => __('Contact Info', 'obydullah-restaurant'),
        'priority' => 30,
    ]);

    $wp_customize->add_setting('obirc_phone', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('obirc_phone', [
        'label'   => __('Phone Number', 'obydullah-restaurant'),
        'section' => 'obirc_contact_info',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('obirc_hours', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('obirc_hours', [
        'label'   => __('Opening Hours', 'obydullah-restaurant'),
        'section' => 'obirc_contact_info',
        'type'    => 'text',
    ]);
}
add_action('customize_register', 'obirc_customize_register');


/* ======================================================
 *  5. Admin Notice
 * ====================================================== */
function obirc_admin_notice() {
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
    <p><strong><?php esc_html_e( 'Obydullah Restaurant Theme', 'obydullah-restaurant' ); ?></strong> —
        <?php esc_html_e( 'Install recommended plugins:', 'obydullah-restaurant' ); ?></p>
    <ul style="list-style: disc; margin-left: 1.5em;">
        <?php if ( ! $core_active ) : ?>
        <li><strong>Obydullah Restaurant Core</strong> –
            <?php esc_html_e( 'menu & testimonials system', 'obydullah-restaurant' ); ?></li>
        <?php endif; ?>
        <?php if ( ! $cf7_active ) : ?>
        <li><strong>Contact Form 7</strong> –
            <?php esc_html_e( 'contact form support', 'obydullah-restaurant' ); ?></li>
        <?php endif; ?>
    </ul>
    <p>
        <a href="<?php echo esc_url( admin_url( 'plugin-install.php?s=obydullah+restaurant+core&tab=search&type=term' ) ); ?>"
            class="button button-primary">
            <?php esc_html_e( 'Install Plugins', 'obydullah-restaurant' ); ?>
        </a>
    </p>
</div>
<?php
}
add_action( 'admin_notices', 'obirc_admin_notice' );