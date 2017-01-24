<?php
/**
 * Template Name: Front Page Template
 * The template for displaying page with sections.
 *
 * @package Goodz
 * @version  1.0
 */

 get_header();

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <div class="row">

            <!-- Front Page Slider -->
            <?php goodz_front_slider(); ?>

            <!-- Sections -->
            <?php goodz_front_page_sections(); ?>

        </div><!-- .row -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>

