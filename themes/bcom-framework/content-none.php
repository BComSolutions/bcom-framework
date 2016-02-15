<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package BCom
 */
?>

<section class="not-found">

	<h2 class="four-oh-four-header">Oops!</h2>
	<p class="four-oh-four-subheader"><?php _e( "Something went wrong.", 'bcom' ); ?></p>

	<p class="four-oh-four-text"><?php _e( "You can head back to the Home Page.", 'bcom' ); ?></p>
	<div class="center-text">
		<a href="<?php bloginfo( 'url' ); ?>">
			<div class="button-primary"><?php _e( "Back to Home Page", 'bcom' ); ?></div>
		</a>
	</div>

	<br/>

	<p class="four-oh-four-text"><?php _e( "Or maybe try another search?", 'bcom' ); ?></p>
	<div class="four-oh-four-search">
		<?php get_search_form(); ?>
	</div>

</section><!-- .not-found -->
