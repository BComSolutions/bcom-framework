<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package BCom
 */
?>

		</div><!-- .container -->
	</section><!-- .site-content -->

	<div class="b-footer" role="contentinfo">
		<div class="b-footer__container">
			<div class="b-footer__site-info">
				&copy; <?php the_date( 'Y' ); ?> <?php bloginfo( 'name' ); ?> | Site powered and designed by <a href="http://bcomonline.com" rel="designer">BCom Solutions, LLC</a>
			</div><!-- .site-info -->
		</div>
	</div><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
