<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
<div id="bigpic">
	<?php // GET HEADER IMAGE IF EXIST ?>
	<?php if (class_exists('MultiPostThumbnails')
				&& MultiPostThumbnails::has_post_thumbnail( $post->post_type, 'header')) :
					MultiPostThumbnails::the_post_thumbnail( $post->post_type, 'header', NULL,  'header'); 
		else :?>
			<?php // IF NO HEADER IMAGE IS DEFINED, GET DEFAULT PICTURE ?>
			<img src="<?php bloginfo( 'template_url' ); ?>/images/bigpic.png" alt="" />
	<?php 
		endif; 
	?>
	<h2 class="page-title"><span class="breadcrumb"><a href="/">Hírek</a> / </span><?php the_title(); ?></h2>
</div><!-- /#bigpic -->
<div id='contents'>
	<div class='left-col'>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry">
			
				<div class='post-meta'>
					<span class='post-date'><?php the_date(); ?></span><span class='post-category'><?php the_category(' '); ?></span>
					<?php //the_meta(); ?> 
				</div><!-- /.post-meta -->
				
				<?php // UNCOMMENT IF YOU WANT TO DISPLAY FEATURED IMAGE INSIDE A POST ?>
				
				<?php /*
	 			<?php if ( has_post_thumbnail()) : ?>
	 			   <div class="post-thumbnail">
	 				   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
	 				   <?php the_post_thumbnail( 'post-thumbnail-big' ); ?>
	 				   </a>
	 			   </div>
	 			 <?php endif; ?>
	 			<?php */ ?>
				 
				<?php the_content(); ?>			
			</div><!-- /.entry -->
		</div><!-- /#post-<?php the_ID(); ?> -->

<?php endwhile; else: ?>

	<p>Sorry, no posts matched yofur criteria.</p>

<?php endif; ?>

	</div><!-- /.left-col -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>				