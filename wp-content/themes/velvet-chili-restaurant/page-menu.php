<?php
/**
 * Template: Full Menu Page (slug: menu)
 * Displays all menu items grouped by category.
 */

get_header(); ?>

<?php
// If plugin not active, show a simple message
if ( ! defined( 'VCRC_ACTIVE' ) ) {
    echo '<div class="full-menu"><div class="full-menu__container"><p>Please activate the Velvet Chili Restaurant Core plugin to see the full menu.</p></div></div>';
    get_footer();
    return;
}

// -------------------------------------------------------------
// 1. Get Menu Area data ( title, subtitle)
// -------------------------------------------------------------
$area_posts = get_posts( array(
    'post_type'      => 'menu_area',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
) );

if ( empty( $area_posts ) ) {
    // Fallback static header if no menu_area post exists
    $title   = 'The Velvet Chili Menu';
    $subtitle = 'Every dish celebrates the chili in all its forms – smoked, dried, fresh, and roasted.';
} else {
    $area_id   = $area_posts[0]->ID;
    $title     = get_the_title( $area_id );
    $subtitle  = get_post_meta( $area_id, '_menu_area_subtitle', true );

    // Fallbacks if fields are empty
    $title     = $title ?: 'The Velvet Chili Menu';
    $subtitle  = $subtitle ?: 'Every dish celebrates the chili in all its forms – smoked, dried, fresh, and roasted.';
}

// -------------------------------------------------------------
// 2. Get all categories that have at least one menu item
// -------------------------------------------------------------
$categories = get_terms( array(
    'taxonomy'   => 'menu_category',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
) );

if ( empty( $categories ) || is_wp_error( $categories ) ) {
    echo '<div class="full-menu"><div class="full-menu__container"><p>No menu items found. Please create categories and assign menu items.</p></div></div>';
    get_footer();
    return;
}
?>

<section class="full-menu" id="full-menu">
    <div class="full-menu__container">
        <!-- Section header (dynamic from Menu Area) -->
        <div class="full-menu__header text-center">
            <span class="featured-menu__kicker">From Our Kitchen</span>
            <h2 class="full-menu__title"><?php echo esc_html( $title ); ?></h2>
            <p class="full-menu__subtitle"><?php echo esc_html( $subtitle ); ?></p>
        </div>

        <?php foreach ( $categories as $cat ) : 
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

            if ( $items->have_posts() ) : ?>
        <div class="menu-section">
            <h3 class="menu-section__title"><?php echo esc_html( $cat->name ); ?></h3>
            <div class="menu-section__grid">
                <?php while ( $items->have_posts() ) : $items->the_post();
                            $price = get_post_meta( get_the_ID(), '_menu_price', true );
                            $desc  = get_post_meta( get_the_ID(), '_menu_subtitle', true );
                        ?>
                <div class="menu-item">
                    <div class="menu-item__header">
                        <h4 class="menu-item__name"><?php the_title(); ?></h4>
                        <span class="menu-item__price"><?php echo esc_html( $price ); ?></span>
                    </div>
                    <p class="menu-item__desc"><?php echo esc_html( $desc ); ?></p>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php
            wp_reset_postdata();
            endif;
        endforeach; ?>

        <div class="full-menu__footer text-center">
            <p class="full-menu__note">
                *All prices are subject to change. Ask your server about daily specials.
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>