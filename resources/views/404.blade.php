@extends('layouts.app')

@section('content')
    {{--@include('partials.page-header')--}}

    @if (!have_posts())
        <section class="container-max-width py-5 my-5 text-center">

            <div class="alert alert-warning my-5 d-inline-block">
                <h1>404</h1>
                {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
            </div>
            {{--<div class="my-5">--}}
            {{--{!! get_search_form(false) !!}--}}
            {{--</div>--}}
        </section>
    @endif
@endsection
