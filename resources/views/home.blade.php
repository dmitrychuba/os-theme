{{--
  Template Name: Home Page
--}}

@extends('layouts.app')


{{--@section('footer')--}}
{{--@endsection--}}

@section('content')
    @while (have_posts()) @php the_post() @endphp

    @component('partials.section', [ 'class' => 'section-banner', 'slides' => [
	    'https://source.unsplash.com/1600x600/?mountains',
	    'https://source.unsplash.com/1600x600/?lions',
	    'https://source.unsplash.com/1600x600/?wildlife',
	    'https://source.unsplash.com/1600x600/?ocean',
	    'https://source.unsplash.com/1600x600/?elefants'
	] ])
        <div class="m-2">&nbsp;</div>
        <div class="d-flex justify-content-center align-items-center p-5 m-5">
            <h1>Section content!</h1>
        </div>

    @endcomponent

    @endwhile
@endsection
