<?php
if ( defined( 'OBIRC_VERSION' ) ) {
    $query = new WP_Query( array(
        'post_type'      => 'obirc_chef_special',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
    ) );

    if ( $query->have_posts() ) {
        $query->the_post();

        $image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        if ( ! $image ) {
            $image = get_template_directory_uri() . '/assets/images/obirc-chef-special.jpg';
        }
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
        <span class="menu-highlight__kicker"><?php esc_html_e( 'Chef\'s Special', 'obydullah-restaurant' ); ?></span>
        <h2 class="menu-highlight__title"><?php echo esc_html( $title ); ?></h2>
        <p class="menu-highlight__subtitle"><?php echo esc_html( $subtitle ); ?></p>
        <div class="menu-highlight__body"><?php echo wp_kses_post( $body ); ?></div>
    </div>
</section>
<?php
    }
}