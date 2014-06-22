<?php get_header(); ?>
		
<div id="bigpic">
	<img src="<?php bloginfo( 'template_url' ); ?>/images/bigpic.png" alt="" />
	<h2 class="page-title"><?php
						printf( __( '%s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h2>
</div><!-- /#bigpic -->
<div id='contents'>
	<div class='left-col'>

		<?php
		/* Run the loop to output the posts.
		 * If you want to overload this in a child theme then include a file
		 * called loop-index.php and that will be used instead.
		 */
		 get_template_part( 'loop', 'index' );
		?>

	</div><!-- /.left-col -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>				