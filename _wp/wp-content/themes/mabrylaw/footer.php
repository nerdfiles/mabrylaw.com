<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
	</div><!-- #main -->

	<div id="footer" role="contentinfo" class="columns-16 clear-left basement-5">

<?php
    /* A sidebar in the footer? Yep. You can can customize
     * your footer with four columns of widgets.
     */
    get_sidebar( 'footer' );
?>
		    
        <div id="footer-logo" class="columns-16 begin end">
            <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="http://mabrylaw.com/_wp/wp-content/themes/twentyten/_img-ui/mabry-logo.png" width="300" /></a>
        </div>
        
        <div id="colophon" class="columns-8 begin">
            <div>711 West Alabama Street</div>
            <div>Houston, Texas 77006-5005</div>
            <div><strong>T</strong> 832.350.8335</div>
            <div><strong>F</strong> 713.523.1116</div>
            <div><strong>E</strong> amabry@mabrylaw.com</div>
        </div>
    
    	<div id="admin-footer" class="columns-8 end">
    		<ul>
    		    <li><a href="/_wp/wp-admin/">dashboard</a></li>
    		    <li><a href="http://validator.w3.org/check?verbose=1&amp;uri=<?php echo curPageURL(); ?>">html</a></li>
    		    <li><a href="http://jigsaw.w3.org/css-validator/validator?profile=css3&amp;warning=2&amp;uri=<?php echo curPageURL(); ?>">css</a></li>
    		</ul>
    	</div><!-- #site-info -->
    	
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>
