<?php
get_header();

if ( ! defined( 'OBIRC_VERSION' ) ) {
    get_footer();
    return;
}

$about_posts = get_posts( array(
    'post_type'      => 'obirc_about_page',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
) );

if ( empty( $about_posts ) ) {
    get_footer();
    return;
}

$about_id = $about_posts[0]->ID;

$kicker   = get_post_meta( $about_id, 'obirc_about_kicker', true );
$title    = get_post_meta( $about_id, 'obirc_about_title', true );
$chef     = get_post_meta( $about_id, 'obirc_about_chef_story', true );
$phil     = get_post_meta( $about_id, 'obirc_about_philosophy', true );
$slides   = get_post_meta( $about_id, 'obirc_about_slides', true );

if ( empty( $kicker ) || empty( $title ) || empty( $chef ) || empty( $phil ) || empty( $slides ) ) {
    get_footer();
    return;
}
?>

<main id="primary" class="site-main">
    <section class="about-page" id="about">
        <div class="about-page__container">
            <div class="about-page__header text-center">
                <span class="about-page__kicker"><?php echo esc_html( $kicker ); ?></span>
                <h2 class="about-page__title"><?php echo esc_html( $title ); ?></h2>
            </div>

            <div class="about-page__grid">
                <div class="about-page__text">
                    <h3 class="about-page__subtitle"><?php esc_html_e( 'Chef Story', 'obydullah-restaurant' ); ?></h3>
                    <p class="about-page__body"><?php echo nl2br( esc_html( $chef ) ); ?></p>

                    <h3 class="about-page__subtitle"><?php esc_html_e( 'Our Philosophy', 'obydullah-restaurant' ); ?>
                    </h3>
                    <p class="about-page__body"><?php echo nl2br( esc_html( $phil ) ); ?></p>
                </div>

                <div class="about-page__slider">
                    <div class="event-slider" id="eventSlider" aria-roledescription="carousel"
                        aria-label="Restaurant events">
                        <div class="event-slider__slides" id="eventSlides">
                            <?php $i = 0; foreach ( $slides as $slide ) : ?>
                            <div class="event-slider__slide <?php echo $i === 0 ? 'event-slider__slide--active' : ''; ?>"
                                role="group" aria-roledescription="slide"
                                aria-label="<?php echo esc_attr( ( $i + 1 ) . ' of ' . count( $slides ) ); ?>">
                                <div class="event-slider__bg"
                                    style="background-image: url('<?php echo esc_url( $slide['image'] ); ?>');"></div>
                                <div class="event-slider__overlay"></div>
                                <div class="event-slider__content">
                                    <h3 class="event-slider__title"><?php echo esc_html( $slide['title'] ); ?></h3>
                                    <p class="event-slider__subtitle"><?php echo esc_html( $slide['subtitle'] ); ?></p>
                                </div>
                            </div>
                            <?php $i++; endforeach; ?>
                        </div>

                        <button class="event-slider__arrow event-slider__arrow--left" id="eventPrev"
                            aria-label="Previous slide"><i class="fa-solid fa-chevron-left"></i></button>
                        <button class="event-slider__arrow event-slider__arrow--right" id="eventNext"
                            aria-label="Next slide"><i class="fa-solid fa-chevron-right"></i></button>

                        <div class="event-slider__dots" id="eventDots" aria-hidden="true">
                            <?php for ( $j = 0; $j < count( $slides ); $j++ ) : ?>
                            <button class="event-slider__dot <?php echo $j === 0 ? 'event-slider__dot--active' : ''; ?>"
                                data-slide="<?php echo esc_attr( $j ); ?>"></button>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>