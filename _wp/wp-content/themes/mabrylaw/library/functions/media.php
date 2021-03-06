<?php
/**
 * Functions file for loading scripts and stylesheets.  This file also handles the output of attachment files 
 * by displaying appropriate HTML elements for the attachments.
 *
 * @package HybridCore
 * @subpackage Functions
 */

/* Load specific scripts for the framework. */
add_action( 'wp_enqueue_scripts', 'hybrid_enqueue_script' );

/* Load the development stylsheet in script debug mode. */
add_filter( 'stylesheet_uri', 'hybrid_debug_stylesheet', 10, 2 );

/**
 * Function for using a debug stylesheet when developing.  To develop with the debug stylesheet, 
 * SCRIPT_DEBUG must be set to 'true' in the 'wp-config.php' file.  This will check if a 'style.dev.css'
 * file is present within the theme folder and use it if it exists.  Else, it defaults to 'style.css'.
 *
 * @since 0.9.0
 */
function hybrid_debug_stylesheet( $stylesheet_uri, $stylesheet_dir_uri ) {

	/* If SCRIPT_DEBUG is set to true and the theme supports 'dev-stylesheet'. */
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG && current_theme_supports( 'dev-stylesheet' ) ) {

		/* Remove the stylesheet directory URI from the file name. */
		$stylesheet = str_replace( trailingslashit( $stylesheet_dir_uri ), '', $stylesheet_uri );

		/* Change the stylesheet name to 'style.dev.css'. */
		$stylesheet = str_replace( '.css', '.dev.css', $stylesheet );

		/* If the stylesheet exists in the stylesheet directory, set the stylesheet URI to the dev stylesheet. */
		if ( file_exists( trailingslashit( STYLESHEETPATH ) . $stylesheet ) )
			$stylesheet_uri = trailingslashit( $stylesheet_dir_uri ) . $stylesheet;
	}

	/* Return the theme stylesheet. */
	return $stylesheet_uri;
}

/**
 * Function to load JavaScript at appropriate time.  Loads comment reply script only if users choose to 
 * use nested comments. Developers should load custom JavaScript with wp_enqueue_script() in their 
 * theme's functions.php file.
 *
 * A drop-downs.js file will be loaded if the theme supports 'hybrid-core-drop-downs'.  This is a version 
 * of the Superfish jQuery plugin.
 *
 * @since 0.1.0
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @link http://users.tpg.com.au/j_birch/plugins/superfish
 */
function hybrid_enqueue_script() {

	/* Don't load any scripts in the admin. */
	if ( is_admin() )
		return;

	/* Comment reply. */
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() )
		wp_enqueue_script( 'comment-reply' );

	/* Superfish drop-down menus. */
	if ( current_theme_supports( 'hybrid-core-drop-downs' ) )
		wp_enqueue_script( 'drop-downs', esc_url( apply_atomic( 'drop_downs_script', trailingslashit( HYBRID_JS ) . 'drop-downs.js' ) ), array( 'jquery' ), 1.4, true );
}

/**
 * Loads the correct function for handling attachments.  Checks the attachment mime type to call 
 * correct function. Image attachments are not loaded with this function.  The functionality for them 
 * should be handled by the theme's attachment or image attachment file.
 *
 * Ideally, all attachments would be appropriately handled within their templates. However, this could 
 * lead to messy template files.
 *
 * @since 0.5.0
 * @uses get_post_mime_type() Gets the mime type of the attachment.
 * @uses wp_get_attachment_url() Gets the URL of the attachment file.
 */
function hybrid_attachment() {
	$file = wp_get_attachment_url();
	$mime = get_post_mime_type();
	$mime_type = explode( '/', $mime );

	/* Loop through each mime type. If a function exists for it, call it. Allow users to filter the display. */
	foreach ( $mime_type as $type ) {
		if ( function_exists( "hybrid_{$type}_attachment" ) )
			$attachment = call_user_func( "hybrid_{$type}_attachment", $mime, $file );

		$attachment = apply_atomic( "{$type}_attachment", $attachment );
	}

	echo apply_atomic( 'attachment', $attachment );
}

/**
 * Handles application attachments on their attachment pages.  Uses the <object> tag to embed media 
 * on those pages.
 *
 * @since 0.3.0
 * @param string $mime attachment mime type
 * @param string $file attachment file URL
 * @return string
 */
function hybrid_application_attachment( $mime = '', $file = '' ) {
	$embed_defaults = wp_embed_defaults();
	$application = '<object class="text" type="' . esc_attr( $mime ) . '" data="' . esc_url( $file ) . '" width="' . esc_attr( $embed_defaults['width'] ) . '" height="' . esc_attr( $embed_defaults['height'] ) . '">';
	$application .= '<param name="src" value="' . esc_url( $file ) . '" />';
	$application .= '</object>';

	return $application;
}

/**
 * Handles text attachments on their attachment pages.  Uses the <object> element to embed media 
 * in the pages.
 *
 * @since 0.3.0
 * @param string $mime attachment mime type
 * @param string $file attachment file URL
 * @return string
 */
function hybrid_text_attachment( $mime = '', $file = '' ) {
	$embed_defaults = wp_embed_defaults();
	$text = '<object class="text" type="' . esc_attr( $mime ) . '" data="' . esc_url( $file ) . '" width="' . esc_attr( $embed_defaults['width'] ) . '" height="' . esc_attr( $embed_defaults['height'] ) . '">';
	$text .= '<param name="src" value="' . esc_url( $file ) . '" />';
	$text .= '</object>';

	return $text;
}

/**
 * Handles audio attachments on their attachment pages.  Puts audio/mpeg and audio/wma files into 
 * an <object> element.
 *
 * @todo Test out and support more audio types.
 *
 * @since 0.2.2
 * @param string $mime attachment mime type
 * @param string $file attachment file URL
 * @return string
 */
function hybrid_audio_attachment( $mime = '', $file = '' ) {
	$embed_defaults = wp_embed_defaults();
	$audio = '<object type="' . esc_attr( $mime ) . '" class="player audio" data="' . esc_url( $file ) . '" width="' . esc_attr( $embed_defaults['width'] ) . '" height="' . esc_attr( $embed_defaults['height'] ) . '">';
		$audio .= '<param name="src" value="' . esc_url( $file ) . '" />';
		$audio .= '<param name="autostart" value="false" />';
		$audio .= '<param name="controller" value="true" />';
	$audio .= '</object>';

	return $audio;
}

/**
 * Handles video attachments on attachment pages.  Add other video types to the <object> element.
 *
 * @since 0.2.2
 * @param string $mime attachment mime type
 * @param string $file attachment file URL
 * @return string
 */
function hybrid_video_attachment( $mime = false, $file = false ) {
	$embed_defaults = wp_embed_defaults();

	if ( $mime == 'video/asf' )
		$mime = 'video/x-ms-wmv';

	$video = '<object type="' . esc_attr( $mime ) . '" class="player video" data="' . esc_url( $file ) . '" width="' . esc_attr( $embed_defaults['width'] ) . '" height="' . esc_attr( $embed_defaults['height'] ) . '">';
		$video .= '<param name="src" value="' . esc_url( $file ) . '" />';
		$video .= '<param name="autoplay" value="false" />';
		$video .= '<param name="allowfullscreen" value="true" />';
		$video .= '<param name="controller" value="true" />';
	$video .= '</object>';

	return $video;
}

?>