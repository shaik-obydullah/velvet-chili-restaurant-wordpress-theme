<?php
if ( ! defined( 'OBIRC_VERSION' ) ) {
    return;
}

$hours_posts = get_posts( array(
    'post_type'      => 'obirc_opening_hours',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
) );

if ( empty( $hours_posts ) ) {
    return;
}

$hours_id = $hours_posts[0]->ID;
$hours_raw = get_post_meta( $hours_id, 'obirc_opening_hours', true );

if ( empty( $hours_raw ) || ! is_array( $hours_raw ) ) {
    return;
}

$title = get_the_title( $hours_id );
$note  = get_post_meta( $hours_id, 'obirc_opening_hours_note', true );

$title = $title ?: __( 'Opening Hours', 'obydullah-restaurant' );
$note  = $note ?: __( 'Last reservation 30 minutes before closing', 'obydullah-restaurant' );
?>

<section class="reservation" id="reservation">
    <div class="reservation__container">
        <div class="reservation__grid">
            <div class="reservation__hours hours-panel">
                <div class="hours-panel__icon">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <h3 class="hours-panel__title"><?php echo esc_html( $title ); ?></h3>
                <ul class="hours-panel__list">
                    <?php foreach ( $hours_raw as $item ) : ?>
                    <li class="hours-panel__item">
                        <span class="hours-panel__day"><?php echo esc_html( $item['day'] ); ?></span>
                        <span class="hours-panel__time"><?php echo esc_html( $item['time'] ); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <p class="hours-panel__note"><?php echo esc_html( $note ); ?></p>
            </div>

            <div class="reservation__form booking-panel">
                <form class="booking-form" id="bookingForm" novalidate>
                    <div class="booking-form__group">
                        <label for="bookingName"><?php esc_html_e( 'Full Name', 'obydullah-restaurant' ); ?> <span
                                class="required-star">*</span></label>
                        <input type="text" id="bookingName" name="name"
                            placeholder="<?php esc_attr_e( 'John Doe', 'obydullah-restaurant' ); ?>" required
                            autocomplete="name" />
                    </div>
                    <div class="booking-form__group">
                        <label for="bookingEmail"><?php esc_html_e( 'Email Address', 'obydullah-restaurant' ); ?> <span
                                class="required-star">*</span></label>
                        <input type="email" id="bookingEmail" name="email"
                            placeholder="<?php esc_attr_e( 'john@example.com', 'obydullah-restaurant' ); ?>" required
                            autocomplete="email" />
                    </div>
                    <div class="booking-form__group">
                        <label for="bookingPhone"><?php esc_html_e( 'Phone Number', 'obydullah-restaurant' ); ?> <span
                                class="required-star">*</span></label>
                        <input type="tel" id="bookingPhone" name="phone"
                            placeholder="<?php esc_attr_e( '+1 (555) 000-0000', 'obydullah-restaurant' ); ?>" required
                            autocomplete="tel" />
                    </div>
                    <div class="booking-form__group">
                        <label for="bookingParty"><?php esc_html_e( 'Party Size', 'obydullah-restaurant' ); ?> <span
                                class="required-star">*</span></label>
                        <select id="bookingParty" name="party" required>
                            <option value="" disabled selected>
                                <?php esc_html_e( 'Select guests', 'obydullah-restaurant' ); ?></option>
                            <option value="1"><?php esc_html_e( '1 Guest', 'obydullah-restaurant' ); ?></option>
                            <option value="2"><?php esc_html_e( '2 Guests', 'obydullah-restaurant' ); ?></option>
                            <option value="3"><?php esc_html_e( '3 Guests', 'obydullah-restaurant' ); ?></option>
                            <option value="4"><?php esc_html_e( '4 Guests', 'obydullah-restaurant' ); ?></option>
                            <option value="5"><?php esc_html_e( '5 Guests', 'obydullah-restaurant' ); ?></option>
                            <option value="6"><?php esc_html_e( '6 Guests', 'obydullah-restaurant' ); ?></option>
                            <option value="7"><?php esc_html_e( '7 Guests', 'obydullah-restaurant' ); ?></option>
                            <option value="8"><?php esc_html_e( '8+ Guests', 'obydullah-restaurant' ); ?></option>
                        </select>
                    </div>
                    <div class="booking-form__group">
                        <label for="bookingDate"><?php esc_html_e( 'Date', 'obydullah-restaurant' ); ?> <span
                                class="required-star">*</span></label>
                        <input type="date" id="bookingDate" name="date" required
                            min="<?php echo esc_attr( date( 'Y-m-d' ) ); ?>" />
                    </div>
                    <div class="booking-form__group">
                        <label for="bookingTime"><?php esc_html_e( 'Time', 'obydullah-restaurant' ); ?> <span
                                class="required-star">*</span></label>
                        <select id="bookingTime" name="time" required>
                            <option value="" disabled selected>
                                <?php esc_html_e( 'Select time', 'obydullah-restaurant' ); ?></option>
                            <option value="17:00"><?php esc_html_e( '5:00 PM', 'obydullah-restaurant' ); ?></option>
                            <option value="17:30"><?php esc_html_e( '5:30 PM', 'obydullah-restaurant' ); ?></option>
                            <option value="18:00"><?php esc_html_e( '6:00 PM', 'obydullah-restaurant' ); ?></option>
                            <option value="18:30"><?php esc_html_e( '6:30 PM', 'obydullah-restaurant' ); ?></option>
                            <option value="19:00"><?php esc_html_e( '7:00 PM', 'obydullah-restaurant' ); ?></option>
                            <option value="19:30"><?php esc_html_e( '7:30 PM', 'obydullah-restaurant' ); ?></option>
                            <option value="20:00"><?php esc_html_e( '8:00 PM', 'obydullah-restaurant' ); ?></option>
                            <option value="20:30"><?php esc_html_e( '8:30 PM', 'obydullah-restaurant' ); ?></option>
                            <option value="21:00"><?php esc_html_e( '9:00 PM', 'obydullah-restaurant' ); ?></option>
                        </select>
                    </div>
                    <div class="booking-form__group booking-form__group--full">
                        <label
                            for="bookingNotes"><?php esc_html_e( 'Special Requests', 'obydullah-restaurant' ); ?></label>
                        <textarea id="bookingNotes" name="notes"
                            placeholder="<?php esc_attr_e( 'Allergies, dietary needs, special occasions...', 'obydullah-restaurant' ); ?>"
                            spellcheck="false"></textarea>
                    </div>
                    <button type="submit" class="btn btn--primary booking-form__submit">
                        <?php esc_html_e( 'Confirm Reservation', 'obydullah-restaurant' ); ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>