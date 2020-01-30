<header id="mainHeader" class="sticky-header sticky-header--slide-down">
    <div class="header-content container-fluid d-flex flex-wrap align-items-center justify-content-center p-3">
        <a href="{{ home_url() }}" class="logo mr-auto"><img src="{{ \App\asset_path('images/logo-full.png') }}" alt=""></a>
        @menu([ 'menu'=>'main-menu', 'menu_id' => 'main-menu', 'menu_class' => 'menu-dropdown d-flex justify-content-center align-items-center col', 'container'=>'' ])
        <div class="i-plus"></div>
        <div class="menu-trigger-button"></div>
    </div>
    <div id="headerBar" data-animate="fadeInDownSmall:1s,.5s">
        <p>&nbsp;</p>
    </div>
</header>
