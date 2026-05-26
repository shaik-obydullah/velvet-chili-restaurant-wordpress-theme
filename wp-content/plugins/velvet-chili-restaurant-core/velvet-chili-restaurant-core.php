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
   Menu Feature
====================================================== */

function vcrc_register_menu_feature_cpt() {

    register_post_type( 'vchs_menu_feature', array(
        'labels' => array(
            'name'          => __( 'Menu Features', 'velvet-chili-core' ),
            'singular_name' => __( 'Menu Feature', 'velvet-chili-core' ),
            'add_new_item'  => __( 'Add Menu Feature', 'velvet-chili-core' ),
            'edit_item'     => __( 'Edit Menu Feature', 'velvet-chili-core' ),
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
add_action( 'init', 'vcrc_register_menu_feature_cpt' );


function vcrc_add_menu_feature_meta_box() {
    add_meta_box(
        'vcrc_menu_feature_meta',
        'Menu Highlight Settings',
        'vcrc_render_menu_feature_meta_box',
        'vchs_menu_feature',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vcrc_add_menu_feature_meta_box');


function vcrc_render_menu_feature_meta_box($post) {

    $subtitle = get_post_meta($post->ID, '_vcrc_menu_subtitle', true);
    $body     = get_post_meta($post->ID, '_vcrc_menu_body', true);

    wp_nonce_field('vcrc_save_menu_meta', 'vcrc_menu_meta_nonce');
    ?>

<p>
    <label><strong>Subtitle</strong></label><br>
    <input type="text" name="vcrc_menu_subtitle" value="<?php echo esc_attr($subtitle); ?>" style="width:100%;">
</p>

<p>
    <label><strong>Body</strong></label><br>
    <textarea name="vcrc_menu_body" rows="5" style="width:100%;"><?php echo esc_textarea($body); ?></textarea>
</p>

<?php
}

function vcrc_save_menu_feature_meta($post_id) {

    if (!isset($_POST['vcrc_menu_meta_nonce']) ||
        !wp_verify_nonce($_POST['vcrc_menu_meta_nonce'], 'vcrc_save_menu_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['vcrc_menu_subtitle'])) {
        update_post_meta($post_id, '_vcrc_menu_subtitle', sanitize_text_field($_POST['vcrc_menu_subtitle']));
    }

    if (isset($_POST['vcrc_menu_body'])) {
        update_post_meta($post_id, '_vcrc_menu_body', sanitize_textarea_field($_POST['vcrc_menu_body']));
    }
}
add_action('save_post', 'vcrc_save_menu_feature_meta');