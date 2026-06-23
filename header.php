<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <a class="skip-link screen-reader-text" href="#primary">
        <?php esc_html_e( 'Skip to content', 'obydullah-restaurant' ); ?>
    </a>

    <!-- Header / Navbar -->
    <header class="site-header" id="siteHeader">
        <div class="header__container">
            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo"
                aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                <span class="logo__icon">
                    <i class="fa-solid fa-pepper-hot"></i>
                </span>
                <span class="logo__text">
                    <span class="logo__text--accent">
                        <?php echo esc_html(get_bloginfo('name')); ?>
                    </span>
                </span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="nav nav--desktop" id="desktopNav" aria-label="Main navigation">
                <?php
                    $menu_locations = get_nav_menu_locations();

                    if (isset($menu_locations['primary'])) {
                        $menu = wp_get_nav_menu_object($menu_locations['primary']);
                        $menu_items = wp_get_nav_menu_items($menu->term_id);

                        if ($menu_items) {
                            echo '<ul class="nav__list">';
                            foreach ($menu_items as $item) {
                                echo '<li class="nav__item">';
                                echo '<a href="' . esc_url($item->url) . '" class="nav__link">';
                                echo esc_html($item->title);
                                echo '</a>';
                                echo '</li>';
                            }
                            echo '</ul>';
                        }
                    }
                ?>
            </nav>

            <!-- Hamburger Toggle Button (Mobile) -->
            <button class="hamburger" id="hamburgerBtn" aria-label="Toggle navigation menu" aria-expanded="false"
                type="button">
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
                <span class="hamburger__line"></span>
            </button>
        </div>

        <!-- Mobile Navigation Overlay -->
        <div class="mobile-nav" id="mobileNav" aria-hidden="true">
            <div class="mobile-nav__backdrop"></div>
            <nav class="mobile-nav__panel" aria-label="Mobile navigation">
                <?php
                $menu_locations = get_nav_menu_locations();

                if (isset($menu_locations['primary'])) {
                    $menu = wp_get_nav_menu_object($menu_locations['primary']);
                    $menu_items = wp_get_nav_menu_items($menu->term_id);

                    if ($menu_items) {
                        echo '<ul class="mobile-nav__list">';
                        foreach ($menu_items as $item) {
                            echo '<li class="mobile-nav__item">';
                            echo '<a href="' . esc_url($item->url) . '" class="mobile-nav__link">';
                            echo esc_html($item->title);
                            echo '</a>';
                            echo '</li>';
                        }
                        echo '</ul>';
                    }
                }
                ?>

                <!-- Mobile Contact Info -->
                <div class="mobile-nav__info">
                    <p class="mobile-nav__phone">
                        <i class="fa-solid fa-phone"></i>
                        <?php echo esc_html( get_theme_mod('obirc_phone', '(555) 123-4567') ); ?>
                    </p>
                    <p class="mobile-nav__hours">
                        <i class="fa-regular fa-clock"></i>
                        <?php echo esc_html( get_theme_mod('obirc_hours', 'Tue–Sun 5pm–11pm') ); ?>
                    </p>
                </div>
            </nav>
        </div>
    </header>