<?php
/**
 * Template Name: Contact Page
 * Displays dynamic content from the Contact Page CPT (obirc_contact_page).
 */

get_header();

if ( ! function_exists( 'obirc_get_first_cf7_shortcode' ) ) {
    function obirc_get_first_cf7_shortcode() {
        if ( ! defined( 'WPCF7_VERSION' ) ) return '';
        $forms = get_posts( array(
            'post_type'      => 'wpcf7_contact_form',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        ) );
        if ( empty( $forms ) ) return '';
        return '[contact-form-7 id="' . (int) $forms[0]->ID . '" title="' . esc_attr( $forms[0]->post_title ) . '"]';
    }
}

// Default static values (fallback)
$kicker   = 'Get In Touch';
$title    = 'Contact Us';
$subtitle = 'We\'d love to hear from you. Reach out for reservations, private events, or just to say hello.';
$address  = '427 Spice Avenue, Gastronomy District, NY 10012';
$phone    = '(555) 123-4567';
$email    = 'hello@obydullahrestaurant.com';
$map_url  = '';
$form_shortcode = '';

// If plugin is active, fetch data from the Contact Page CPT
if ( defined( 'OBIRC_VERSION' ) ) {
    $contact_posts = get_posts( array(
        'post_type'      => 'obirc_contact_page',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
    ) );

    if ( ! empty( $contact_posts ) ) {
        $contact_id = $contact_posts[0]->ID;

        // Use post title as page title (or fallback to static)
        $title = get_the_title( $contact_id ) ?: $title;

        // Retrieve contact meta fields
        $address  = get_post_meta( $contact_id, 'obirc_contact_address', true );
        $phone    = get_post_meta( $contact_id, 'obirc_contact_phone', true );
        $email    = get_post_meta( $contact_id, 'obirc_contact_email', true );
        $map_url  = get_post_meta( $contact_id, 'obirc_contact_map_embed', true );
        $form_shortcode = get_post_meta( $contact_id, 'obirc_contact_form_shortcode', true );

        // Fallback for empty fields
        $address  = $address ?: '427 Spice Avenue, Gastronomy District, NY 10012';
        $phone    = $phone ?: '(555) 123-4567';
        $email    = $email ?: 'hello@obydullahrestaurant.com';
    }
}

// Determine which form shortcode to use (from CPT or auto‑detected CF7)
$cf7_active = defined( 'WPCF7_VERSION' );
$display_form = $form_shortcode ?: ( $cf7_active ? obirc_get_first_cf7_shortcode() : '' );
?>

<section class="contact-page" id="contact">
    <div class="contact-page__container">
        <div class="contact-page__header text-center">
            <span class="contact-page__kicker"><?php echo esc_html( $kicker ); ?></span>
            <h2 class="contact-page__title"><?php echo esc_html( $title ); ?></h2>
            <p class="contact-page__subtitle"><?php echo esc_html( $subtitle ); ?></p>
        </div>

        <div class="contact-page__grid">
            <!-- Left column: Contact form -->
            <div class="contact-page__form">
                <?php if ( ! empty( $display_form ) ) : ?>
                <?php echo do_shortcode( $display_form ); ?>
                <?php elseif ( $cf7_active && empty( $display_form ) ) : ?>
                <div class="cf7-notice">
                    <p><strong><?php esc_html_e( 'No contact form found.', 'obydullah-restaurant' ); ?></strong></p>
                    <p><?php esc_html_e( 'Please create a form in Contact Form 7 → Add New, then publish it.', 'obydullah-restaurant' ); ?>
                    </p>
                </div>
                <?php else : ?>
                <div class="cf7-notice">
                    <p><strong><?php esc_html_e( 'Contact Form 7 plugin is not active.', 'obydullah-restaurant' ); ?></strong>
                    </p>
                    <p><?php esc_html_e( 'To use this contact form, please install and activate the free Contact Form 7 plugin from the WordPress plugin repository.', 'obydullah-restaurant' ); ?>
                    </p>
                    <p><a href="<?php echo esc_url( admin_url( 'plugin-install.php?s=contact+form+7&tab=search&type=term' ) ); ?>"
                            target="_blank"><?php esc_html_e( 'Install Contact Form 7 →', 'obydullah-restaurant' ); ?></a>
                    </p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right column: Contact info & map -->
            <div class="contact-page__info">
                <div class="contact-info">
                    <h3 class="contact-info__title">
                        <?php esc_html_e( 'Obydullah Restaurant', 'obydullah-restaurant' ); ?></h3>
                    <ul class="contact-info__list">
                        <li><i class="fa-solid fa-location-dot"></i> <span><?php echo esc_html( $address ); ?></span>
                        </li>
                        <li><i class="fa-solid fa-phone"></i> <a
                                href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></li>
                        <li><i class="fa-regular fa-envelope"></i> <a
                                href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                        </li>
                    </ul>
                </div>
                <?php if ( ! empty( $map_url ) ) : ?>
                <div class="contact-map">
                    <iframe src="<?php echo esc_url( $map_url ); ?>" width="100%" height="250" style="border:0;"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>