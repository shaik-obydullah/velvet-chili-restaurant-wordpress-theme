<?php
/**
 * Plugin Name: Velvet Chili Restaurant Core
 * Description: Core functionality (CPTs + custom fields) for Velvet Chili theme
 * Version:     1.0.0
 * Author:      Shaik Obydullah
 * Text Domain: velvet-chili-core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'VCRC_ACTIVE', true );

/* ======================================================
   Hero Slider 
====================================================== */

function vcrc_register_hero_slide_cpt() {

    register_post_type( 'vchs_hero_slide', array(
        'labels' => array(
            'name'          => __( 'Hero Slides', 'velvet-chili-core' ),
            'singular_name' => __( 'Hero Slide', 'velvet-chili-core' ),
            'add_new_item'  => __( 'Add New Hero Slide', 'velvet-chili-core' ),
            'edit_item'     => __( 'Edit Hero Slide', 'velvet-chili-core' ),
        ),
        'public'       => true,
        'menu_icon'    => 'dashicons-images-alt2',
        'supports'     => array( 'title', 'thumbnail', 'page-attributes' ),
        'show_in_rest' => true,
        'has_archive'  => false,
        'rewrite'      => array( 'slug' => 'hero-slide' ),
    ) );

}
add_action( 'init', 'vcrc_register_hero_slide_cpt' );


