<?php
/**
 * Default search form
 *
 * @package; Goodz
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url() ); ?>">

    <label>
        <span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'goodz' ); ?></span>
        <input type="search" class="search-field" placeholder="<?php esc_html_e( 'Enter keywords', 'goodz' ); ?>" value="" name="s" title="<?php esc_html_e( 'Search for:', 'goodz' ); ?>" autocomplete="off">
    </label>

    <input type="submit" class="search-submit" value="<?php esc_html_e( 'Search', 'goodz' ); ?>">

    <?php if ( is_home() ) { ?>

        <input type="hidden" name="post_type" value="post">

    <?php } else { ?>

        <input type="hidden" name="post_type" value="product">

    <?php } ?>

</form>
