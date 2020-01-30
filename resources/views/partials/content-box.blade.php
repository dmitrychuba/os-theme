<?php
if ( ! empty( $faker ) ) {
	$box['category'] = ! empty( $box['category'] ) ? $box['category'] : strtoupper( $faker->sentence( 2 ) );
	$box['title']    = ! empty( $box['title'] ) ? $box['title'] : $faker->sentence( 5 );

	if ( empty( $box['text'] ) && empty( $box['image'] ) ) {
		if ( ! ! rand( 0, 1 ) ) {
			$box['text'] = ! empty( $box['text'] ) ? $box['text'] : $faker->realText( 120 );
		} else {
			$box['image'] = ! empty( $box['text'] ) ? $box['image'] : 'https://picsum.photos/200?random=' . $i;
		}
	}
}

$attr = ! empty( $box['attr'] ) ? ' ' . App\arr_to_attr( $box['attr'] ) : '';
?>
<div class="content-box col-12 col-sm-6 col-md-4 col-lg-3{{ !empty($box['color']) ? " content-box--{$box['color']}" : '' }}"{!! $attr !!}>
    <div class="content-box__lift-up-tile">
        <div class="content-box__wrapper">
            <a href="{{ $box['link'] or '#' }}" class="content-box__clickable"></a>
            <div class="content-box__head">
                <h6 class="content-box__category">{{ $box['category'] or null }}</h6>
                <h4 class="content-box__title">{{ $box['title'] or null }}</h4>
            </div>
            <div class="content-box__line"></div>
            @if( !empty( $box['image'] ) )
                <img src="{{ $box['image'] }}" class="content-box__image">
            @endif
            @if( !empty( $box['text'] ) )
                <div class="content-box__text">{{ $box['text'] }}</div>
            @endif
            <a href="{{ $box['link'] or '#' }}" class="content-box__read-more">READ MORE</a>
        </div>
    </div>
</div>
