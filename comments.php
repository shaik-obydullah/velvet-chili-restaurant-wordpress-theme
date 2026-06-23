<?php
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
    <h2 class="comments-title">
        <?php
            $comment_count = get_comments_number();
            if ( '1' === $comment_count ) {
                esc_html_e( 'One Comment', 'obydullah-restaurant' );
            } else {
                printf(
                    esc_html( _nx( '%s Comment', '%s Comments', $comment_count, 'comments title', 'obydullah-restaurant' ) ),
                    number_format_i18n( $comment_count )
                );
            }
            ?>
    </h2>

    <ol class="comment-list">
        <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
            ) );
            ?>
    </ol>

    <?php
        the_comments_pagination( array(
            'prev_text' => __( '&laquo; Previous', 'obydullah-restaurant' ),
            'next_text' => __( 'Next &raquo;', 'obydullah-restaurant' ),
        ) );
        ?>

    <?php endif; ?>

    <?php
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
        ?>
    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'obydullah-restaurant' ); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>
</div>