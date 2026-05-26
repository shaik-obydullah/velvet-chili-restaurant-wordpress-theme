<?php get_header(); ?>


<?php

        $args = [
            'post_type' => 'vchs_hero_slide',
            'posts_per_page' => 1
        ];

        $query = new WP_Query($args);

        if ( post_type_exists('vchs_hero_slide') && $query->have_posts() ) {

            get_template_part('template-parts/hero', 'slider');

        } else {

            get_template_part('template-parts/hero', 'default');

        }

        wp_reset_postdata();
    ?>


<!-- ========== Menu Highlight ========== -->
<section class="menu-highlight" id="chefSpecial">
    <div class="menu-highlight__image">
        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2070&auto=format&fit=crop"
            alt="Velvet Chili menu dishes" loading="lazy" />
    </div>
    <div class="menu-highlight__text">
        <span class="menu-highlight__kicker">Our Menu</span>
        <h2 class="menu-highlight__title">Crafted with Fire & Spice</h2>
        <p class="menu-highlight__subtitle">
            From small plates to slow‑braised classics
        </p>
        <p class="menu-highlight__body">
            Every dish at Velvet Chili is built around the deep, smoky warmth of
            carefully selected chilies. Explore bold appetisers, hearty mains, and
            desserts kissed with heat – a menu designed to surprise and comfort in
            equal measure.
        </p>
    </div>
</section>

<!-- ========== Featured Menu Preview ========== -->
<section class="featured-menu" id="ourMenu">
    <div class="featured-menu__container">
        <!-- Section header -->
        <div class="featured-menu__header text-center">
            <span class="featured-menu__kicker">From Our Kitchen</span>
            <h2 class="featured-menu__title">Velvet Chili Signatures</h2>
            <p class="featured-menu__subtitle">
                Every dish is a story of fire, spice, and slow‑crafted comfort.
            </p>
        </div>

        <!-- Row: image + menu list -->
        <div class="featured-menu__row">
            <!-- Left column: image -->
            <div class="featured-menu__image-col">
                <div class="featured-menu__image-wrapper">
                    <img src="https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=2069&auto=format&fit=crop"
                        alt="Signature dish" loading="lazy" />
                </div>
            </div>

            <!-- Right column: menu items -->
            <div class="featured-menu__list-col">
                <h3 class="featured-menu__list-title">Starters & Mains</h3>
                <ul class="featured-menu__items">
                    <li class="featured-menu__item">
                        <div class="featured-menu__item-header">
                            <h4 class="featured-menu__item-name">Smoked Ancho Ribeye</h4>
                            <span class="featured-menu__item-price">$48</span>
                        </div>
                        <p class="featured-menu__item-desc">
                            12‑hour chili‑cocoa rub, roasted bone marrow butter, grilled
                            asparagus.
                        </p>
                    </li>
                    <li class="featured-menu__item">
                        <div class="featured-menu__item-header">
                            <h4 class="featured-menu__item-name">
                                Velvet Braised Short Rib
                            </h4>
                            <span class="featured-menu__item-price">$52</span>
                        </div>
                        <p class="featured-menu__item-desc">
                            Guajillo & pasilla braise, creamy polenta, pickled red onion.
                        </p>
                    </li>
                    <li class="featured-menu__item">
                        <div class="featured-menu__item-header">
                            <h4 class="featured-menu__item-name">
                                Fire‑Roasted Poblano Relleno
                            </h4>
                            <span class="featured-menu__item-price">$38</span>
                        </div>
                        <p class="featured-menu__item-desc">
                            Oaxaca cheese, smoky tomato salsa, cilantro lime crema.
                        </p>
                    </li>
                    <li class="featured-menu__item">
                        <div class="featured-menu__item-header">
                            <h4 class="featured-menu__item-name">Chili Chocolate Tart</h4>
                            <span class="featured-menu__item-price">$18</span>
                        </div>
                        <p class="featured-menu__item-desc">
                            Dark ganache with ancho heat, candied orange, vanilla bean ice
                            cream.
                        </p>
                    </li>
                </ul>
                <a href="/menu" class="btn btn--primary featured-menu__cta">Read More</a>
            </div>
        </div>
    </div>
