<?php

namespace App\Controllers\Partials;

trait Image
{

	public static function get_bg_image( $src, $style_attribute = true, $size = 'medium_large' )
	{
		if ( is_array( $src ) ) {
			$src = self::get_image_url( $src, $size );
		}

		if ( empty( $src ) ) {
			return null;
		}

		return $style_attribute ? 'style="background-image: url(' . $src . ')"' : 'background-image: url(' . $src . ');';
	}


	public static function bg_image( $src, $style_attribute = true )
	{
		echo ! empty( $src ) ? self::get_bg_image( $src, $style_attribute ) : '';
	}


	public static function get_image_url( $image_array, $size = 'medium_large' )
	{
		$image_url = null;
		if ( ! empty( $image_array['sizes'] ) && ! empty( $image_array['sizes'][$size] ) ) {
			$image_url = $image_array['sizes'][$size];
		} else if ( $image_array['url'] ) {
			$image_url = $image_array['url'];
		}

		return $image_url;
	}


	public static function get_image( $image_id_array, $attrs = [], $size = '' )
	{

		if ( is_array( $image_id_array ) && ! empty( $image_id_array['ID'] ) ) {
			$attachment_id = $image_id_array['ID'];
		} elseif ( is_numeric( $image_id_array ) ) {
			$attachment_id = $image_id_array;
		} else {
			return null;
		}

		return wp_get_attachment_image( $attachment_id, $size, false, $attrs );
	}
}
