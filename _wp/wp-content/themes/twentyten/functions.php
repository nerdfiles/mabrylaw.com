<?php
/**
 * TwentyTen functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyten_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

/* Load the core theme framework. */
require_once( trailingslashit( TEMPLATEPATH ) . 'library/hybrid.php' );
$theme = new Hybrid();

/**
 * Fictional function to register sidebars.
 */
function super_mario_register_sidebars() {
    return false;
}

/**
 * Fictional function to disable sidebars.
 */
function super_mario_disable_sidebars( $sidebars_widgets ) {
    return $sidebars_widgets;
}
 
 
 
 
 
 
 
 
add_action('init', 'register_rc', 1); // Set priority to avoid plugin conflicts

function register_rc() { // A unique name for our function
    $labels = array( // Used in the WordPress admin
        'name' => _x('Team', 'post type general name'),
        'singular_name' => _x('Team', 'post type singular name'),
        'add_new' => _x('Add New Contributor', 'Team'),
        'add_new_item' => __('Add New Team Contributor'),
        'edit_item' => __('Edit Team Contributor'),
        'new_item' => __('New Team Contributor'),
        'view_item' => __('View Team Contributor'),
        'search_items' => __('Search Team Contributors'),
        'not_found' =>  __('No contributor listed under that name.'),
        'not_found_in_trash' => __('No contributor listed under that name.')
    );
    $args = array(
        'labels' => $labels, // Set above
        'public' => true, // Make it publicly accessible
        'hierarchical' => true, // No parents and children here
        'menu_position' => 5, // Appear right below "Posts"
        'has_archive' => 'team', // Activate the archive
        'supports' => array('title','editor','thumbnail','custom-fields','revisions','page-attributes', 'excerpt'),
        'description' => 'The contributors of Mabry Law Firm.'
    );
    register_post_type( 'team', $args ); // Create the post type, use options above
}


$labels_project = array(
    'name' => _x( 'Projects', 'taxonomy general name' ),
    'singular_name' => _x( 'Project', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Projects' ),
    'popular_items' => __( 'Popular Projects' ),
    'all_items' => __( 'All Projects' ),
    'edit_item' => __( 'Edit Project' ),
    'update_item' => __( 'Update Project' ),
    'add_new_item' => __( 'Add New Project' ),
    'new_item_name' => __( 'New Project Name' ),
    'separate_items_with_commas' => __( 'Separate projects with commas' ),
    'add_or_remove_items' => __( 'Add or remove projects' ),
    'choose_from_most_used' => __( 'Choose from the most used projects' )
); 

register_taxonomy(
'projects', // The name of the custom taxonomy
array( 'team' ), // Associate it with our custom post type
array(
    'rewrite' => array( // Use "presenter" instead of "presenters" in the permalink
        'slug' => 'project'
        ),
    'labels' => $labels_project
    )
);

 
 
 
 
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {

    /* Add theme support for core framework features. */
    add_theme_support( 'hybrid-core-menus' );
    add_theme_support( 'hybrid-core-sidebars' );
    add_theme_support( 'hybrid-core-widgets' );
    add_theme_support( 'hybrid-core-shortcodes' );
    add_theme_support( 'hybrid-core-post-meta-box' );
    //add_theme_support( 'hybrid-core-drop-downs' );
    add_theme_support( 'hybrid-core-seo' );
    add_theme_support( 'hybrid-core-template-hierarchy' );

    /* Add theme support for framework extensions. */
    add_theme_support( 'post-layouts' );
    add_theme_support( 'post-stylesheets' );
    add_theme_support( 'loop-pagination' );
    add_theme_support( 'get-the-image' );
    add_theme_support( 'breadcrumb-trail' );
    //add_theme_support( 'entry-views' );
    add_theme_support( 'custom-field-series' );

    /* Add theme support for WordPress features. */
    add_theme_support( 'automatic-feed-links' );
    add_custom_background();

    /* Register sidebars. */
    add_action( 'widgets_init', 'super_mario_register_sidebars', 11 );

    /* Filter the sidebar widgets. */
    add_filter( 'sidebars_widgets', 'super_mario_disable_sidebars' );
    
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	if ( ! defined( 'HEADER_TEXTCOLOR' ) )
		define( 'HEADER_TEXTCOLOR', '' );

	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	if ( ! defined( 'HEADER_IMAGE' ) )
		define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 960 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 250 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	if ( ! defined( 'NO_HEADER_TEXT' ) )
		define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyten_admin_header_style(), below.
	add_custom_image_header( '', 'twentyten_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
        'dummy1' => array(
            'url' => 'http://dummyimage.com/960x250/ccc/fff.png',
            'thumbnail_url' => 'http://dummyimage.com/50x50/ccc/fff.png',
            'description' => __( 'dummy', 'twentyten' )
        ),
        'dummy2' => array(
            'url' => 'http://dummyimage.com/960x250/000/fff.png',
            'thumbnail_url' => 'http://dummyimage.com/50x50/000/fff.png',
            'description' => __( 'dummy', 'twentyten' )
        )
      )
    );
    /*
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/berries.jpg',
			'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',
			'description' => __( 'Berries', 'twentyten' )
		)
	  )
    );
    */
}
endif;

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

