<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package BCom
 */

get_header(); ?>

<section id="main" class="site-main" role="main">

	<div id="primary" class="content-area">

			<section class="not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( '404', 'bcom' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'The page requested could not be found.', 'bcom' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

	</div><!-- #primary -->

</section><!-- #main -->

<?php get_footer(); ?>
