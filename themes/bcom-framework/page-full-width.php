<?php

/**
 * Template Name: Full Width
 *
 * Displays the page without a sidebar.
 */

get_header(); ?>

<section class="main" role="main">

	<div class="primary container">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>


	</div><!-- #primary -->

</section><!-- #main -->

<?php get_footer(); ?>
