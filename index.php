<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
//define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
//require('./wp-blog-header.php');
?>
<!DOCTYPE HTML>

<!--

/**
 * Under Construction page
 *
 * A quick and dirty under construction page.
 *
 * @author          nerdfiles
 * @lastmodified    04-18-2011 12:56AM
 */
 
-->

<html lang="en" class="mabrylaw-com under-construction">
<head>
<meta charset="utf-8" />
<title>Under construction | mabrylaw.com</title>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.3.0/build/cssreset/reset-min.css" media="all" />
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style type="text/css">
html.under-construction { height: 100%; }
html.under-construction body { 
    height: 100%;
    font: 0.75em/1.5 sans-serif;
    background: #51514F; /* old browsers */
    background: -moz-linear-gradient(top, #51514F 0%, #353535 100%); /* firefox */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#51514F), color-stop(100%,#353535)); /* webkit */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#51514F', endColorstr='#353535',GradientType=0 ); /* ie */
    background: -o-linear-gradient(top, #51514F 0%,#353535 100%); /* opera */
    text-shadow: 0 0.1em 0.2em #222; }
h1,p { 
    color: #fff; 
    margin: 0; }
h1 { 
    color: #5692D2; 
    font-variant: small-caps; 
    text-transform: lowercase; 
    font-size: 3.5em; }
a,a:link { color: #fff; }
a:visited { color: #fff; }
a:hover { }
a:active { }
#site-container { }
#under-construction { 
    text-align: center; 
    width: 500px; 
    margin-left: 50%;
    position: relative;
    left: -250px;
    top: 10em; }
</style>
</head>

<body>

<div id="site-container">
<div id="under-construction">
<h1>Under construction</h1>
<p><a href="http://mabrylaw.com" title="mabrylaw.com">mabrylaw.com</a> is currently under construction.</p>
</div><!-- #under-construction -->
</div><!-- #site-container -->

</body>
</html>