function vcrc_add_hero_slide_meta_box() {
    add_meta_box(
        'vcrc_hero_slide_meta',
        'Hero Slide Settings',
        'vcrc_render_hero_slide_meta_box',
        'vchs_hero_slide',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vcrc_add_hero_slide_meta_box');


function vcrc_render_hero_slide_meta_box($post) {

    $subtitle = get_post_meta($post->ID, '_vcrc_subtitle', true);

    wp_nonce_field('vcrc_save_meta', 'vcrc_meta_nonce');
    ?>

<p>
    <label><strong>Subtitle</strong></label><br>
    <input type="text" name="vcrc_subtitle" value="<?php echo esc_attr($subtitle); ?>" style="width:100%;">
</p>
<?php
}

function vcrc_save_hero_slide_meta($post_id) {

    if ( ! isset($_POST['vcrc_meta_nonce']) ||
         ! wp_verify_nonce($_POST['vcrc_meta_nonce'], 'vcrc_save_meta') ) {
        return;
    }

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

    if ( ! current_user_can('edit_post', $post_id) ) return;

    if ( isset($_POST['vcrc_subtitle']) ) {
        update_post_meta(
            $post_id,
            '_vcrc_subtitle',
            sanitize_text_field($_POST['vcrc_subtitle'])
        );
    }
}
add_action('save_post', 'vcrc_save_hero_slide_meta');

/* ======================================================
   Chef's Special
====================================================== */

function vcrc_register_chef_special_cpt() {

    register_post_type( 'vchs_chef_special', array(
        'labels' => array(
            'name'          => __( 'Chef\'s Specials', 'velvet-chili-core' ),
            'singular_name' => __( 'Chef\'s Special', 'velvet-chili-core' ),
            'add_new_item'  => __( 'Add Chef\'s Special', 'velvet-chili-core' ),
            'edit_item'     => __( 'Edit Chef\'s Special', 'velvet-chili-core' ),
        ),
        'public'              => true,
        'menu_icon'           => 'dashicons-media-text',
        'supports'            => array( 'title', 'thumbnail' ),
        'show_in_rest'        => true,
        'has_archive'         => false,
        'publicly_queryable'  => false,
        'show_ui'             => true,
    ) );

}
add_action( 'init', 'vcrc_register_chef_special_cpt' );


function vcrc_add_chef_special_meta_box() {
    add_meta_box(
        'vcrc_chef_special_meta',
        'Chef\'s Special Settings',   // fixed apostrophe
        'vcrc_render_chef_special_meta_box',
        'vchs_chef_special',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'vcrc_add_chef_special_meta_box' );


function vcrc_render_chef_special_meta_box( $post ) {
    $subtitle = get_post_meta( $post->ID, '_vcrc_chef_special_subtitle', true );
    $body     = get_post_meta( $post->ID, '_vcrc_chef_special_body', true );

    wp_nonce_field( 'vcrc_save_chef_special_meta', 'vcrc_chef_special_meta_nonce' );
    ?>
<p>
    <label><strong><?php _e( 'Subtitle', 'velvet-chili-core' ); ?></strong></label><br>
    <input type="text" name="vcrc_chef_special_subtitle" value="<?php echo esc_attr( $subtitle ); ?>"
        style="width:100%;">
</p>
<p>
    <label><strong><?php _e( 'Body', 'velvet-chili-core' ); ?></strong></label><br>
    <textarea name="vcrc_chef_special_body" rows="5" style="width:100%;"><?php echo esc_textarea( $body ); ?></textarea>
</p>
<?php
}

function vcrc_save_chef_special_meta( $post_id ) {
    // Check nonce
    if ( ! isset( $_POST['vcrc_chef_special_meta_nonce'] ) ||
         ! wp_verify_nonce( $_POST['vcrc_chef_special_meta_nonce'], 'vcrc_save_chef_special_meta' ) ) {
        return;
    }

    // Avoid autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check user permissions
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save subtitle
    if ( isset( $_POST['vcrc_chef_special_subtitle'] ) ) {
        update_post_meta( $post_id, '_vcrc_chef_special_subtitle', sanitize_text_field( $_POST['vcrc_chef_special_subtitle'] ) );
    }

    // Save body
    if ( isset( $_POST['vcrc_chef_special_body'] ) ) {
        update_post_meta( $post_id, '_vcrc_chef_special_body', sanitize_textarea_field( $_POST['vcrc_chef_special_body'] ) );
    }
}
add_action( 'save_post_vchs_chef_special', 'vcrc_save_chef_special_meta' );


/* ======================================================
   Our Menu
====================================================== */

function vcrc_register_menu_item() {
    register_post_type( 'menu_item', array(
        'labels'      => array(
            'name'          => 'Menu Items',
            'singular_name' => 'Menu Item',
            'add_new_item'  => 'Add New Menu Item',
            'edit_item'     => 'Edit Menu Item',
        ),
        'public'      => true,
        'menu_icon'   => 'dashicons-food',
        'supports'    => array( 'title', 'thumbnail' ),
        'show_in_rest'=> true,
    ) );
}
add_action( 'init', 'vcrc_register_menu_item' );

function vcrc_register_menu_category() {
    register_taxonomy( 'menu_category', 'menu_item', array(
        'labels' => array(
            'name'              => 'Categories',
            'singular_name'     => 'Category',
            'add_new_item'      => 'Add New Category',
            'new_item_name'     => 'New Category Name',
        ),
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
    ) );
}
add_action( 'init', 'vcrc_register_menu_category' );

function vcrc_add_subtitle_meta_box() {
    add_meta_box( 'menu_subtitle', 'Subtitle', 'vcrc_subtitle_callback', 'menu_item', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'vcrc_add_subtitle_meta_box' );

function vcrc_subtitle_callback( $post ) {
    $subtitle = get_post_meta( $post->ID, '_menu_subtitle', true );
    echo '<textarea name="menu_subtitle" rows="2" style="width:100%;">' . esc_textarea( $subtitle ) . '</textarea>';
}

function vcrc_add_price_meta_box() {
    add_meta_box( 'menu_price', 'Price', 'vcrc_price_callback', 'menu_item', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'vcrc_add_price_meta_box' );

function vcrc_price_callback( $post ) {
    $price = get_post_meta( $post->ID, '_menu_price', true );
    echo '<input type="text" name="menu_price" value="' . esc_attr( $price ) . '" style="width:100%;" placeholder="$48">';
}

function vcrc_save_menu_item_meta( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['menu_subtitle'] ) ) {
        update_post_meta( $post_id, '_menu_subtitle', sanitize_textarea_field( $_POST['menu_subtitle'] ) );
    }
    if ( isset( $_POST['menu_price'] ) ) {
        update_post_meta( $post_id, '_menu_price', sanitize_text_field( $_POST['menu_price'] ) );
    }
}
add_action( 'save_post_menu_item', 'vcrc_save_menu_item_meta' );


function vcrc_register_menu_area() {
    register_post_type( 'menu_area', array(
        'labels' => array(
            'name'          => 'Menu Area',
            'singular_name' => 'Menu Area',
            'add_new_item'  => 'Edit Menu Area',
            'edit_item'     => 'Edit Menu Area',
        ),
        'public'           => false,
        'show_ui'          => true,
        'show_in_menu'     => 'edit.php?post_type=menu_item',
        'menu_icon'        => 'dashicons-menu',
        'supports'         => array( 'title', 'thumbnail' ),
        'show_in_rest'     => true,
        'capability_type'  => 'post',
        'map_meta_cap'     => true,
    ) );
}
add_action( 'init', 'vcrc_register_menu_area' );

// Force only one post (so "Add New" redirects to edit the existing one)
function vcrc_limit_menu_area() {
    global $pagenow;
    if ( $pagenow === 'post-new.php' && isset( $_GET['post_type'] ) && $_GET['post_type'] === 'menu_area' ) {
        $existing = get_posts( array(
            'post_type'      => 'menu_area',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        ) );
        if ( $existing ) {
            wp_redirect( admin_url( 'post.php?post=' . $existing[0]->ID . '&action=edit' ) );
            exit;
        }
    }
    // Hide the "Add New" button on the list table (if any)
    if ( isset( $_GET['post_type'] ) && $_GET['post_type'] === 'menu_area' ) {
        echo '<style>.page-title-action { display:none; }</style>';
    }
}
add_action( 'admin_head', 'vcrc_limit_menu_area' );
add_action( 'admin_init', 'vcrc_limit_menu_area' );


function vcrc_add_menu_area_subtitle_meta() {
    add_meta_box( 'menu_area_subtitle', 'Subtitle', 'vcrc_menu_area_subtitle_callback', 'menu_area', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'vcrc_add_menu_area_subtitle_meta' );

function vcrc_menu_area_subtitle_callback( $post ) {
    $subtitle = get_post_meta( $post->ID, '_menu_area_subtitle', true );
    echo '<input type="text" name="menu_area_subtitle" value="' . esc_attr( $subtitle ) . '" style="width:100%;">';
    wp_nonce_field( 'save_menu_area_subtitle', 'menu_area_subtitle_nonce' );
}

function vcrc_save_menu_area_meta( $post_id ) {
    if ( ! isset( $_POST['menu_area_subtitle_nonce'] ) || ! wp_verify_nonce( $_POST['menu_area_subtitle_nonce'], 'save_menu_area_subtitle' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    if ( isset( $_POST['menu_area_subtitle'] ) ) {
        update_post_meta( $post_id, '_menu_area_subtitle', sanitize_text_field( $_POST['menu_area_subtitle'] ) );
    }
}
add_action( 'save_post_menu_area', 'vcrc_save_menu_area_meta' );


/* ======================================================
   Testimonials
====================================================== */

function vcrc_register_testimonial() {
    register_post_type( 'testimonial', array(
        'labels'      => array(
            'name'          => 'Testimonials',
            'singular_name' => 'Testimonial',
            'add_new_item'  => 'Add New Testimonial',
            'edit_item'     => 'Edit Testimonial',
        ),
        'public'      => true,
        'menu_icon'   => 'dashicons-format-quote',
        'supports'    => array( 'title' ),
        'show_in_rest'=> true,
    ) );
}
add_action( 'init', 'vcrc_register_testimonial' );

function vcrc_add_testimonial_meta_boxes() {
    add_meta_box( 'testimonial_quote', 'Quote', 'vcrc_testimonial_quote_callback', 'testimonial', 'normal', 'high' );
    add_meta_box( 'testimonial_role', 'Role / Title', 'vcrc_testimonial_role_callback', 'testimonial', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'vcrc_add_testimonial_meta_boxes' );

function vcrc_testimonial_quote_callback( $post ) {
    $quote = get_post_meta( $post->ID, '_testimonial_quote', true );
    echo '<textarea name="testimonial_quote" rows="4" style="width:100%;">' . esc_textarea( $quote ) . '</textarea>';
}

function vcrc_testimonial_role_callback( $post ) {
    $role = get_post_meta( $post->ID, '_testimonial_role', true );
    echo '<input type="text" name="testimonial_role" value="' . esc_attr( $role ) . '" style="width:100%;" placeholder="e.g., Food Critic">';
}

function vcrc_register_testimonial_area() {
    register_post_type( 'testimonial_area', array(
        'labels' => array(
            'name'          => 'Testimonial Area',
            'singular_name' => 'Testimonial Area',
            'add_new_item'  => 'Edit Testimonial Area',
            'edit_item'     => 'Edit Testimonial Area',
        ),
        'public'           => false,
        'show_ui'          => true,
        'show_in_menu'     => 'edit.php?post_type=testimonial',
        'menu_icon'        => 'dashicons-menu',
        'supports'         => array( 'title', 'thumbnail' ),
        'show_in_rest'     => true,
        'capability_type'  => 'post',
        'map_meta_cap'     => true,
    ) );
}
add_action( 'init', 'vcrc_register_testimonial_area' );

// Force only one post (redirect "Add New" to edit the existing one)
function vcrc_limit_testimonial_area() {
    global $pagenow;
    if ( $pagenow === 'post-new.php' && isset( $_GET['post_type'] ) && $_GET['post_type'] === 'testimonial_area' ) {
        $existing = get_posts( array(
            'post_type'      => 'testimonial_area',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        ) );
        if ( $existing ) {
            wp_redirect( admin_url( 'post.php?post=' . $existing[0]->ID . '&action=edit' ) );
            exit;
        }
    }
    // Hide the "Add New" button on the list table
    if ( isset( $_GET['post_type'] ) && $_GET['post_type'] === 'testimonial_area' ) {
        echo '<style>.page-title-action { display:none; }</style>';
    }
}
add_action( 'admin_head', 'vcrc_limit_testimonial_area' );
add_action( 'admin_init', 'vcrc_limit_testimonial_area' );

/* ======================================================
   Opening Hours Settings
====================================================== */

function vcrc_register_opening_hours_cpt() {
    register_post_type( 'opening_hours', array(
        'labels' => array(
            'name'          => 'Opening Hours',
            'singular_name' => 'Opening Hours',
            'add_new_item'  => 'Edit Opening Hours',
            'edit_item'     => 'Edit Opening Hours',
        ),
        'public'           => false,
        'show_ui'          => true,
        'menu_icon'        => 'dashicons-clock',
        'menu_position'    => 35,
        'supports'         => array( 'title' ),
        'show_in_rest'     => true,
        'capability_type'  => 'post',
        'map_meta_cap'     => true,
    ) );
}
add_action( 'init', 'vcrc_register_opening_hours_cpt' );

// Force only one post
function vcrc_limit_opening_hours() {
    global $pagenow;
    if ( $pagenow === 'post-new.php' && isset( $_GET['post_type'] ) && $_GET['post_type'] === 'opening_hours' ) {
        $existing = get_posts( array(
            'post_type'      => 'opening_hours',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
        ) );
        if ( $existing ) {
            wp_redirect( admin_url( 'post.php?post=' . $existing[0]->ID . '&action=edit' ) );
            exit;
        }
    }
    if ( isset( $_GET['post_type'] ) && $_GET['post_type'] === 'opening_hours' ) {
        echo '<style>.page-title-action { display:none; }</style>';
    }
}
add_action( 'admin_head', 'vcrc_limit_opening_hours' );
add_action( 'admin_init', 'vcrc_limit_opening_hours' );

// Meta boxes: repeatable hours + note
function vcrc_add_opening_hours_meta_boxes() {
    add_meta_box( 'opening_hours_repeater', 'Opening Hours', 'vcrc_render_opening_hours_repeater', 'opening_hours', 'normal', 'high' );
    add_meta_box( 'opening_hours_note', 'Note', 'vcrc_render_opening_hours_note', 'opening_hours', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'vcrc_add_opening_hours_meta_boxes' );

function vcrc_render_opening_hours_repeater( $post ) {
    $hours = get_post_meta( $post->ID, '_opening_hours', true );
    if ( ! is_array( $hours ) ) {
        $hours = array(
            array( 'day' => 'Monday – Thursday', 'time' => '5 PM – 10 PM' ),
            array( 'day' => 'Friday', 'time' => '5 PM – 11 PM' ),
            array( 'day' => 'Saturday', 'time' => '12 PM – 11 PM' ),
            array( 'day' => 'Sunday', 'time' => '12 PM – 9 PM' ),
        );
    }
    wp_nonce_field( 'save_opening_hours', 'opening_hours_nonce' );
    ?>
<div id="hours-repeater">
    <?php foreach ( $hours as $index => $item ) : ?>
    <div class="hours-row" style="margin-bottom:10px; display:flex; gap:10px; align-items:center;">
        <input type="text" name="hours_day[]" value="<?php echo esc_attr( $item['day'] ); ?>" placeholder="Day(s)"
            style="flex:2;">
        <input type="text" name="hours_time[]" value="<?php echo esc_attr( $item['time'] ); ?>" placeholder="Time"
            style="flex:2;">
        <button type="button" class="button remove-row">Remove</button>
    </div>
    <?php endforeach; ?>
</div>
<button type="button" id="add-hours-row" class="button">Add new row</button>
<script>
jQuery(document).ready(function($) {
    $('#add-hours-row').on('click', function() {
        var newRow = '<div class="hours-row" style="margin-bottom:10px; display:flex; gap:10px;">' +
            '<input type="text" name="hours_day[]" placeholder="Day(s)" style="flex:2;">' +
            '<input type="text" name="hours_time[]" placeholder="Time" style="flex:2;">' +
            '<button type="button" class="button remove-row">Remove</button></div>';
        $('#hours-repeater').append(newRow);
    });
    $(document).on('click', '.remove-row', function() {
        $(this).closest('.hours-row').remove();
    });
});
</script>
<?php
}

function vcrc_render_opening_hours_note( $post ) {
    $note = get_post_meta( $post->ID, '_opening_hours_note', true );
    ?>
<textarea name="opening_hours_note" rows="3" style="width:100%;"><?php echo esc_textarea( $note ); ?></textarea>
<p class="description">E.g., “Last reservation 30 minutes before closing”</p>
<?php
}

function vcrc_save_opening_hours_meta( $post_id ) {
    if ( ! isset( $_POST['opening_hours_nonce'] ) || ! wp_verify_nonce( $_POST['opening_hours_nonce'], 'save_opening_hours' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Save hours
    if ( isset( $_POST['hours_day'] ) && isset( $_POST['hours_time'] ) ) {
        $days  = array_map( 'sanitize_text_field', $_POST['hours_day'] );
        $times = array_map( 'sanitize_text_field', $_POST['hours_time'] );
        $hours = array();
        for ( $i = 0; $i < count( $days ); $i++ ) {
            if ( ! empty( $days[$i] ) && ! empty( $times[$i] ) ) {
                $hours[] = array( 'day' => $days[$i], 'time' => $times[$i] );
            }
        }
        update_post_meta( $post_id, '_opening_hours', $hours );
    } else {
        update_post_meta( $post_id, '_opening_hours', array() );
    }

    // Save note
    if ( isset( $_POST['opening_hours_note'] ) ) {
        update_post_meta( $post_id, '_opening_hours_note', sanitize_textarea_field( $_POST['opening_hours_note'] ) );
    }
}
add_action( 'save_post_opening_hours', 'vcrc_save_opening_hours_meta' );


/* ======================================================
   Table Reservations
====================================================== */

function vcrc_create_booking_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'velvet_chili_restaurant_booking';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(50) NOT NULL,
        party tinyint(2) NOT NULL,
        booking_date date NOT NULL,
        booking_time time NOT NULL,
        notes text,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'vcrc_create_booking_table' );

function vcrc_drop_booking_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'velvet_chili_restaurant_booking';
    $wpdb->query( "DROP TABLE IF EXISTS $table_name" );
}
register_uninstall_hook( __FILE__, 'vcrc_drop_booking_table' );

// Enqueue the front-end script
function vcrc_enqueue_booking_script() {
    // Load script on front page (where the reservation section appears)
    if ( is_front_page() ) {
        wp_enqueue_script( 
            'vcrc-booking', 
            plugin_dir_url( __FILE__ ) . 'assets/js/booking.js', 
            array( 'jquery' ), 
            '1.0', 
            true 
        );
        wp_localize_script( 'vcrc-booking', 'vcrc_ajax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'vcrc_booking_nonce' ),
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'vcrc_enqueue_booking_script' );

// AJAX handler
function vcrc_handle_booking_submission() {
    // Verify nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vcrc_booking_nonce' ) ) {
        wp_send_json_error( array( 'error' => 'Security check failed.' ), 403 );
    }

    // Sanitize fields
    $name    = sanitize_text_field( $_POST['name'] );
    $email   = sanitize_email( $_POST['email'] );
    $phone   = sanitize_text_field( $_POST['phone'] );
    $party   = intval( $_POST['party'] );
    $date    = sanitize_text_field( $_POST['date'] );
    $time    = sanitize_text_field( $_POST['time'] );
    $notes   = sanitize_textarea_field( $_POST['notes'] );

    // Validation
    $errors = array();
    if ( empty( $name ) ) $errors[] = 'Name is required.';
    if ( ! is_email( $email ) ) $errors[] = 'Valid email is required.';
    if ( empty( $phone ) ) $errors[] = 'Phone number is required.';
    if ( $party < 1 ) $errors[] = 'Party size must be at least 1.';
    if ( ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $date ) ) $errors[] = 'Invalid date format.';
    if ( ! preg_match( '/^\d{2}:\d{2}$/', $time ) ) $errors[] = 'Invalid time format.';

    if ( ! empty( $errors ) ) {
        wp_send_json_error( array( 'errors' => $errors ) );
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'velvet_chili_restaurant_booking';

    $result = $wpdb->insert(
        $table_name,
        array(
            'name'          => $name,
            'email'         => $email,
            'phone'         => $phone,
            'party'         => $party,
            'booking_date'  => $date,
            'booking_time'  => $time,
            'notes'         => $notes,
        ),
        array( '%s', '%s', '%s', '%d', '%s', '%s', '%s' )
    );

    if ( $result === false ) {
        wp_send_json_error( array( 'error' => 'Database error. Please try again.' ) );
    }

    wp_send_json_success( array( 'message' => 'Your reservation has been submitted. We’ll contact you shortly.' ) );
}
add_action( 'wp_ajax_vcrc_booking', 'vcrc_handle_booking_submission' );
add_action( 'wp_ajax_nopriv_vcrc_booking', 'vcrc_handle_booking_submission' );





// ------------------------------------------------------------------
// Admin page to view table reservations (uses WP_List_Table)
// ------------------------------------------------------------------
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class VCRC_Booking_List_Table extends WP_List_Table {

    function get_columns() {
        return array(
            'cb'           => '<input type="checkbox" />',
            'id'           => 'ID',
            'name'         => 'Name',
            'email'        => 'Email',
            'phone'        => 'Phone',
            'party'        => 'Party',
            'booking_date' => 'Date',
            'booking_time' => 'Time',
            'notes'        => 'Notes',
            'created_at'   => 'Submitted',
        );
    }

    function get_sortable_columns() {
        return array(
            'id'           => array( 'id', false ),
            'name'         => array( 'name', false ),
            'booking_date' => array( 'booking_date', false ),
            'created_at'   => array( 'created_at', false ),
        );
    }

    function prepare_items() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'velvet_chili_restaurant_booking';

        $per_page = 20;
        $columns  = $this->get_columns();
        $hidden   = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array( $columns, $hidden, $sortable );

        // Pagination
        $paged = isset( $_GET['paged'] ) ? max( 1, intval( $_GET['paged'] ) ) : 1;
        $offset = ( $paged - 1 ) * $per_page;

        // Sorting
        $orderby = isset( $_GET['orderby'] ) ? sanitize_sql_orderby( $_GET['orderby'] ) : 'id';
        $order   = isset( $_GET['order'] ) && strtoupper( $_GET['order'] ) === 'ASC' ? 'ASC' : 'DESC';

        // Total items
        $total_items = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name" );

        // Query items
        $this->items = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d",
                $per_page,
                $offset
            ),
            ARRAY_A
        );

        // Set pagination
        $this->set_pagination_args( array(
            'total_items' => $total_items,
            'per_page'    => $per_page,
            'total_pages' => ceil( $total_items / $per_page ),
        ) );
    }

    function column_default( $item, $column_name ) {
        return esc_html( $item[ $column_name ] );
    }

    function column_cb( $item ) {
        return sprintf( '<input type="checkbox" name="booking_ids[]" value="%s" />', $item['id'] );
    }

    function column_name( $item ) {
        return esc_html( $item['name'] );
    }

    function get_bulk_actions() {
        return array( 'delete' => 'Delete' );
    }
}

function vcrc_bookings_admin_menu() {
    add_menu_page(
        'Bookings',                     // page title
        'Bookings',                     // menu title
        'manage_options',               // capability
        'vcrc-bookings',                // menu slug
        'vcrc_bookings_admin_page',     // callback function
        'dashicons-calendar-alt',       // icon
        30                              // position (after Menu Items)
    );
}
add_action( 'admin_menu', 'vcrc_bookings_admin_menu' );

function vcrc_bookings_admin_page() {
    // Handle bulk delete
    if ( isset( $_POST['action'] ) && $_POST['action'] === 'delete' && isset( $_POST['booking_ids'] ) ) {
        if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Unauthorized' );
        check_admin_referer( 'bulk-bookings' );

        global $wpdb;
        $table_name = $wpdb->prefix . 'velvet_chili_restaurant_booking';
        $ids = array_map( 'intval', $_POST['booking_ids'] );
        $ids_list = implode( ',', $ids );
        $wpdb->query( "DELETE FROM $table_name WHERE id IN ($ids_list)" );
        echo '<div class="notice notice-success"><p>Bookings deleted.</p></div>';
    }

    $bookings_table = new VCRC_Booking_List_Table();
    $bookings_table->prepare_items();
    ?>
<div class="wrap">
    <h1>Table Reservations</h1>
    <form method="post">
        <?php
            $bookings_table->display();
            wp_nonce_field( 'bulk-bookings' );
            ?>
    </form>
</div>
<?php
}