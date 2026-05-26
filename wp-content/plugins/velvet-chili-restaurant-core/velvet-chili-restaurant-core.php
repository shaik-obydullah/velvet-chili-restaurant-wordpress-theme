<?php
/**
 * Plugin Name: Velvet Chili Restaurant Core
 * Description: Handles CPTs for Velvet Chili Restaurant theme
 * Version: 1.0.0
 * Author: Shaik Obydullah
 * Text Domain: velvet-chili-core
 */

if (!defined('ABSPATH')) exit;

function vcrc_register_hero_slide_cpt() {

    register_post_type('vchs_hero_slide', [
        'labels' => [
            'name'          => 'Hero Slides',
            'singular_name' => 'Hero Slide',
            'add_new_item'  => 'Add New Hero Slide',
        ],
        'public'       => true,
        'menu_icon'    => 'dashicons-images-alt2',
        'supports'     => ['title', 'editor', 'thumbnail'],
        'has_archive'  => false,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'hero-slide'],
    ]);
}

add_action('init', 'vcrc_register_hero_slide_cpt');