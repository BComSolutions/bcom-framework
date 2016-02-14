<?php
/**
 * The template for displaying all single posts.
 *
 * @package BCom
 */

get_header(); ?>

<section class="main" role="main">

	<div class="primary">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php bcom_post_navigation(); ?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- #primary -->

	<?php get_sidebar(); ?>

</section><!-- #main -->

<?php get_footer(); ?>
