<?php
/**
 * @package BCom
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php bcom_featured_image(); ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php bcom_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue Reading %s', 'bcom' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'bcom' ),
				'after'  => '</div>',
				'pagelink' => '<span>%</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-footer">
		<?php bcom_entry_footer(); ?>
	</div><!-- .entry-footer -->
</article><!-- #post-## -->