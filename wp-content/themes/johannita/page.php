<?php get_header(); global $segiton; ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
<div id="bigpic">

	<?php // GET HEADER IMAGE IF EXIST ?>
	<?php if (class_exists('MultiPostThumbnails')
				&& MultiPostThumbnails::has_post_thumbnail( $post->post_type, 'header')) :
					MultiPostThumbnails::the_post_thumbnail( $post->post_type, 'header', NULL,  'header'); 
		else :?>
			<?php // IF NO HEADER IMAGE IS DEFINED, GET DEFAULT PICTURE
            if ($segiton){ 
                $headerpic = 'bigpic.png';
            } else {
                $headerpic = 'bigpic-rend.png';
            }
            ?>
            <img src="<?php bloginfo( 'template_url' ); ?>/images/<?=$headerpic;?>" alt="" />
	<?php 
		endif; 
	?>
	<h2 class="page-title"><?php the_title(); ?></h2>
</div><!-- /#bigpic -->
<div id='contents'>
	<div class='left-col'>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry">
			
				<?php // UNCOMMENT IF YOU WANT TO DISPLAY FEATURED IMAGE INSIDE A PAGE ?>
				
				<?php ?>
					<?php if ( has_post_thumbnail()) : ?>
					   <div class="post-thumbnail">
						   <?php the_post_thumbnail( 'post-thumbnail-big' ); ?>
					   </div>
					 <?php endif; ?>
					<?php  ?>
					
				<?php the_content(); ?>			
			</div><!-- /.entry -->
		</div><!-- /#post-<?php the_ID(); ?> -->

<?php endwhile; else: ?>

	<p>Sorry, no posts matched yofur criteria.</p>

<?php endif; ?>

	</div><!-- /.left-col -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>				
