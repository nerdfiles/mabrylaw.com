                <div id="right-rail" class="rail columns-3 end" role="complementary">
                    <div class="rail-inner">
<?php
	// A second sidebar for widgets, just because.
      if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

<div id="secondary" class="widget-area columns-5 end" role="complementary">
  <ul class="xoxo">
    <?php dynamic_sidebar( 'secondary-widget-area' ); ?>
  </ul>
</div><!-- #secondary .widget-area -->

<?php endif; ?>

      </div>
  </div>
