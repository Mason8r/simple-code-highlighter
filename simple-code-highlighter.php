<?php

/*
Plugin Name: simple code highlighter
Plugin URI: http://stuartmason.co.uk/sch
Author: Stu Mason
Author URI: http://www.stuartmason.co.uk/
Description: PHP & JS Syntax highlighter
Version: 0.1.0
Text Domain: Stucode
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

//Get the highlight stuff from the highlight CDN
function load_highlight_js()
{
    // grabbing it from the CDN for now...
    wp_register_script( 'highlight_js', '//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js' , ('jQuery') , true );
    // queue it
    wp_enqueue_script( 'highlight_js' );
}
add_action('wp_enqueue_scripts', 'load_highlight_js');

function load_highlight_css()
{
	// grab the shit from CDN again
	wp_register_style( 'highlight_styles' , '//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/default.min.css' );
	// queue it
	wp_enqueue_style( 'highlight_styles' );
}
add_action('wp_enqueue_scripts','load_highlight_css');

//initialise the hightlight JS 
function initialise_highlight_js() 
{ 
	echo '<script>hljs.initHighlightingOnLoad();</script>';
} 
add_action('wp_footer', 'initialise_highlight_js'); 

function stucode_shortcode( $atts, $content = null ) {
	if(!isset($atts['language'])) {
		$atts['language'] = 'php';
	}
	return '<pre><code class="' . $atts['language'] . '">' . $content . '</code></pre>';
}
add_shortcode( 'code', 'stucode_shortcode' );

