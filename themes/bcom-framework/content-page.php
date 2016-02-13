<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package BCom
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php bcom_featured_image(); ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<section class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'bcom' ),
				'after'  => '</div>',
				'pagelink' => '<span>%</span>',
			) );
		?>
	</section><!-- .entry-content -->

	<section class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'bcom' ), '<span class="edit-link">', '</span>' ); ?>
	</section><!-- .entry-footer -->
</article><!-- #post-## -->