</section>
<!-- ========== Testimonials ========== -->
<section class="testimonials-section" id="testimonials">
    <div class="testimonials-section__bg">
        <!-- Replace with your own background image -->
        <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=1974&auto=format&fit=crop" alt=""
            aria-hidden="true" />
    </div>
    <div class="testimonials-section__overlay"></div>

    <div class="testimonials-section__container">
        <div class="testimonials-section__row">
            <div class="testimonials-section__col">
                <div class="testimonials-box">
                    <!-- Quote icon (using Font Awesome) -->
                    <div class="testimonials-box__icon">
                        <i class="fa-solid fa-quote-right"></i>
                    </div>

                    <h2 class="testimonials-box__title">What Our Customers Say</h2>

                    <!-- Testimonial carousel -->
                    <div class="testimonial-carousel" id="testimonialCarousel">
                        <div class="testimonial-carousel__slides" id="testimonialSlides">
                            <!-- Slide 1 -->
                            <div class="testimonial-carousel__slide testimonial-carousel__slide--active">
                                <blockquote class="testimonial-carousel__quote">
                                    “The ancho ribeye was life‑changing. Perfect heat,
                                    incredible depth – I’ve never tasted anything like it.
                                    Velvet Chili is a gem.”
                                </blockquote>
                                <div class="testimonial-carousel__author">
                                    <span class="testimonial-carousel__name">James Delacroix</span>
                                    <span class="testimonial-carousel__role">— Food Critic</span>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="testimonial-carousel__slide">
                                <blockquote class="testimonial-carousel__quote">
                                    “From the smoky pasilla soup to the chocolate tart, every
                                    bite was a masterclass in balance. The atmosphere is as
                                    warm as the spices.”
                                </blockquote>
                                <div class="testimonial-carousel__author">
                                    <span class="testimonial-carousel__name">Elena Rossi</span>
                                    <span class="testimonial-carousel__role">— Regular Guest</span>
                                </div>
                            </div>
                            <!-- Slide 3 -->
                            <div class="testimonial-carousel__slide">
                                <blockquote class="testimonial-carousel__quote">
                                    “Booked the private dining room for a birthday. The team
                                    went above and beyond – the short rib was
                                    melt‑in‑your‑mouth perfection.”
                                </blockquote>
                                <div class="testimonial-carousel__author">
                                    <span class="testimonial-carousel__name">Marcus & Sofia Lee</span>
                                    <span class="testimonial-carousel__role">— Celebrated a special occasion</span>
                                </div>
                            </div>
                            <!-- Slide 4 -->
                            <div class="testimonial-carousel__slide">
                                <blockquote class="testimonial-carousel__quote">
                                    “The best chili‑based menu I’ve ever encountered.
                                    Sophisticated, surprising, and utterly comforting. We’ll
                                    be back every month.”
                                </blockquote>
                                <div class="testimonial-carousel__author">
                                    <span class="testimonial-carousel__name">Claire Thompson</span>
                                    <span class="testimonial-carousel__role">— Food Blogger</span>
                                </div>
                            </div>
                        </div>

                        <!-- Dots navigation -->
                        <div class="testimonial-carousel__dots" id="testimonialDots">
                            <button class="testimonial-carousel__dot testimonial-carousel__dot--active"
                                data-slide="0"></button>
                            <button class="testimonial-carousel__dot" data-slide="1"></button>
                            <button class="testimonial-carousel__dot" data-slide="2"></button>
                            <button class="testimonial-carousel__dot" data-slide="3"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== Opening Hours & Reservation ========== -->
