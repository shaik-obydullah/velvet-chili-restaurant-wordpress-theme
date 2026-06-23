<?php

wp_footer();

if ( ! defined( 'OBIRC_VERSION' ) ) {
    ?>
<footer class="site-footer" id="siteFooter">
    <div class="site-footer__container">
        <div class="site-footer__bottom">
            <div class="site-footer__copyright">
                &copy; <?php echo date( 'Y' ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
            </div>
        </div>
    </div>
</footer>
<?php
    return;
}

$footer_posts = get_posts( array(
    'post_type'      => 'obirc_footer',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
) );

if ( empty( $footer_posts ) ) {
    ?>
<footer class="site-footer" id="siteFooter">
    <div class="site-footer__container">
        <div class="site-footer__bottom">
            <div class="site-footer__copyright">
                &copy; <?php echo date( 'Y' ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
            </div>
        </div>
    </div>
</footer>
<?php
    return;
}

$footer_id = $footer_posts[0]->ID;

$logo_text   = get_post_meta( $footer_id, 'obirc_footer_logo_text', true );
$logo_accent = get_post_meta( $footer_id, 'obirc_footer_logo_accent', true );
$tagline     = get_post_meta( $footer_id, 'obirc_footer_tagline', true );
$social      = get_post_meta( $footer_id, 'obirc_footer_social', true );
$links       = get_post_meta( $footer_id, 'obirc_footer_links', true );
$address     = get_post_meta( $footer_id, 'obirc_footer_address', true );
$phone       = get_post_meta( $footer_id, 'obirc_footer_phone', true );
$email       = get_post_meta( $footer_id, 'obirc_footer_email', true );
$copyright   = get_post_meta( $footer_id, 'obirc_footer_copyright', true );

$logo_text   = $logo_text ?: __( 'Obydullah', 'obydullah-restaurant' );
$logo_accent = $logo_accent ?: __( 'Restaurant', 'obydullah-restaurant' );
$tagline     = $tagline ?: __( 'A modern dining experience built around the soul of the chili pepper. Slow‑cooked, bold, and unforgettable.', 'obydullah-restaurant' );
$copyright   = $copyright ?: sprintf( __( '&copy; %s Obydullah Restaurant Theme. All rights reserved.', 'obydullah-restaurant' ), date( 'Y' ) );
?>

<footer class="site-footer" id="siteFooter">
    <div class="site-footer__container">
        <div class="site-footer__grid">
            <div class="site-footer__col site-footer__col--about">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__logo">
                    <span class="site-footer__logo-icon"><i class="fa-solid fa-pepper-hot"></i></span>
                    <span class="site-footer__logo-text"><?php echo esc_html( $logo_text ); ?><span
                            class="site-footer__logo-accent"><?php echo esc_html( $logo_accent ); ?></span></span>
                </a>
                <p class="site-footer__desc"><?php echo esc_html( $tagline ); ?></p>
                <div class="site-footer__social">
                    <?php if ( ! empty( $social['instagram'] ) ) : ?>
                    <a href="<?php echo esc_url( $social['instagram'] ); ?>"
                        aria-label="<?php esc_attr_e( 'Instagram', 'obydullah-restaurant' ); ?>" target="_blank"><i
                            class="fa-brands fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if ( ! empty( $social['facebook'] ) ) : ?>
                    <a href="<?php echo esc_url( $social['facebook'] ); ?>"
                        aria-label="<?php esc_attr_e( 'Facebook', 'obydullah-restaurant' ); ?>" target="_blank"><i
                            class="fa-brands fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if ( ! empty( $social['x'] ) ) : ?>
                    <a href="<?php echo esc_url( $social['x'] ); ?>"
                        aria-label="<?php esc_attr_e( 'X', 'obydullah-restaurant' ); ?>" target="_blank"><i
                            class="fa-brands fa-x-twitter"></i></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="site-footer__col site-footer__col--links">
                <h4 class="site-footer__heading"><?php esc_html_e( 'Quick Links', 'obydullah-restaurant' ); ?></h4>
                <?php if ( ! empty( $links ) ) : ?>
                <ul class="site-footer__links">
                    <?php foreach ( $links as $link ) : ?>
                    <li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['text'] ); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>

            <div class="site-footer__col site-footer__col--contact">
                <h4 class="site-footer__heading"><?php esc_html_e( 'Contact', 'obydullah-restaurant' ); ?></h4>
                <ul class="site-footer__contact">
                    <?php if ( ! empty( $address ) ) : ?>
                    <li><i
                            class="fa-solid fa-location-dot"></i><span><?php echo nl2br( esc_html( $address ) ); ?></span>
                    </li>
                    <?php endif; ?>
                    <?php if ( ! empty( $phone ) ) : ?>
                    <li><i class="fa-solid fa-phone"></i><a
                            href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></li>
                    <?php endif; ?>
                    <?php if ( ! empty( $email ) ) : ?>
                    <li><i class="fa-regular fa-envelope"></i><a
                            href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="site-footer__bottom">
            <div class="site-footer__copyright"><?php echo wp_kses_post( $copyright ); ?></div>
        </div>
    </div>
</footer>