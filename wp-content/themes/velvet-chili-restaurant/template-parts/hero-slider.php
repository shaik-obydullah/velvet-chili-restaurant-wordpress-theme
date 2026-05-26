<?php
$args = [
    'post_type'      => 'vchs_hero_slide',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC'
];

$query = new WP_Query($args);

if ($query->have_posts()) :
?>

<section class="slider" id="featuredSlider" aria-roledescription="carousel">

    <div class="slider__slides" id="sliderSlides">

        <?php
        $i = 0;
        while ($query->have_posts()) : $query->the_post();

            $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $active = ($i === 0) ? ' slider__slide--active' : '';
        ?>

        <div class="slider__slide<?php echo $active; ?>">
            <div class="slider__bg" style="background-image: url('<?php echo esc_url($image); ?>');">
            </div>

            <div class="slider__overlay"></div>

            <div class="slider__content">
                <h2 class="slider__title"><?php the_title(); ?></h2>
                <p class="slider__subtitle">
                    <?php echo wp_trim_words(get_the_content(), 15); ?>
                </p>
            </div>
        </div>

        <?php
            $i++;
        endwhile;
        ?>



    </div>

    <button class="slider__arrow slider__arrow--left" id="sliderPrev" aria-label="Previous slide">
        <i class="fa-solid fa-chevron-left"></i>
    </button>

    <button class="slider__arrow slider__arrow--right" id="sliderNext" aria-label="Next slide">
        <i class="fa-solid fa-chevron-right"></i>
    </button>



    <div class="slider__dots" id="sliderDots" aria-hidden="true">

        <?php
for ($d = 0; $d < $i; $d++) {
    $activeDot = ($d === 0) ? ' slider__dot--active' : '';
    echo '<button class="slider__dot' . $activeDot . '" data-slide="' . $d . '"></button>';
}
?>

    </div>

</section>

<?php
wp_reset_postdata();

else :
    get_template_part('template-parts/hero', 'default');
endif;
?>