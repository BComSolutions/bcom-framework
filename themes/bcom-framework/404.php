<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package BCom
 */

get_header(); ?>

<section class="main" role="main">

	<div class="container">

		<section class="not-found">
			<div class="page-content">

				<h2 class="four-oh-four-header">404</h2>
				<p class="four-oh-four-subheader"><?php _e( "Oops! Something went wrong.", 'bcom' ); ?></p>

				<p class="four-oh-four-text"><?php _e( "You can head back to the Home Page.", 'bcom' ); ?></p>
				<div class="aligncenter center-text">
					<a href="<?php bloginfo( 'url' ); ?>">
						<div class="button-primary">
							<?php _e( "Back to Home Page", 'bcom' ); ?>
						</div>
					</a>
				</div>

				<br/>

				<p class="four-oh-four-text"><?php _e( "Or maybe try a search?", 'bcom' ); ?></p>
				<div class="four-oh-four-search">
					<?php get_search_form(); ?>
				</div>

			</div><!-- .page-content -->
		</section><!-- .not-found -->

</section><!-- #main -->

<?php get_footer(); ?>
