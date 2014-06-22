<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<a href="<?php the_permalink(); ?>"><h3 class='post-title'><?php the_title(); ?></h3></a>
		<div class='post-meta'>
			<span class='post-date'><?php the_date(); ?></span><span class='post-category'><?php the_category(' '); ?></span>
			<?php //the_meta(); ?> 
		</div><!-- /.post-meta -->
		<div class="entry">
			<?php if ( has_post_thumbnail()) : ?>
			   <div class="post-thumbnail">
				   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
				   <?php the_post_thumbnail( 'post-thumbnail-big' ); ?>
				   </a>
			   </div>
			 <?php endif; ?>
			<?php the_content('<p><strong>Tovább →</strong></p>'); ?>			
		</div><!-- /.entry -->
	</div><!-- /#post-<?php the_ID(); ?> -->
<?php endwhile; else: ?>

	<p>Sorry, no posts matched yofur criteria.</p>

<?php endif; ?>
