@empty($video_src)
    <p class="text-center">
        <em class="small text-danger bg-light p-2">Please provide 'src' parameter a view-embed component</em>
    </p>
@else
    <div class="my-1 video-responsive">
        {!! FrontPage::getVideoEmbedTag($video_src) !!}
    </div>
@endempty
