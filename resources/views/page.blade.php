@extends('layouts.app')

@section('content')

    @component('partials.section', ['class'=>'flex-grow-1'])
        @while(have_posts())
            @php the_post() @endphp

            <div class="container">
                @include('partials.page-header')
                @include('partials.content-page')
            </div>

            @if (App\display_sidebar())
                <aside class="col-2 sidebar">
                    @include('layouts.sidebar')
                </aside>
            @endif
        @endwhile

    @endcomponent


@endsection
