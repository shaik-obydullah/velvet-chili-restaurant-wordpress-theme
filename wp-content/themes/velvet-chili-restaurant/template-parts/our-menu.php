<?php
/**
 * Template Part: Our Menu (Featured Menu Preview)
 * Dynamic: title, subtitle, image from 'menu_area' single post.
 * Dynamic: menu items from 'menu_item' CPT, grouped by 'menu_category'.
 * Static fallback when plugin inactive or data missing.
 */

// If plugin not active → static fallback
if ( ! defined( 'VCRC_ACTIVE' ) ) {
    vcrc_static_featured_menu();
    return;
}

// -------------------------------------------------------------
// 1. Get Menu Area data (title, subtitle, featured image)
// -------------------------------------------------------------
$area_posts = get_posts( array(
    'post_type'      => 'menu_area',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
) );

if ( empty( $area_posts ) ) {
    vcrc_static_featured_menu();
    return;
}

$area_id  = $area_posts[0]->ID;
$title    = get_the_title( $area_id );
$subtitle = get_post_meta( $area_id, '_menu_area_subtitle', true );
$image    = get_the_post_thumbnail_url( $area_id, 'full' );

// Fallback if fields are empty (optional)
$title    = $title ?: 'Velvet Chili Signatures';
$subtitle = $subtitle ?: 'Every dish is a story of fire, spice, and slow‑crafted comfort.';
$image    = $image ?: 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=2069&auto=format&fit=crop';

// -------------------------------------------------------------
// 2. Get menu items grouped by category
// -------------------------------------------------------------
$categories = get_terms( array(
    'taxonomy'   => 'menu_category',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
) );

if ( empty( $categories ) || is_wp_error( $categories ) ) {
    vcrc_static_featured_menu();
    return;
}

// Check if there is at least one menu item in any category
$has_items = false;
foreach ( $categories as $cat ) {
    $check = new WP_Query( array(
        'post_type'      => 'menu_item',
        'posts_per_page' => 1,
        'tax_query'      => array(
            array(
                'taxonomy' => 'menu_category',
                'field'    => 'term_id',
                'terms'    => $cat->term_id,
            ),
        ),
        'fields'         => 'ids',
    ) );
    if ( $check->have_posts() ) {
        $has_items = true;
        break;
    }
}

if ( ! $has_items ) {
    vcrc_static_featured_menu();
    return;
}
?>

<!-- ========== DYNAMIC FEATURED MENU ========== -->
<section class="featured-menu" id="ourMenu">
    <div class="featured-menu__container">

        <!-- Section header (dynamic from Menu Area) -->
        <div class="featured-menu__header text-center">
            <span class="featured-menu__kicker">From Our Kitchen</span>
            <h2 class="featured-menu__title"><?php echo esc_html( $title ); ?></h2>
            <p class="featured-menu__subtitle"><?php echo esc_html( $subtitle ); ?></p>
        </div>

        <div class="featured-menu__row">
            <!-- Left column: image (dynamic from Menu Area) -->
            <div class="featured-menu__image-col">
                <div class="featured-menu__image-wrapper">
                    <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
                </div>
            </div>

            <!-- Right column: dynamic menu items grouped by category -->

            <div class="featured-menu__list-col">
                <?php 
    $item_count = 0; // total items counter
    $total_limit = 5; // maximum items to show

    foreach ( $categories as $cat ) :
        $items = new WP_Query( array(
            'post_type'      => 'menu_item',
            'posts_per_page' => -1,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'menu_category',
                    'field'    => 'term_id',
                    'terms'    => $cat->term_id,
                ),
            ),
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ) );

        if ( $items->have_posts() && $item_count < $total_limit ) :
            echo '<h3 class="featured-menu__list-title">' . esc_html( $cat->name ) . '</h3>';
            echo '<ul class="featured-menu__items">';
            
            while ( $items->have_posts() && $item_count < $total_limit ) : 
                $items->the_post();
                $item_count++;
                $price = get_post_meta( get_the_ID(), '_menu_price', true );
                $desc  = get_post_meta( get_the_ID(), '_menu_subtitle', true );
                ?>
                <li class="featured-menu__item">
                    <div class="featured-menu__item-header">
                        <h4 class="featured-menu__item-name"><?php the_title(); ?></h4>
                        <span class="featured-menu__item-price"><?php echo esc_html( $price ); ?></span>
                    </div>
                    <p class="featured-menu__item-desc"><?php echo esc_html( $desc ); ?></p>
                </li>
                <?php 
            endwhile;
            
            echo '</ul>';
            wp_reset_postdata();
        endif;
    endforeach;

    if ( $item_count === 0 ) {
        echo '<p>No menu items found.</p>';
    }
    ?>
                <a href="/menu" class="btn btn--primary featured-menu__cta">View Full Menu</a>
            </div>
        </div>
    </div>
</section>

<?php
// -------------------------------------------------------------
// Static fallback HTML (your original)
// -------------------------------------------------------------
function vcrc_static_featured_menu() {
    ?>
<section class="featured-menu" id="featured-menu">
    <div class="featured-menu__container">
        <div class="featured-menu__header text-center">
            <span class="featured-menu__kicker">From Our Kitchen</span>
            <h2 class="featured-menu__title">Velvet Chili Signatures</h2>
            <p class="featured-menu__subtitle">Every dish is a story of fire, spice, and slow‑crafted comfort.</p>
        </div>
        <div class="featured-menu__row">
            <div class="featured-menu__image-col">
                <div class="featured-menu__image-wrapper">
                    <img src="https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=2069&auto=format&fit=crop"
                        alt="Signature dish" loading="lazy">
                </div>
            </div>
            <div class="featured-menu__list-col">
                <h3 class="featured-menu__list-title">Starters & Mains</h3>
                <ul class="featured-menu__items">
                    <li class="featured-menu__item">
                        <div class="featured-menu__item-header">
                            <h4 class="featured-menu__item-name">Smoked Ancho Ribeye</h4><span
                                class="featured-menu__item-price">$48</span>
                        </div>
                        <p class="featured-menu__item-desc">12‑hour chili‑cocoa rub, roasted bone marrow butter, grilled
                            asparagus.</p>
                    </li>
                    <li class="featured-menu__item">
                        <div class="featured-menu__item-header">
                            <h4 class="featured-menu__item-name">Velvet Braised Short Rib</h4><span
                                class="featured-menu__item-price">$52</span>
                        </div>
                        <p class="featured-menu__item-desc">Guajillo & pasilla braise, creamy polenta, pickled red
                            onion.</p>
                    </li>
                    <li class="featured-menu__item">
                        <div class="featured-menu__item-header">
                            <h4 class="featured-menu__item-name">Fire‑Roasted Poblano Relleno</h4><span
                                class="featured-menu__item-price">$38</span>
                        </div>
                        <p class="featured-menu__item-desc">Oaxaca cheese, smoky tomato salsa, cilantro lime crema.</p>
                    </li>
                    <li class="featured-menu__item">
                        <div class="featured-menu__item-header">
                            <h4 class="featured-menu__item-name">Chili Chocolate Tart</h4><span
                                class="featured-menu__item-price">$18</span>
                        </div>
                        <p class="featured-menu__item-desc">Dark ganache with ancho heat, candied orange, vanilla bean
                            ice cream.</p>
                    </li>
                </ul>
                <a href="/menu" class="btn btn--primary featured-menu__cta">View Full Menu</a>
            </div>
        </div>
    </div>
</section>
<?php
}