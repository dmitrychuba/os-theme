<?php

namespace App;

if ( ! function_exists( 'get_link_attrs' ) ) {
	function get_link_attrs( $link_array, $attrs = [] )
	{
		if ( is_object( $link_array ) ) {
			$link_array = (array) $link_array;
		}

		$attrs_def = [];

		if ( ! empty( $link_array['url'] ) ) {
			$attrs_def['href'] = $link_array['url'];
			unset( $link_array['url'] );
		}

		if ( ! empty( $link_array['target'] ) ) {
			$attrs_def['target'] = $link_array['target'];
		}

		$attrs_def = array_merge( $attrs_def, $attrs );

		$attrs_str = '';
		foreach ( $attrs_def as $attr => $val ) {
			$attrs_str .= ' ' . $attr . '="' . $val . '"';
		}

		return ! empty( $attrs_str ) ? $attrs_str : null;
	}
}

if ( ! function_exists( 'get_the_link' ) ) {
	function get_the_link( $link_array_url, $attrs = [] )
	{
		if ( is_object( $link_array_url ) ) {
			$link_array_url = (array) $link_array_url;
		}

		if ( ! empty( $attrs['text'] ) || ( isset( $attrs['text'] ) && $attrs['text'] === false ) ) {
			$link_title = $attrs['text'];
			unset( $attrs['text'] );
		} else if ( ! empty( $link_array_url['title'] ) ) {
			$link_title = $link_array_url['title'];
			unset( $link_array_url['title'] );
		} else if ( is_string( $link_array_url ) ) {
			$link_title = false;
		}

		if ( is_string( $link_array_url ) ) {
			$link_array_url = [
				'url' => $link_array_url,
			];
		}

		if ( empty( $link_array_url['url'] ) && empty( $link_title ) ) {
			return null;
		}

		$html = '<a' . get_link_attrs( $link_array_url, $attrs ) . '>';
		if ( ! empty( $link_title ) || ( isset( $link_title ) && $link_title === false ) ) {
			$html .= $link_title;
		} else {
			$html .= $link_array_url['url'];
		}
		$html .= '</a>';

		return $html;
	}
}

if ( ! function_exists( 'get_the_image_src' ) ) {
	function get_the_image_src( $image_array_url, $size = 'medium_large' )
	{
		$src = null;

		if ( is_object( $image_array_url ) ) {
			$image_array_url = (array) $image_array_url;
		}

		if ( is_array( $image_array_url ) ) {
			if ( ! empty( $image_array_url['sizes'] ) && is_object( $image_array_url['sizes'] ) ) {
				$image_array_url['sizes'] = (array) $image_array_url['sizes'];
			}

			if ( ! empty( $image_array_url['sizes'] ) && ! empty( $image_array_url['sizes'][$size] ) ) {

				$src = $image_array_url['sizes'][$size];
			} elseif ( ! empty( $image_array_url['url'] ) ) {
				$src = $image_array_url['url'];
			}
		} elseif ( is_string( $image_array_url ) ) {
			$src = $image_array_url;
		}

		return $src;

	}
}

if ( ! function_exists( 'arr_to_attr' ) ) {
	function arr_to_attr( $array )
	{
		return str_replace( "=", '="', urldecode( http_build_query( $array, null, '" ', PHP_QUERY_RFC3986 ) ) ) . '"';
	}
}
