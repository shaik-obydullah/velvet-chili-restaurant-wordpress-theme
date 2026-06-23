<?php
if ( ! defined( 'OBIRC_VERSION' ) ) {
    return;
}

$area_posts = get_posts( array(
    'post_type'      => 'obirc_menu_area',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
) );

if ( empty( $area_posts ) ) {
    return;
}

$area_id  = $area_posts[0]->ID;
$title    = get_the_title( $area_id );
$subtitle = get_post_meta( $area_id, 'obirc_menu_area_subtitle', true );
$image    = get_the_post_thumbnail_url( $area_id, 'full' );

if ( ! $image ) {
    $image = get_template_directory_uri() . '/assets/images/obirc-our-menu.jpg';
}

$categories = get_terms( array(
    'taxonomy'   => 'obirc_menu_category',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
) );

if ( empty( $categories ) || is_wp_error( $categories ) ) {
    return;
}

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
    return;
}
?>

<section class="featured-menu" id="ourMenu">
    <div class="featured-menu__container">
        <div class="featured-menu__header text-center">
            <span
                class="featured-menu__kicker"><?php esc_html_e( 'From Our Kitchen', 'obydullah-restaurant' ); ?></span>
            <h2 class="featured-menu__title"><?php echo esc_html( $title ); ?></h2>
            <p class="featured-menu__subtitle"><?php echo esc_html( $subtitle ); ?></p>
        </div>

        <div class="featured-menu__row">
            <div class="featured-menu__image-col">
                <div class="featured-menu__image-wrapper">
                    <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
                </div>
            </div>

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
                                $price = get_post_meta( get_the_ID(), 'obirc_menu_price', true );
                                $desc  = get_post_meta( get_the_ID(), 'obirc_menu_subtitle', true );
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
                        echo '<p>' . esc_html__( 'No menu items found.', 'obydullah-restaurant' ) . '</p>';
                    }
                ?>
                <a href="/menu"
                    class="btn btn--primary featured-menu__cta"><?php esc_html_e( 'View Full Menu', 'obydullah-restaurant' ); ?></a>
            </div>
        </div>
    </div>
</section>