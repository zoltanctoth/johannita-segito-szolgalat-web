<div class="right-col">
    <!--
    <h3 class='ige-title'>Heti ige</h3>
	<div class="ige-contents">
		It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable.
	</div>
	<div class="ige-bottom"></div>
    -->
			<div id="primary" class="widget-area" role="complementary">
				<ul class="xoxo">
	
	<?php
		/* When we call the dynamic_sidebar() function, it'll spit out
		 * the widgets for that widget area. If it instead returns false,
		 * then the sidebar simply doesn't exist, so we'll hard-code in
		 * some default sidebar stuff just in case.
		 */
		if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
	
	
			<?php endif; // end primary widget area ?>
				</ul>
			</div><!-- #primary .widget-area -->
	
	<?php
		// A second sidebar for widgets, just because.
		if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>
	
			<div id="secondary" class="widget-area" role="complementary">
				<ul class="xoxo">
					<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
				</ul>
			</div><!-- #secondary .widget-area -->
	
	<?php endif; ?>
</div><!-- /.right-col -->



