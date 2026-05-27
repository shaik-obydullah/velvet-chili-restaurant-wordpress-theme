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
   Testimonials CPT
====================================================== */

function vcrc_register_testimonial_cpt() {
    register_post_type( 'testimonial', array(
        'labels' => array(
            'name'          => 'Testimonials',
            'singular_name' => 'Testimonial',
            'add_new_item'  => 'Add New Testimonial',
            'edit_item'     => 'Edit Testimonial',
        ),
        'public'       => false,
        'show_ui'      => true,
        'menu_icon'    => 'dashicons-format-quote',
        'supports'     => array( 'title' ), // title = author name
        'show_in_rest' => true,
    ) );
}
add_action( 'init', 'vcrc_register_testimonial_cpt' );

// Meta boxes for quote and role
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

function vcrc_save_testimonial_meta( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['testimonial_quote'] ) ) {
        update_post_meta( $post_id, '_testimonial_quote', sanitize_textarea_field( $_POST['testimonial_quote'] ) );
    }
    if ( isset( $_POST['testimonial_role'] ) ) {
        update_post_meta( $post_id, '_testimonial_role', sanitize_text_field( $_POST['testimonial_role'] ) );
    }
}
add_action( 'save_post_testimonial', 'vcrc_save_testimonial_meta' );

/* ======================================================
   Testimonials Settings (submenu under Menu Items)
====================================================== */

function vcrc_add_testimonials_settings_submenu() {
    add_submenu_page(
        'edit.php?post_type=menu_item',
        'Testimonials Settings',
        'Testimonials Settings',
        'manage_options',
        'testimonials-settings',
        'vcrc_testimonials_settings_page'
    );
}
add_action( 'admin_menu', 'vcrc_add_testimonials_settings_submenu' );

function vcrc_register_testimonials_settings() {
    register_setting( 'vcrc_testimonials_group', 'vcrc_testimonials_bg_image' );
    register_setting( 'vcrc_testimonials_group', 'vcrc_testimonials_title' );
}
add_action( 'admin_init', 'vcrc_register_testimonials_settings' );

function vcrc_testimonials_settings_page() {
    $bg_image = get_option( 'vcrc_testimonials_bg_image', '' );
    $title    = get_option( 'vcrc_testimonials_title', 'What Our Customers Say' );
    ?>
<div class="wrap">
    <h1>Testimonials Settings</h1>
    <form method="post" action="options.php">
        <?php settings_fields( 'vcrc_testimonials_group' ); ?>
        <table class="form-table">
            <tr>
                <th><label for="vcrc_testimonials_title">Section Title</label></th>
                <td><input type="text" name="vcrc_testimonials_title" id="vcrc_testimonials_title"
                        value="<?php echo esc_attr( $title ); ?>" class="regular-text"><?php echo '</th>'; ?>
            </tr>
            <tr>
                <th><label for="vcrc_testimonials_bg_image">Background Image URL</label></th>
                <td>
                    <input type="url" name="vcrc_testimonials_bg_image" id="vcrc_testimonials_bg_image"
                        value="<?php echo esc_url( $bg_image ); ?>" class="regular-text">
                    <p class="description">Upload an image to the media library and copy its URL here, or use a CDN
                        link.</p>
                    </th>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
<?php
}