<section class="reservation" id="book">
    <div class="reservation__container">
        <!-- Section header -->
        <div class="reservation__header text-center">
            <span class="reservation__kicker">Reservations</span>
            <h2 class="reservation__title">Book Your Table</h2>
            <p class="reservation__subtitle">
                Secure your dining experience. We look forward to welcoming you.
            </p>
        </div>

        <!-- Two‑column wrapper -->
        <div class="reservation__grid">
            <!-- Left: Opening Hours -->
            <div class="reservation__hours hours-panel">
                <div class="hours-panel__icon">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <h3 class="hours-panel__title">Opening Hours</h3>
                <ul class="hours-panel__list">
                    <li class="hours-panel__item">
                        <span class="hours-panel__day">Monday – Thursday</span>
                        <span class="hours-panel__time">5 PM – 10 PM</span>
                    </li>
                    <li class="hours-panel__item">
                        <span class="hours-panel__day">Friday</span>
                        <span class="hours-panel__time">5 PM – 11 PM</span>
                    </li>
                    <li class="hours-panel__item">
                        <span class="hours-panel__day">Saturday</span>
                        <span class="hours-panel__time">12 PM – 11 PM</span>
                    </li>
                    <li class="hours-panel__item">
                        <span class="hours-panel__day">Sunday</span>
                        <span class="hours-panel__time">12 PM – 9 PM</span>
                    </li>
                </ul>
                <p class="hours-panel__note">
                    Last reservation 30 minutes before closing
                </p>
            </div>

            <!-- Right: Booking Form -->
            <div class="reservation__form booking-panel">
                <form class="booking-form" id="bookingForm" novalidate>
                    <div class="booking-form__group">
                        <label for="bookingName">Full Name <span class="required-star">*</span></label>
                        <input type="text" id="bookingName" name="name" placeholder="John Doe" required
                            autocomplete="name" />
                    </div>
                    <div class="booking-form__group">
                        <label for="bookingEmail">Email Address <span class="required-star">*</span></label>
                        <input type="email" id="bookingEmail" name="email" placeholder="john@example.com" required
                            autocomplete="email" />
                    </div>
                    <div class="booking-form__group">
                        <label for="bookingPhone">Phone Number <span class="required-star">*</span></label>
                        <input type="tel" id="bookingPhone" name="phone" placeholder="+1 (555) 000-0000" required
                            autocomplete="tel" />
                    </div>
                    <div class="booking-form__group">
                        <label for="bookingParty">Party Size <span class="required-star">*</span></label>
                        <select id="bookingParty" name="party" required>
                            <option value="" disabled selected>Select guests</option>
                            <option value="1">1 Guest</option>
                            <option value="2">2 Guests</option>
                            <option value="3">3 Guests</option>
                            <option value="4">4 Guests</option>
                            <option value="5">5 Guests</option>
                            <option value="6">6 Guests</option>
                            <option value="7">7 Guests</option>
                            <option value="8">8+ Guests</option>
                        </select>
                    </div>
                    <div class="booking-form__group">
                        <label for="bookingDate">Date <span class="required-star">*</span></label>
                        <input type="date" id="bookingDate" name="date" required min="2026-05-23" />
                    </div>
                    <div class="booking-form__group">
                        <label for="bookingTime">Time <span class="required-star">*</span></label>
                        <select id="bookingTime" name="time" required>
                            <option value="" disabled selected>Select time</option>
                            <option value="17:00">5:00 PM</option>
                            <option value="17:30">5:30 PM</option>
                            <option value="18:00">6:00 PM</option>
                            <option value="18:30">6:30 PM</option>
                            <option value="19:00">7:00 PM</option>
                            <option value="19:30">7:30 PM</option>
                            <option value="20:00">8:00 PM</option>
                            <option value="20:30">8:30 PM</option>
                            <option value="21:00">9:00 PM</option>
                        </select>
                    </div>
                    <div class="booking-form__group booking-form__group--full">
                        <label for="bookingNotes">Special Requests</label>
                        <textarea id="bookingNotes" name="notes"
                            placeholder="Allergies, dietary needs, special occasions..." spellcheck="false"></textarea>
                    </div>
                    <button type="submit" class="btn btn--primary booking-form__submit">
                        Confirm Reservation
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

<?php wp_footer(); ?>
</body>

</html>