<?php get_header(); ?>

<?php get_template_part('template-parts/hero', 'section'); ?>
<?php get_template_part('template-parts/chef', 'special'); ?>
<?php get_template_part('template-parts/our', 'menu'); ?>
<?php get_template_part( 'template-parts/testimonials' ); ?>

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