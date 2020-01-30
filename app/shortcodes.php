<?php

namespace App;

/**
 * Add the shortcodes
 */

add_action( 'init', function() {
	$shortcodes_relative_path = 'shortcodes';

	collect( scandir( get_theme_file_path() . "/resources/views/$shortcodes_relative_path" ) )
		->reject( function( $item ) {
			return stristr( $item, '.blade.php' ) === false;
		} )
		->map( function( $item ) use ( $shortcodes_relative_path ) {
			$shortcode = str_ireplace( '.blade.php', '', $item );

			add_shortcode( $shortcode, function( $atts, $content ) use ( $shortcode, $shortcodes_relative_path ) {

				if ( is_array( $atts ) ) extract( $atts );

				// Start object caching or output
				ob_start();

				// Set the template we're going to use for the Shortcode
				$template = "$shortcodes_relative_path/$shortcode";

				// Set up template data
				$data = collect( get_body_class() )->reduce( function( $data, $class ) use ( $template ) {
					return apply_filters( "sage/template/{$class}/data", $data, $template );
				}, [] );

				$atts = empty( $atts ) ? [] : (array) $atts;

				$content = preg_replace( '~^\s*?</p>~', '', $content );
				$content = preg_replace( '~<p>\s*?$~', '', $content );

				// Echo the shortcode blade template
				echo template( $template, $data + $atts + compact( 'content' ) );

				// Return cached object
				return ob_get_clean();
			} );
		} );
} );
