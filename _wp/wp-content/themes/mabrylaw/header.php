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
<!--
   
/**
 * mabrylaw.com
 *
 * A Web project by designthus.
 * 
 * @developer       nerdfiles
 * @designer        mdulin
 * @version         0.0.1
 * @date            2011-05-23
 * @include         header.php
 */
    
-->
<html class="no-js <?php echo get_bloginfo('language'); ?>" <?php language_attributes(); ?>>
    
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
	echo ' | ' . sprintf( __( 'Page %s', 'mabrylaw' ), max( $paged, $page ) );

?></title>

<!-- Other Meta -->
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />

<!-- GDGS -->
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/gdgs/_css-lib/gdgs/module-importer.php?_modules=reset.css,font.css,typesetting.css,system.css,form.css,tools.css,table.css,bounds.css,standardize.css,engine-importer.css,browser-importer.css,device-importer.css,page.css,print.css&amp;_compress=false" />

<!-- Main Stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    
<!-- Google Web Fonts -->
<link href='http://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:regular,600' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:light' rel='stylesheet' type='text/css'>
    
<!-- JS Plugin CSS -->
<link rel="stylesheet" type="text/css" media="all" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" /> 
    
<!-- WP Head -->
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
<div id="site-container" class="hfeed column-layout ~show-guide-16 clearfix">
    
	<div id="global-header" class="columns-16">
	    
	    <div id="access" role="navigation" class="accessibly-hide">
            <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
            <p><small><em>Note:</em> 4 skip links below</small></p>
            <ul>
                <li>
                    <a 
                        href="#language-switcher" 
                        id="skip-language-switcher"
                        title="<?php esc_attr_e( 'Change language', 'mabrylaw' ); ?>">
                        <?php _e( 'Change language', 'mabrylaw' ); ?>
                    </a>
                </li>
                <li>
                    <a 
                        href="#main" 
                        id="skip-main"
                        title="<?php esc_attr_e( 'Skip to content', 'mabrylaw' ); ?>">
                        <?php _e( 'Skip to content', 'mabrylaw' ); ?>
                    </a>
                </li>
                <li>
                    <a 
                        href="#search"
                        id="skip-search" 
                        title="<?php esc_attr_e( 'Skip to search', 'mabrylaw' ); ?>">
                        <?php _e( 'Skip to search', 'mabrylaw' ); ?>
                    </a>
                </li>
                <li>
                    <a 
                        href="#primary" 
                        id="skip-primary"
                        title="<?php esc_attr_e( 'Skip to primary sidebar', 'mabrylaw' ); ?>">
                        <?php _e( 'Skip to primary sidebar', 'mabrylaw' ); ?>
                    </a>
                </li>
            </ul>
        </div><!-- #access -->
	    
	    <div id="language-switcher" class="columns-4 propel-8 begin">
	        <!-- Weavely -->
	        <span class="accessibly-hide">Language:</span>
            <?php 
                $lang_url = $_SERVER['REQUEST_URI'];
                $en_url = str_replace('/dev/', '/dev/en/', $lang_url);
                $es_url = str_replace('/dev/', '/dev/es/', $lang_url);
                $vi_url = str_replace('/dev/', '/dev/vi/', $lang_url);
            ?>
            <ul>
                <li><a href="<?php echo $en_url; ?>" title="Toggle" id="lang-eng">Toggle</a></li>
                <li>
                    <?php if (current_user_can('create_users')) : ?>
                        <a href="<?php echo $vi_url; ?>" title="Chuy&eacute;n" id="lang-chu">Chuy&eacute;n</a>
                    <?php else : ?>
                        <span title="Chuy&eacute;n" id="lang-chu">Chuy&eacute;n</span>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if (current_user_can('create_users')) : ?>
                        <a href="<?php echo $es_url; ?>" title="Cambiar" id="lang-esp">Cambiar</a>
                    <?php else : ?>
                        <span title="Cambiar" id="lang-esp">Cambiar</span>
                    <?php endif; ?>
                    
                </li>
            </ul>
        </div><!-- #language-switcher -->
        
        <div id="search" class="columns-6 propel-6 end">
        <!-- Indeedly -->
        <?php get_search_form(); ?>
        </div><!-- #search -->
		
	</div><!-- #global-header -->
	
	<div id="logo" class="columns-8">
        <?php $heading_tag = ( is_front_page() ) ? 'h1' : 'div'; ?>
        <<?php echo $heading_tag; ?> id="site-title">
                <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                    <span id="site-name"><?php bloginfo( 'name' ); ?></span>
                    <span id="site-tagline"><?php bloginfo( 'description' ); ?></span>
                </a>
        </<?php echo $heading_tag; ?>>
        
	</div>
	
    <div id="nav" class="columns-8">
      <?php 
        wp_nav_menu( array( 
          'container_class' => 'menu-header clearfix', 
          'theme_location' => 'primary' 
        ) ); 
      ?>
    </div>
    
    <?php if (is_front_page()) : ?>
    
    <div id="masthead" class="columns-16 attic-4">
        <div id="carousel">
            <ul>
                <?php 
                    $carousel_counter = 0;
                    $carousel_total = 2;
                    //$my_query = new WP_Query('posts_per_page=3&meta_key=Top Story&meta_value=yes');
                    $my_query = new WP_Query('posts_per_page=3');
                
                while ($my_query->have_posts()) : $my_query->the_post();
                    $carousel_counter++; 
                    $cat = get_the_category();
    
                    if ( get_header_image() ) : ?>
                    
                        <li class="carousel-item carousel-item-<?php echo $carousel_counter; ?> <?php if ($carousel_counter == $carousel_total) { echo "carousel-item-last"; } ?> clearfix">
                            <div class="carousel-item-container" style="background: url('http://placehold.it/960x250') 100% 50% no-repeat; ">
                                <div class="carousel-item-content">
                                    <!--
                                        div class="carousel-item-category-container"><a class="carousel-item-category-link" href="<?php echo $cat[0]->slug; ?>/" title="View articles listed under <?php echo $cat[0]->cat_name; ?>"><?php echo strtolower($cat[0]->cat_name); ?></a></div
                                    -->
                                    <h2><?php the_title(); ?></h2>
                                    <div class="">
                                        <?php fancy_excerpt(12, null, null, null, 'teaser-excerpt') ?>
                                    </div>
                                    <div class="more">More</div>
                                </div>
                            </div>
                       </li>
                       
                    <?php endif; ?>
                    
                <?php endwhile; ?>
            </ul>
        </div>
    </div><!-- #masthead -->
    
    <?php endif; ?>
    
    <div id="wide-header-bar-container">
        <div id="wide-header-bar"></div>
        <div id="graphic"></div>
    </div>

	<div id="main"  class="columns-16 attic-4">
	    
	    <?php do_action('custom_page_header'); ?>
