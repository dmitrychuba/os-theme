<?php

namespace App\Controllers;

use App\Controllers\Partials\Video;
use Faker\Factory;
use Illuminate\Support\Collection;
use Sober\Controller\Controller;
use App\Controllers\Partials\Image;

class App extends Controller
{

	use Image, Video;


	public function faker()
	{
		return Factory::create();
	}


	public function siteName()
	{
		return get_bloginfo( 'name' );
	}


	public static function title()
	{
		if ( is_home() ) {
			if ( $home = get_option( 'page_for_posts', true ) ) {
				return get_the_title( $home );
			}

			return __( 'Latest Posts', 'sage' );
		}
		if ( is_archive() ) {
			return get_the_archive_title();
		}
		if ( is_search() ) {
			return sprintf( __( 'Search Results for %s', 'sage' ), get_search_query() );
		}
		if ( is_404() ) {
			return __( 'Not Found', 'sage' );
		}

		return get_the_title();
	}
}
