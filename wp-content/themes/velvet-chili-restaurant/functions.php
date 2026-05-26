<?php
/**
 * Velvet Chili Theme Functions
 */

function velvet_chili_assets() {

    wp_enqueue_style(
        'velvet-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        [],
        '6.5.1'
    );

    wp_enqueue_style('velvet-base', get_template_directory_uri() . '/assets/css/base.css', [], '1.0');
    wp_enqueue_style('velvet-theme', get_template_directory_uri() . '/assets/css/theme.css', ['velvet-base'], '1.0');

    wp_enqueue_script('velvet-js', get_template_directory_uri() . '/assets/js/main.js', [], '1.0', true);
}

add_action('wp_enqueue_scripts', 'velvet_chili_assets');

function velvet_chili_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'velvet-chili' ),
    ) );
}
add_action( 'after_setup_theme', 'velvet_chili_setup' );

function velvet_chili_primary_menu_fallback() {
    ?>
<ul class="nav__list">
    <li class="nav__item">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="nav__link nav__link--active">Home</a>
    </li>
    <li class="nav__item">
        <a href="#chefSpecial" class="nav__link">Chef Special</a>
    </li>
    <li class="nav__item">
        <a href="#ourMenu" class="nav__link">Our Menu</a>
    </li>
    <li class="nav__item">
        <a href="#testimonials" class="nav__link">Testimonials</a>
    </li>
    <li class="nav__item">
        <a href="#book" class="nav__link nav__link--cta">Book A Table</a>
    </li>
</ul>
<?php
}

function velvet_chili_mobile_menu_fallback() {
    ?>
<ul class="mobile-nav__list">

    <li class="mobile-nav__item">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="mobile-nav__link mobile-nav__link--active">Home</a>
    </li>

    <li class="mobile-nav__item">
        <a href="#chefSpecial" class="mobile-nav__link">Chef Special</a>
    </li>

    <li class="mobile-nav__item">
        <a href="#ourMenu" class="mobile-nav__link">Our Menu</a>
    </li>

    <li class="mobile-nav__item">
        <a href="#testimonials" class="mobile-nav__link">Testimonials</a>
    </li>

    <li class="mobile-nav__item">
        <a href="#book" class="mobile-nav__link mobile-nav__link--cta">Book A Table</a>
    </li>

</ul>
<?php
}

function velvet_chili_customize_register($wp_customize) {

    $wp_customize->add_section('vchs_contact_info', [
        'title' => 'Contact Info',
    ]);

    // Phone
    $wp_customize->add_setting('vchs_phone');
    $wp_customize->add_control('vchs_phone', [
        'label' => 'Phone Number',
        'section' => 'vchs_contact_info',
        'type' => 'text',
    ]);

    // Opening Hours
    $wp_customize->add_setting('vchs_hours');
    $wp_customize->add_control('vchs_hours', [
        'label' => 'Opening Hours',
        'section' => 'vchs_contact_info',
        'type' => 'text',
    ]);
}
add_action('customize_register', 'velvet_chili_customize_register');