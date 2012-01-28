  <div id="left-rail" class="rail columns-4 begin" role="complementary">
      <div class="rail-inner">

		<div id="primary" class="widget-area columns-5 end" role="complementary">
			<ul class="xoxo">

<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>

			<!--
			    li id="search" class="widget-container widget_search">
				<?php get_search_form(); ?>
			</li
			-->
<!--
			<li id="archives" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Archives', 'mabrylaw' ); ?></h3>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
			</li>
-->
			<!--
			    li id="meta" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Meta', 'mabrylaw' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</li
			-->
<?php endif; ?>

			</ul>
		</div><!-- #primary .widget-area -->


  </div>
</div>

