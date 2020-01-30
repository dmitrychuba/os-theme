<?php

namespace App\Controllers\Partials;

use MediaEmbed\MediaEmbed;

trait Video
{

	public static function getVideoEmbedTag( $videoString )
	{
		global $wp_embed;

		$video_w = 500;
		$video_h = $video_w / 1.61; // 1.61 golden ratio

		$embed = '';

		if ( is_object( $wp_embed ) ) {
			$embed = $wp_embed->run_shortcode( '[embed width="' . $video_w . '"' . $video_h . ']' . $videoString . '[/embed]' );
		}

		return $embed ?? null;

		//$media_embed = ( new MediaEmbed() )->parseUrl( $videoString );
		//return $media_embed->getEmbedCode() ?? null;
	}



	public static function getVimeoThumbnail( $id )
	{

		$data = json_decode( file_get_contents( "http://vimeo.com/api/v2/video/$id.json" ) );

		return ! empty( $data[0] ) && ! empty( $data[0]->thumbnail_large ) ? $data[0]->thumbnail_large : null;
	}


	public static function getYoutubeThumbnail( $id )
	{
		return "https://img.youtube.com/vi/$id/maxresdefault.jpg";
	}


	public static function isVideo( $videoString )
	{
		$media_embed = ( new MediaEmbed() )->parseUrl( $videoString );

		return ! empty( $media_embed );
	}


	public static function getVideoThumbnail( $videoString )
	{
		$thumbnail = null;

		$media_embed = ( new MediaEmbed() )->parseUrl( $videoString );

		switch ( $media_embed->slug() ) {
			case "vimeo":
				$thumbnail = self::getVimeoThumbnail( $media_embed->id() );
			break;
			case "youtube":
				$thumbnail = self::getYoutubeThumbnail( $media_embed->id() );
			break;
		}

		return $thumbnail;
	}


	public static function getVideoTitle( $videoString )
	{
		$wp_oembed  = new \WP_oEmbed();
		$video_data = $wp_oembed->get_data( $videoString );

		return $video_data->title;
	}
}
