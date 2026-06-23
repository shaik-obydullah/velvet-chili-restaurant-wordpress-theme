<?php
if ( ! defined( 'OBIRC_VERSION' ) ) {
    return;
}

$area_posts = get_posts( array(
    'post_type'      => 'obirc_testi_area',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
) );

if ( empty( $area_posts ) ) {
    return;
}

$area_id    = $area_posts[0]->ID;
$area_title = get_the_title( $area_id );
$area_image = get_the_post_thumbnail_url( $area_id, 'full' );

if ( empty( $area_title ) ) {
    return;
}

if ( empty( $area_image ) ) {
    $area_image = get_template_directory_uri() . '/assets/images/obirc-testimonial.jpg';
}

$testimonials = new WP_Query( array(
    'post_type'      => 'obirc_testimonial',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );

if ( ! $testimonials->have_posts() ) {
    return;
}

?>
<section class="testimonials-section" id="testimonials">
    <div class="testimonials-section__bg">
        <img src="<?php echo esc_url( $area_image ); ?>" alt="" aria-hidden="true" />
    </div>
    <div class="testimonials-section__overlay"></div>
    <div class="testimonials-section__container">
        <div class="testimonials-section__row">
            <div class="testimonials-section__col">
                <div class="testimonials-box">
                    <div class="testimonials-box__icon">
                        <i class="fa-solid fa-quote-right"></i>
                    </div>
                    <h2 class="testimonials-box__title"><?php echo esc_html( $area_title ); ?></h2>
                    <div class="testimonial-carousel" id="testimonialCarousel">
                        <div class="testimonial-carousel__slides" id="testimonialSlides">
                            <?php $i = 0; while ( $testimonials->have_posts() ) : $testimonials->the_post();
                                $quote = get_post_meta( get_the_ID(), 'obirc_testimonial_quote', true );
                                $role  = get_post_meta( get_the_ID(), 'obirc_testimonial_role', true );
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