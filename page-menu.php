<?php
/**
 * Template: Full Menu Page (slug: menu)
 * Displays all menu items grouped by category.
 */

get_header();

// If plugin not active, show a simple message
if ( ! defined( 'OBIRC_VERSION' ) ) {
    echo '<div class="full-menu"><div class="full-menu__container"><p>' . esc_html__( 'Please activate the Velvet Chili Restaurant Core plugin to see the full menu.', 'velvet-chili-restaurant' ) . '</p></div></div>';
    get_footer();
    return;
}

// -------------------------------------------------------------
// 1. Get Menu Area data (title, subtitle) from obirc_menu_area CPT
// -------------------------------------------------------------
$area_posts = get_posts( array(
    'post_type'      => 'obirc_menu_area',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
) );

if ( empty( $area_posts ) ) {
    // Fallback static header if no menu_area post exists
    $title   = esc_html__( 'The Velvet Chili Restaurant Menu', 'velvet-chili-restaurant' );
    $subtitle = esc_html__( 'Every dish celebrates the chili in all its forms – smoked, dried, fresh, and roasted.', 'velvet-chili-restaurant' );
} else {
    $area_id   = $area_posts[0]->ID;
    $title     = get_the_title( $area_id );
    $subtitle  = get_post_meta( $area_id, 'obirc_menu_area_subtitle', true );

    // Fallbacks if fields are empty
    $title     = $title ?: esc_html__( 'The Velvet Chili Restaurant Menu', 'velvet-chili-restaurant' );
    $subtitle  = $subtitle ?: esc_html__( 'Every dish celebrates the chili in all its forms – smoked, dried, fresh, and roasted.', 'velvet-chili-restaurant' );
}

// -------------------------------------------------------------
// 2. Get all categories that have at least one menu item
// -------------------------------------------------------------
$categories = get_terms( array(
    'taxonomy'   => 'obirc_menu_category',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
) );

if ( empty( $categories ) || is_wp_error( $categories ) ) {
    echo '<div class="full-menu"><div class="full-menu__container"><p>' . esc_html__( 'No menu items found. Please create categories and assign menu items.', 'velvet-chili-restaurant' ) . '</p></div></div>';
    get_footer();
    return;
}
?>

<section class="full-menu" id="full-menu">
    <div class="full-menu__container">
        <!-- Section header (dynamic from Menu Area) -->
        <div class="full-menu__header text-center">
            <span
                class="featured-menu__kicker"><?php esc_html_e( 'From Our Kitchen', 'velvet-chili-restaurant' ); ?></span>
            <h2 class="full-menu__title"><?php echo esc_html( $title ); ?></h2>
            <p class="full-menu__subtitle"><?php echo esc_html( $subtitle ); ?></p>
        </div>

        <?php foreach ( $categories as $cat ) : 
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

            if ( $items->have_posts() ) : ?>
        <div class="menu-section">
            <h3 class="menu-section__title"><?php echo esc_html( $cat->name ); ?></h3>
            <div class="menu-section__grid">
                <?php while ( $items->have_posts() ) : $items->the_post();
                            $price = get_post_meta( get_the_ID(), 'obirc_menu_price', true );   // ✅ fixed meta key
                            $desc  = get_post_meta( get_the_ID(), 'obirc_menu_subtitle', true ); // ✅ fixed meta key
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
                <?php esc_html_e( '*All prices are subject to change. Ask your server about daily specials.', 'velvet-chili-restaurant' ); ?>
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>