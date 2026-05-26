<!-- ========== Dynamic Slider ========== -->
<section class="slider" id="featuredSlider" aria-roledescription="carousel" aria-label="Featured dishes">
    <!-- Slides -->
    <div class="slider__slides" id="sliderSlides">
        <!-- Slide 1 -->
        <div class="slider__slide slider__slide--active" role="group" aria-roledescription="slide" aria-label="1 of 3">
            <div class="slider__bg" style="
              background-image: url(&quot;https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop&quot;);
            "></div>
            <div class="slider__overlay"></div>
            <div class="slider__content">
                <h2 class="slider__title">Dry‑Aged Ribeye</h2>
                <p class="slider__subtitle">
                    Chili‑cocoa rub & roasted bone marrow butter
                </p>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="slider__slide" role="group" aria-roledescription="slide" aria-label="2 of 3">
            <div class="slider__bg" style="
              background-image: url(&quot;https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=2069&auto=format&fit=crop&quot;);
            "></div>
            <div class="slider__overlay"></div>
            <div class="slider__content">
                <h2 class="slider__title">Velvet Slow‑Braised Chili</h2>
                <p class="slider__subtitle">
                    Simmered 12 hours with smoked ancho & guajillo
                </p>
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="slider__slide" role="group" aria-roledescription="slide" aria-label="3 of 3">
            <div class="slider__bg" style="
              background-image: url(&quot;https://images.unsplash.com/photo-1559329007-40df8a9345d8?q=80&w=1887&auto=format&fit=crop&quot;);
            "></div>
            <div class="slider__overlay"></div>
            <div class="slider__content">
                <h2 class="slider__title">Chili Chocolate Tart</h2>
                <p class="slider__subtitle">
                    Dark ganache with ancho heat & candied orange
                </p>
            </div>
        </div>
    </div>

    <!-- Arrows -->
    <button class="slider__arrow slider__arrow--left" id="sliderPrev" aria-label="Previous slide">
        <i class="fa-solid fa-chevron-left"></i>
    </button>
    <button class="slider__arrow slider__arrow--right" id="sliderNext" aria-label="Next slide">
        <i class="fa-solid fa-chevron-right"></i>
    </button>

    <!-- Dots -->
    <div class="slider__dots" id="sliderDots" aria-hidden="true">
        <button class="slider__dot slider__dot--active" data-slide="0"></button>
        <button class="slider__dot" data-slide="1"></button>
        <button class="slider__dot" data-slide="2"></button>
    </div>
</section>