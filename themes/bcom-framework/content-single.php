<?php
/**
 * @package BCom
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php bcom_featured_image(); ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php bcom_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'bcom' ),
				'after'  => '</div>',
				'pagelink' => '<span>%</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-social">
		<?php bcom_social_links(); ?>
	</div>

	<section class="entry-footer">
		<?php bcom_entry_footer(); ?>
	</section><!-- .entry-footer -->

</article><!-- #post-## -->
