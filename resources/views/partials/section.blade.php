<section
        {!! !empty($id)?' id="'.$id.'"' : null !!}
        {!! !empty($class) ? ' class="'.$class.'"' : null !!}>

    @if(!empty($background_image))
        <div class="section__background-image" data-animate="fadeInZoomOut:2s,.5s" style="background-image: url('{{ $background_image }}')"></div>
    @endif

    @if(!empty($slides))
        <background-slider data-animate="fadeInZoomOut:2s,.5s" :slides='@json($slides)'></background-slider>
    @endif

    @if(!empty($slot))
        <div class="section__wrapper">{{ $slot }}</div>
    @endif

</section>
