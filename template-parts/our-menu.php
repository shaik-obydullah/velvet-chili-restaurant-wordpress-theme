<?php
/**
 * Template Part: Our Menu (Featured Menu Preview)
 * Dynamic: title, subtitle, image from 'obirc_menu_area' single post.
 * Dynamic: menu items from 'obirc_menu_item' CPT, grouped by 'obirc_menu_category'.
 * Static fallback when plugin inactive or data missing.
 */

// If plugin not active → static fallback
if ( ! defined( 'OBIRC_VERSION' ) ) {
    obirc_static_featured_menu();
    return;
}

// -------------------------------------------------------------
// 1. Get Menu Area data (title, subtitle, featured image)
// -------------------------------------------------------------
$area_posts = get_posts( array(
    'post_type'      => 'obirc_menu_area',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
) );

if ( empty( $area_posts ) ) {
    obirc_static_featured_menu();
    return;
}

$area_id  = $area_posts[0]->ID;
$title    = get_the_title( $area_id );
$subtitle = get_post_meta( $area_id, 'obirc_menu_area_subtitle', true ); // fixed meta key
$image    = get_the_post_thumbnail_url( $area_id, 'full' );

// -------------------------------------------------------------
// 2. Get menu items grouped by category
// -------------------------------------------------------------
$categories = get_terms( array(
    'taxonomy'   => 'obirc_menu_category',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
) );

if ( empty( $categories ) || is_wp_error( $categories ) ) {
    obirc_static_featured_menu();
    return;
}

// Check if there is at least one menu item in any category
$has_items = false;
foreach ( $categories as $cat ) {
    $check = new WP_Query( array(
        'post_type'      => 'obirc_menu_item',
        'posts_per_page' => 1,
        'tax_query'      => array(
            array(
                'taxonomy' => 'obirc_menu_category',
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
    obirc_static_featured_menu();
    return;
}
?>

<section class="featured-menu" id="ourMenu">
    <div class="featured-menu__container">

        <!-- Section header (dynamic from Menu Area) -->
        <div class="featured-menu__header text-center">
            <span
                class="featured-menu__kicker"><?php esc_html_e( 'From Our Kitchen', 'velvet-chili-restaurant' ); ?></span>
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
                    $item_count = 0;
                    $total_limit = 5;

                    foreach ( $categories as $cat ) :
                        $items = new WP_Query( array(
                            'post_type'      => 'obirc_menu_item',
                            'posts_per_page' => -1,
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'obirc_menu_category',
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
                                $price = get_post_meta( get_the_ID(), 'obirc_menu_price', true );      // fixed meta key
                                $desc  = get_post_meta( get_the_ID(), 'obirc_menu_subtitle', true ); // fixed meta key
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
                        echo '<p>' . esc_html__( 'No menu items found.', 'velvet-chili-restaurant' ) . '</p>';
                    }
                ?>
                <a href="/menu"
                    class="btn btn--primary featured-menu__cta"><?php esc_html_e( 'View Full Menu', 'velvet-chili-restaurant' ); ?></a>
            </div>
        </div>
    </div>
</section>

<?php
// -------------------------------------------------------------
// Static fallback HTML (translated)
// -------------------------------------------------------------
function obirc_static_featured_menu() {
    ?>
<section class="featured-menu" id="ourMenu">
    <div class="featured-menu__container">
        <div class="featured-menu__header text-center">
            <span
                class="featured-menu__kicker"><?php esc_html_e( 'From Our Kitchen', 'velvet-chili-restaurant' ); ?></span>
            <h2 class="featured-menu__title">
                <?php esc_html_e( 'Velvet Chili Signatures', 'velvet-chili-restaurant' ); ?></h2>
            <p class="featured-menu__subtitle">
                <?php esc_html_e( 'Every dish is a story of fire, spice, and slow‑crafted comfort.', 'velvet-chili-restaurant' ); ?>
            </p>
        </div>
        <div class="featured-menu__row">
            <div class="featured-menu__image-col">
                <div class="featured-menu__image-wrapper">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/our-menu.jpg' ); ?>"
                        alt="Signature dish" loading="lazy">
                </div>
            </div>
            <div class="featured-menu__list-col">
                <h3 class="featured-menu__list-title"><?php esc_html_e( 'Starters & Mains', 'velvet-chili-restaurant' ); ?>
                </h3>
                <ul class="featured-menu__items">
                    <li class="featured-menu__item">
                        <div class="featured-menu__item-header">
                            <h4 class="featured-menu__item-name">
                                <?php esc_html_e( 'Smoked Ancho Ribeye', 'velvet-chili-restaurant' ); ?></h4>
                            <span class="featured-menu__item-price">$48</span>
                        </div>
                        <p class="featured-menu__item-desc">
                            <?php esc_html_e( '12‑hour chili‑cocoa rub, roasted bone marrow butter, grilled asparagus.', 'velvet-chili-restaurant' ); ?>
                        </p>
                    </li>
                    <li class="featured-menu__item">
                        <div class="featured-menu__item-header">
                            <h4 class="featured-menu__item-name">
                                <?php esc_html_e( 'Velvet Braised Short Rib', 'velvet-chili-restaurant' ); ?></h4>
                            <span class="featured-menu__item-price">$52</span>
                        </div>
                        <p class="featured-menu__item-desc">
                            <?php esc_html_e( 'Guajillo & pasilla braise, creamy polenta, pickled red onion.', 'velvet-chili-restaurant' ); ?>
                        </p>
                    </li>
                    <li class="featured-menu__item">
                        <div class="featured-menu__item-header">
                            <h4 class="featured-menu__item-name">
                                <?php esc_html_e( 'Fire‑Roasted Poblano Relleno', 'velvet-chili-restaurant' ); ?></h4>
                            <span class="featured-menu__item-price">$38</span>
                        </div>
                        <p class="featured-menu__item-desc">
                            <?php esc_html_e( 'Oaxaca cheese, smoky tomato salsa, cilantro lime crema.', 'velvet-chili-restaurant' ); ?>
                        </p>
                    </li>
                    <li class="featured-menu__item">
                        <div class="featured-menu__item-header">
                            <h4 class="featured-menu__item-name">
                                <?php esc_html_e( 'Chili Chocolate Tart', 'velvet-chili-restaurant' ); ?></h4>
                            <span class="featured-menu__item-price">$18</span>
                        </div>
                        <p class="featured-menu__item-desc">
                            <?php esc_html_e( 'Dark ganache with ancho heat, candied orange, vanilla bean ice cream.', 'velvet-chili-restaurant' ); ?>
                        </p>
                    </li>
                </ul>
                <a href="/menu"
                    class="btn btn--primary featured-menu__cta"><?php esc_html_e( 'View Full Menu', 'velvet-chili-restaurant' ); ?></a>
            </div>
        </div>
    </div>
</section>
<?php
}