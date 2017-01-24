<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Goodz
 */

get_header();

?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

    		<?php while ( have_posts() ) : the_post(); ?>

    			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php goodz_featured_media(); ?>

                    <header class="entry-header">

                        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

                        <div class="entry-meta">

                            <?php goodz_posted_on(); ?>

                        </div><!-- .entry-meta -->

                    </header><!-- .entry-header -->

                    <div class="row">

                        <div class="col-md-9 <?php goodz_content_cols(); ?>">

                            <div class="entry-content">

                                <?php
                                    the_content( sprintf(
                                        /* translators: %s: Name of current post. */
                                        wp_kses( esc_html__( 'Read more. %s', 'goodz' ), array( 'span' => array( 'class' => array() ) ) ),
                                        the_title( '<span class="screen-reader-text">"', '"</span>', false )
                                    ) );
                                ?>

                                <?php
                                    wp_link_pages( array(
                                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'goodz' ),
                                        'after'  => '</div>',
                                    ) );
                                ?>

                                <div class="entry-footer">
                                    <?php goodz_entry_footer(); ?>
                                </div><!-- .entry-footer -->

                            </div><!-- .entry-content -->

                            <!-- Author box -->
                            <?php goodz_author_box(); ?>

                            <!-- Related Posts -->
                            <?php goodz_related_posts(); ?>

                            <?php
                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                            ?>

                        </div><!-- .columns -->

                        <?php get_sidebar(); ?>

                    </div><!-- .row -->

                </article><!-- #post-## -->

    		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->

	</div><!-- #primary -->

	<?php the_post_navigation(); ?>

<?php get_footer(); ?>