if ( ! function_exists( 'twentyten_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 * @since Twenty Ten 1.0
 */
function twentyten_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function twentyten_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function twentyten_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyten_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
//add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Twenty Ten 1.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @since Twenty Ten 1.0
 * @deprecated Deprecated in Twenty Ten 1.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'twentyten' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'twentyten' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'twentyten' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'twentyten' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'twentyten' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Twenty Ten 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Twenty Ten styling.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/*
add_filter('rewrite_rules_array', 'customRewriteRules');
add_filter('query_vars','customQueryVars');
add_filter('init','flushRules');

function flushRules() {
   global $wp_rewrite;
    $wp_rewrite->flush_rules();
}

function customRewriteRules($rules) {
    $aNewRules = array(); //(.+?)(/[0-9]+)?/?$
    //$aNewRules['./language/en'] = '?pagenamelang=en';
    return $aNewRules + $rules;
}

function customQueryVars($vars) {
    array_push($vars, 'lang');
    return $vars;
}
*/


function dereg_scripts() {
    wp_deregister_script( 'jquery' );
    wp_deregister_script('comment-reply');
    wp_deregister_script('l10n');
    
}    
 
add_action('wp_enqueue_scripts', 'dereg_scripts');

/* ======= In-house JS ======= */

//add_action('hybrid_after_html', 'load_js', 11);
add_action('wp_footer', 'load_js', 11);

function load_js() {
?>

<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/script.js/dist/script.min.js"></script>

<script type="text/javascript">

    // jquery
    //$script('http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', 'jquery');
    $script([
        'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', 
        '<?php bloginfo( 'stylesheet_directory' ); ?>/_js-lib/jquery-waypoints/waypoints.min.js', 
        'http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js' 
        //'http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery-ui-i18n.min.js'
        ], 
    'jquery');
    
    // jquery plugins - ready from the outside
    /*
    $script.ready('jquery', function() { 
        $script('<?php bloginfo( 'stylesheet_directory' ); ?>/_js-lib/jquery-waypoints/waypoints.min.js', 'waypoints');
        $script('http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js', 'jqueryui');
        $script('http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery-ui-i18n.min.js', 'jqueryuii18n');
    });
    */
    
    // custom - ready from the inside
    $script('<?php bloginfo( 'stylesheet_directory' ); ?>/_js/global.js', 'global');
    
    // WP stuff
    $script('http://<?php echo bloginfo( 'domain' ); ?>/_wp/wp-includes/js/l10n.js?ver=20101110', 'l10n');
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) : ?>
    $script('http://<?php echo bloginfo( 'domain' ); ?>/_wp/wp-includes/js/comment-reply.js?ver=20090102', 'comment-reply');
    <?php endif; ?>

</script>
    
<?php
}

add_action('custom_entry_title', 'custom_entry_title');

function custom_entry_title() {
    
    if (!is_page() || is_front_page() || is_home()):
    ?>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<?php
    endif;
}

add_action('custom_page_header', 'custom_page_header');

function custom_page_header() { 
    $linkOut = (!is_404());
    $current_category = get_the_category();
    $catName = $current_category[0]->cat_name;
    $cat = $current_category[0]->category_nicename;
    $category_id = get_cat_ID( $cat );
    $category_link = get_category_link( $category_id );
    $linkOutUrl = (is_single() || in_category($cat)) ? $category_link : get_permalink();
    if ( get_post_type() != false ) :
        $post_type = get_post_type();
        if ($post_type == 'team') :
            $parent = 'team';
            $parentUrl = '../../'.$parent . '/';
            $linkOutUrl = $parentUrl;
        endif;
    endif;
    
    if ( !(is_front_page()) ) :
?>
    <h1 class="page-title">
        
        <?php if ($linkOut) : ?>
            <a href="<?php echo $linkOutUrl; ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
        <?php endif; ?>
        
            <?php if ( is_day() ) : ?>
                <?php printf( __( 'Daily Archives: <span>%s</span>', 'twentyten' ), get_the_date() ); ?>
            <?php elseif ( is_category() ) : ?>
                <?php printf( __( '%s', 'twentyten' ), single_cat_title( '', false ) ); ?>
            <?php elseif ( is_tag() ) : ?>
                <?php printf( __( 'Tag Archives: %s', 'twentyten' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
            <?php elseif (is_author() ) : ?>
                <?php printf( __( 'Author Archives: %s', 'twentyten' ), "<span class='vcard'><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></span>" ); ?>
            <?php elseif ( is_month() ) : ?>
                <?php printf( __( 'Monthly Archives: <span>%s</span>', 'twentyten' ), get_the_date( 'F Y' ) ); ?>
            <?php elseif ( is_year() ) : ?>
                <?php printf( __( 'Yearly Archives: <span>%s</span>', 'twentyten' ), get_the_date( 'Y' ) ); ?>
            <?php elseif ( is_404() ) : ?>
                    <?php _e( 'Not Found', 'twentyten' ); ?>
            <?php elseif( is_page() ) : ?>
                    <?php the_title(); ?>
            <?php elseif( is_single() ) : ?>
                    <?php echo $catName; ?>
            <?php else : ?>
                    <?php the_title(); ?>
            <?php endif; ?>
            
            <?php  echo $parent; ?>
        
        <?php if ($linkOut) : ?>
        </a>
        <?php endif; ?>
        
    </h1>
    
    <?php
    
    endif;
}

//add_filter("the_excerpt", "fancified_the_excerpt");

function fancified_the_excerpt($content) {
    fancy_excerpt(35, null, null, null, 'entry-excerpt');
}

function fancy_excerpt($length, $ellipsis, $words, $return, $class) {

    // get text
    $text = get_the_content();
    $text = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $text);
    $text = strip_tags($text);

    // defaults
    $length = (!$length) ? $length = 20 : $length = $length;
    $ellipsis = (!$ellipsis) ? $ellipsis = '...' : $ellipsis = $ellipsis;
    $words = (!$words) ? $words = true : $words = false;

    // if chars
    if (!$words) :
        $excerpt = substr($text, 0, $length);
        $excerpt = substr($text, 0, strripos($text, ' '));
        $excerpt = $text.$ellipsis;

    // if words
    else :
        $excerpt = explode(' ', $text, $length);
        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(' ', $excerpt) . '...';
        } else {
            $excerpt = implode(' ', $excerpt);
        }

        $excerpt = preg_replace('`\[[^\]]*\]`', '' , $excerpt);
    endif;

    $excerpt = '<p class="' . $class . '">' . $excerpt . '</p>';

    // print
    if (!$return) :
        echo $excerpt;
    else :
        return $excerpt;
    endif;

}

function wp_admin_custom_css() {
?>
<style type="text/css">
    .widget-control-actions { clear: right; }
    .widget-context { border: 1px #D1E5EE solid; padding-right: 10px; }
</style>
<?php    
}

add_action('admin_print_styles', 'wp_admin_custom_css');

function childtheme_mce_btns2($orig) {
return array('formatselect', 'styleselect', '|', 'pastetext', 'pasteword', 'removeformat', '|', 'outdent', 'indent', '|', 'undo', 'redo', 'wp_help', 'mymenubutton' );
}
//add_filter( 'mce_buttons_2', 'childtheme_mce_btns2', 999 );

function custom_options( $opt ) {
    //format drop down list
    //$opt['theme'] = 'advanced';
    $opt['theme_advanced_blockformats'] = 'p,div,h2,h3,h4,h5,h6,blockquote,dt,dd,code,samp';
    $opt['theme_advanced_styles'] = "Big Call Out=big-call-out;Schmancy Blockquote=schmancy-blockquote;Markup Address=address";
    //$opt['theme_advanced_buttons1'] = 'bold,italic,strikethrough,insertdate';
    //$opt['theme_advanced_buttons2'] = "insertlayer,styleprops,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,formatselect,underline,justifyfull,forecolor,|,pastetext,pasteword,removeformat,|,charmap,|,outdent,indent,|,undo,redo,wp_help";
    //$opt['theme_advanced_buttons1'] = 'bold,italic,strikethrough,|,bullist,numlist,blockquote,|,justifyleft,justifycenter,justifyright,|,link,unlink,wp_more,|,spellchecker,fullscreen,wp_adv';
    //$opt['theme_advanced_buttons2'] = 'preview,zoom,formatselect,underline,justifyfull,forecolor,|,pastetext,pasteword,removeformat,|,media,charmap,|,outdent,indent,|,undo,redo,wp_help,|,acronym';
    //$opt['theme_advanced_buttons3'] = "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen";
    //$opt['theme_advanced_buttons4'] = "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage";
    //$opt['extended_valid_elements'] = "img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name]";
    //font list
    $opt['theme_advanced_fonts'] = 'Helvetica=helvetica,sans-serif,arial;Courier New=courier new,courier,monospace';
    //font size
    $opt['theme_advanced_font_sizes'] = '10px,12px,14px,16px,24px';
    $opt['mode']="specific_textareas";
    $opt['editor_selector']="theEditor";
    $opt['width']="100%";
    $opt['theme'] = "advanced";
    $opt['skin'] = "wp_theme";
    $opt['theme_advanced_buttons1'] = "cut,copy,paste,replace,bold,italic,strikethrough,underline,separator,bullist,numlist,outdent,indent,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,link,unlink,separator,image,styleprops,inserttime,insertdate,separator,wp_more,wp_page,separator,spellchecker,search,separator,fullscreen,wp_adv,code";
    $opt['theme_advanced_buttons2'] = "fontselect,fontsizeselect,formatselect,styleselect,pastetext,pasteword,removeformat,separator,charmap,print,separator,forecolor,backcolor,emotions,separator,sup,sub,media,separator,undo,redo,attribs,wp_help,visualaid";
    $opt['theme_advanced_buttons3'] = "insertlayer,moveforward,movebackward,absolute,advhr,acronym,delete_table,,ins,cite,tablecontrols,iespell,visualchars"; 
    $opt['theme_advanced_buttons4'] = "";
    $opt['language'] = "en";
    $opt['spellchecker_languages']="+English=en,Danish=da,Dutch=nl,Finnish=fi,French=fr,German=de,Italian=it,Polish=pl,Portuguese=pt,Spanish=es,Swedish=sv";
    $opt['theme_advanced_toolbar_location'] = "top";
    $opt['theme_advanced_toolbar_align'] = "left"; 
    $opt['theme_advanced_statusbar_location'] = "bottom";
    $opt['theme_advanced_resizing']=true;
    $opt['theme_advanced_resize_horizontal']=false;
    $opt['dialog_type']="modal";
    $opt['relative_urls']=false;
    $opt['remove_script_host']=false;
    $opt['convert_urls']=false;
    $opt['apply_source_formatting']=false;
    $opt['remove_linebreaks']=true;
    $opt['gecko_spellcheck']=true;
    $opt['entities']="38,amp,60,lt,62,gt";
    $opt['accessibility_focus']=true; 
    $opt['tabfocus_elements']="major-publishing-actions"; 
    $opt['media_strict']=false;
    $opt['paste_remove_styles']=true;
    $opt['paste_remove_spans']=true;
    $opt['paste_strip_class_attributes']="all";
    $opt['paste_text_use_dialog']=true;
    $opt['wpeditimage_disable_captions']=false; 
    $opt['plugins'] = "inlinepopups,spellchecker,paste,wordpress,fullscreen,wpeditimage,wpgallery,tabfocus,wplink,wpdialogs,-media,-advhr,-layer,-visualchars,-style,-emotions,-insertdatetime,-table,-print,-iespell,-searchreplace,-xhtmlxtras,-advlist,-advimage,-contextmenu";
    $opt['content_css']="http://mabrylaw.com/_wp/wp-content/themes/twentyten/editor-style.css";
    $opt['wordpress_adv_toolbar'] = "toolbar2";
    //$opt['theme_advanced_containers'] = "mycontainer1,mycontainer2";
    //$opt['theme_advanced_buttons3'] = "separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor";
    
    //$opt['theme_advanced_layout_manager'] = "RowLayout";
    //default foreground color
    //$opt['theme_advanced_default_foreground_color'] = '#000000';
    //default background color
    //$opt['theme_advanced_default_background_color'] = '#FFFFFF';

    return $opt;
}
//add_filter('tiny_mce_before_init', 'custom_options);

function i_want_no_generators()
{
return '';
}
//add_filter('the_generator','i_want_no_generators');
