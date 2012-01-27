<?php 

/**
 * GDGS Project Starter Style
 * 
 * For new Web projects.
 * 
 *
 * @cssdoc          version 1.0-pre
 * 
 * @site            Getting Dress'd Grid System
 * @link            http://nerdfiles.net/gdgs/
 * @author          nerdfiles
 * @copyright       Copyright (c) 2010, 2010-2011 by nerdfiles (Aaron Alexander)
 * @license         Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License
 *
 * @project         gdgs
 * @version         0.0.1
 * @package         gdgs-optional
 * @subpackage      gdgs-project
 * @since           0.0.1
 * @date            2011-03-09 03:06
 * @lastmodified    2011-03-09 03:06
 *
 * @todo            Take relevant stuff from Standardize module.
 *
 * @css-for         all
 * @media           all
 * @affected        all
 * @bugfix
 * @workaround
 * @tested          all
 * @valid           true
 */

/**
 * HTTP Headers
 */

header('content-type:text/css');
header("Expires: ".gmdate("D, d M Y H:i:s", (time()+900)) . " GMT"); 

/**
 * GDGS Constants
 */
 
define( "ROOT", $_SERVER['DOCUMENT_ROOT'] );
define( "CSSPATH", "" );

/**
 * css_loader
 * 
 * Order counts!
 *
 * @usage   Let's call this  
 *              [E]link 
 *                  @rel:           stylesheet 
 *                  @href:          http://nerdfiles.net/gdgs/_css-lib/gdgs/module-importer.php?
 *                      _modules =  reset.css,
 *                                  font.css,
 *                                  typesetting.css,
 *                                  system.css,
 *                                  form.css,
 *                                  tools.css,
 *                                  table.css,
 *                                  bounds.css,
 *                                  standardize.css,
 *                                  engine-importer.css,
 *                                  browser-importer.css,
 *                                  device-importer.css,
 *                                  page.css,
 *                                  print.css
 *                              &
 *                      _compress = true" />
 *
 *                      <link 
 *                          rel="stylesheet" 
 *                          href="http://nerdfiles.net/gdgs/_css-lib/gdgs/module-importer.php?_modules=
 *                              reset.css,font.css,typesetting.css,system.css,form.css,tools.css,
 *                              table.css,bounds.css,standardize.css" />
 *
 * @todo            Consider replacing standardize with "style.css", to allow a hook into all this madness. 
 */
    
function css_loader() {

    // Check if param _compress is set and true, all else, including false,
    // will fail to trigger regex compression.
    
    $compress = ( isset($_GET['_compress']) && $_GET['_compress'] == 'true' ) 
                ? $_GET['_compress'] 
                : false;
    
    // Create CSS output array.
    
    $cssoutput = array();
    
    /**
     * Modules
     */

    $modules = $_GET['_modules'];
    $modulesArray = explode( ",", $modules );    
    $modulePath = CSSPATH . "_modules/";

    foreach( $modulesArray as $key => $module ) {
    
        $module_stylesheet = $modulePath . $module;
        
        if ( file_exists( $module_stylesheet ) ) {
        
            // File system open and close
            $newfile = fopen( $module_stylesheet, "r" );
            $file_content = fread( $newfile, filesize( $module_stylesheet ) );
            fclose( $newfile );
            
            array_push( $cssoutput, $file_content );
            
        }
        
    }
    
    /**
     * Pages
     *
     * Develop paging schema that depends on URL only. If one can stipulate the URL schema,
     * then this can work.
     */
    
    $pageName = $_SERVER['PHP_SELF']; // for if (preg_match('/pageName/',$self))
    
    // Combine CSS modules.

    $css = join("", $cssoutput);
    
    /**
     * Apply compression.
     */
    
    if ( $compress ) {
    
        // strips but leaves spaces
        // preg_replace( '/(\/\*[\s\S]*?\*\/¦[\r]¦[\n]¦[\r\n])/', '', $css );
        
        // strips whitespace, tabs, and comments
        $css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
        $css = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css );
    }

    // Print CSS.
    
    echo $css;

}

css_loader();
?>
