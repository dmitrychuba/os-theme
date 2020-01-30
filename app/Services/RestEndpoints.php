<?php

namespace Services;

use function App\template;

class RestEndpoints
{

	public static function getHeaderFooterHtml()
	{
		return [ 'header' => template( 'layouts.header' ), 'footer' => template( 'layouts.footer' ) ];
	}


	public static function getHeaderHtml()
	{
		return template( 'layouts.header' );
	}


	public static function getFooterHtml()
	{
		return template( 'layouts.footer' );
	}

}
