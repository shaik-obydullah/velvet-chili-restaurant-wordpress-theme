<?php
/**
 * Template Part: Testimonials Section
 * Displays a carousel of testimonials from the 'testimonial' CPT.
 * Background image and section title are set via Testimonials Settings.
 */

if ( ! defined( 'VCRC_ACTIVE' ) ) {
    // Fallback static HTML (your original testi section)
    // You can paste your static HTML here, but I'll show a simple message.
    echo '<p>Please activate the Velvet Chili plugin to see testimonials.</p>';
    return;
}

// Get settings
$bg_image = get_option( 'vcrc_testimonials_bg_image', '' );
$title    = get_option( 'vcrc_testimonials_title', 'What Our Customers Say' );
$bg_image = $bg_image ?: 'https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1974&auto=format&fit=crop';

// Query testimonials
$testimonials = new WP_Query( array(
    'post_type'      => 'testimonial',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );

if ( ! $testimonials->have_posts() ) {
    echo '<p>No testimonials yet. Add some under Testimonials in the admin.</p>';
    return;
}
?>

<section class="testimonials-section" id="testimonials">
    <div class="testimonials-section__bg">
        <img src="<?php echo esc_url( $bg_image ); ?>" alt="" aria-hidden="true">
    </div>
    <div class="testimonials-section__overlay"></div>

    <div class="testimonials-section__container">
        <div class="testimonials-section__row">
            <div class="testimonials-section__col">
                <div class="testimonials-box">
                    <div class="testimonials-box__icon">
                        <i class="fa-solid fa-quote-right"></i>
                    </div>
                    <h2 class="testimonials-box__title"><?php echo esc_html( $title ); ?></h2>

                    <div class="testimonial-carousel" id="testimonialCarousel">
                        <div class="testimonial-carousel__slides" id="testimonialSlides">
                            <?php $i = 0; while ( $testimonials->have_posts() ) : $testimonials->the_post();
                                $quote = get_post_meta( get_the_ID(), '_testimonial_quote', true );
                                $role  = get_post_meta( get_the_ID(), '_testimonial_role', true );
                                $active_class = ( $i === 0 ) ? ' testimonial-carousel__slide--active' : '';
                            ?>
                            <div class="testimonial-carousel__slide<?php echo esc_attr( $active_class ); ?>">
                                <blockquote class="testimonial-carousel__quote"><?php echo esc_html( $quote ); ?>
                                </blockquote>
                                <div class="testimonial-carousel__author">
                                    <span class="testimonial-carousel__name"><?php the_title(); ?></span>
                                    <?php if ( $role ) : ?>
                                    <span class="testimonial-carousel__role">— <?php echo esc_html( $role ); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php $i++; endwhile; wp_reset_postdata(); ?>
                        </div>

                        <div class="testimonial-carousel__dots" id="testimonialDots">
                            <?php for ( $j = 0; $j < $i; $j++ ) : ?>
                            <button
                                class="testimonial-carousel__dot <?php echo $j === 0 ? 'testimonial-carousel__dot--active' : ''; ?>"
                                data-slide="<?php echo esc_attr( $j ); ?>"></button>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>