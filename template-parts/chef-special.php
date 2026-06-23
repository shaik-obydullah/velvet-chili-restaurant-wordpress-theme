<?php
/**
 * Chef's Special Section
 * Displays a single Chef's Special post with image on left, text on right.
 */

if ( defined( 'OBIRC_VERSION' ) ) {

    $query = new WP_Query( array(
        'post_type'      => 'obirc_chef_special',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
    ) );

    if ( $query->have_posts() ) {
        $query->the_post();

        $image    = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        $title    = get_the_title();
        $subtitle = get_post_meta( get_the_ID(), 'obirc_subtitle', true );
        $body     = get_post_meta( get_the_ID(), 'obirc_body', true );

        wp_reset_postdata();
        ?>
<section class="menu-highlight" id="chefSpecial">
    <div class="menu-highlight__image">
        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
    </div>
    <div class="menu-highlight__text">
        <span class="menu-highlight__kicker">Chef's Special</span>
        <h2 class="menu-highlight__title"><?php echo esc_html( $title ); ?></h2>
        <p class="menu-highlight__subtitle"><?php echo esc_html( $subtitle ); ?></p>
        <div class="menu-highlight__body"><?php echo wp_kses_post( $body ); ?></div>
    </div>
</section>
<?php
    } else {
        ?>
<section class="menu-highlight" id="chefSpecial">
    <div class="menu-highlight__image">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/chef-special.jpg' ); ?>"
            alt="Chef's Special" loading="lazy">
    </div>
    <div class="menu-highlight__text">
        <span class="menu-highlight__kicker">Chef's Special</span>
        <h2 class="menu-highlight__title">Coming Soon</h2>
        <p class="menu-highlight__subtitle">Our chef is preparing something extraordinary</p>
        <p class="menu-highlight__body">Check back later to discover today's signature dish.</p>
    </div>
</section>
<?php
    }
} else {
    // Fallback when the plugin is not active
    ?>
<section class="menu-highlight" id="chefSpecial">
    <div class="menu-highlight__image">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/chef-special.jpg' ); ?>"
            alt="Chef's Special" loading="lazy">
    </div>
    <div class="menu-highlight__text">
        <span class="menu-highlight__kicker">Chef's Special</span>
        <h2 class="menu-highlight__title">Today's Signature Dish</h2>
        <p class="menu-highlight__subtitle">Slow‑braised short rib with ancho chili glaze</p>
        <p class="menu-highlight__body">
            Tender beef short rib, braised for 12 hours in a rich ancho and guajillo broth,
            served with roasted garlic mashed potatoes and charred scallions.
        </p>
    </div>
</section>
<?php
}