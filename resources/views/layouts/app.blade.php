<!doctype html>
<html {!! get_language_attributes() !!}>
<head>
    <meta charset="{{ get_bloginfo('charset') }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    @head
    @yield('head')
</head>

<body {!! body_class() !!}>
@do_action('get_header')
<!--[if lt IE 7]>
<p class="browsehappy">
    You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
</p>
<![endif]-->
<main id="app" role="main" class="main-container d-flex flex-column">
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
</main>
@do_action('get_footer')
@footer
@yield('footer')
</body>
</html>
