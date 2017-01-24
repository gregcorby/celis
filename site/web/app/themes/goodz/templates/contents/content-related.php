<?php
/**
 * Content for Related posts on single post page
 *
 * @package  Goodz
 */
?>

<div class="jp-relatedposts-post jp-relatedposts-post-thumbs">



    <?php goodz_featured_image( 'goodz-related-post' ); ?>



    <h4 class="jp-relatedposts-post-title">
        <a class="jp-relatedposts-post-a" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
            <?php the_title(); ?>
        </a>
    </h4>

    <p class="jp-relatedposts-post-context">
        <?php esc_html_e( 'In', 'goodz' ); ?>
        <?php

            $categories = get_the_category();

            if ( ! empty( $categories ) ) {
                echo esc_html( $categories[0]->name );
            }

        ?>
    </p>

</div>