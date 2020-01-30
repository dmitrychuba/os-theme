@empty($video_src)
    <p class="text-center">
        <em class="small text-danger bg-light p-2">Please provide 'src' parameter a view-popup component</em>
    </p>
@else
    @php($image_src = $image_src ?? FrontPage::getVideoThumbnail($video_src))

    @empty($image_src)
        <a href="{{ $video_src }}" class="my-1 text-center d-block position-relative text-warning" data-lity>
            Play Video <i class="fa fa-play-circle"></i>
        </a>
        <p class="text-center">
            <em class="small text-danger bg-light p-2">Cannot extract video thumbnail, please select it manually in admin</em>
        </p>
    @else
        <a href="{{ $video_src }}" class="my-1 text-center d-block position-relative" data-lity>
            <i class="fa fa-play-circle fa-5x absolute-center text-warning"></i>
            <img src="{{ $image_src }}" class="w-100" alt="{{ FrontPage::getVideoTitle($src) }}">
        </a>
    @endempty
@endempty
