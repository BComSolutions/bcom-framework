<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package BCom
 */

get_header(); ?>

<section id="main" class="site-main" role="main">

	<div class="content-area">

			<section class="not-found">
				<header class="page-header">
<!--					<h1 class="page-title">--><?php //_e( '404', 'bcom' ); ?><!--</h1>-->
				</header><!-- .page-header -->

				<div class="page-content">

					<h2 class="four-oh-four-header">404</h2>
					<p class="four-oh-four-subheader"><?php _e( "Oops! Something went wrong.", 'bcom' ); ?></p>

					<p class="four-oh-four-text"><?php _e( "You can head back to the Home Page.", 'bcom' ); ?></p>
					<a href="<?php bloginfo( 'url' ); ?>"><button class="button button--state-sumbit aligncenter">Back to Home Page</button></a>
					<br />
					<p class="four-oh-four-text"><?php _e( "Or maybe try a search?", 'bcom' ); ?></p>
					<div class="four-oh-four-search"><?php get_search_form(); ?></div>
				</div><!-- .page-content -->
			</section><!-- .not-found -->

</section><!-- #main -->

<?php get_footer(); ?>
