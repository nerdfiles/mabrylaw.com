<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href='http://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/gdgs/_css-lib/gdgs/module-importer.php?_modules=reset.css,font.css,typesetting.css,system.css,form.css,tools.css,table.css,bounds.css,standardize.css,engine-importer.css,browser-importer.css,device-importer.css,page.css,print.css&_compress=false" />
<link rel="stylesheet" type="text/css" media="all" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" /> 
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div id="container" class="hfeed column-layout show-guide-16 clearfix">
    
    <div id="access" role="navigation" class="columns-16">
        <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
        <div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>"><?php _e( 'Skip to content', 'twentyten' ); ?></a></div>
    </div><!-- #access -->
    
	<div id="header" class="columns-16">
		<div id="masthead">
			<div id="branding" role="banner">
				<?php $heading_tag = ( is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> id="site-title">
					<span>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</span>
				</<?php echo $heading_tag; ?>>
				<!--div id="site-description"><?php bloginfo( 'description' ); ?></div-->

				<?php
					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() && current_theme_supports( 'post-thumbnails' ) &&
							has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= HEADER_IMAGE_WIDTH ) :
						// Houston, we have a new header image!
						echo get_the_post_thumbnail( $post->ID );
					elseif ( get_header_image() ) : ?>
						<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
					<?php endif; ?>
			</div><!-- #branding -->
		</div><!-- #masthead -->
	</div><!-- #header -->
	
	<div id="nav" class="columns-16">
        <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
        <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
    </div>

	<div id="main"  class="columns-16">
