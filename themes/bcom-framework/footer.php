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

	<div class="fat-footer">
		<div class="container">
			<?php dynamic_sidebar( 'fat-footer-one' ); ?>
			<?php dynamic_sidebar( 'fat-footer-two' ); ?>
			<?php dynamic_sidebar( 'fat-footer-three' ); ?>
		</div>
	</div>

	<footer class="site-footer" role="contentinfo">
		<div class="footer-container">
			<div class="site-info">
				&copy; <?php the_date( 'Y' ); ?> <?php bloginfo( 'name' ); ?> | Site powered and designed by <a href="http://bcomonline.com" rel="designer">BCom Solutions, LLC</a>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
