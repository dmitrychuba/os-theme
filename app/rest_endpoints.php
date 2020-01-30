<?php

use Illuminate\Support\Str;

if ( class_exists( '\Services\RestEndpoints' ) ) {
	add_action( 'rest_api_init', function() {
		$rest_endpoints = new ReflectionClass( '\Services\RestEndpoints' );
		collect( $rest_endpoints->getMethods( ReflectionMethod::IS_STATIC ) )->map( function( $item ) {
			$endpoint = Str::slug( Str::snake( $item->name ) );
			register_rest_route( 'theme-endpoints/v1', $endpoint, [
				'methods'  => 'GET',
				'callback' => [ $item->class, $item->name ],
			] );
		} );
	} );
}
