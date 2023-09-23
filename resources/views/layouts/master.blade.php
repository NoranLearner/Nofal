<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="google-site-verification" content="kk5Fdpx355TSI9qMxCMUXQ9bBhFZu0DveMlcV-H1Qzk" />
    <meta name="description" content="nozha admin panel fully support rtl with complete dark mode css to use. ">
    <meta name=”robots” content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">
    @include('layouts.head')
</head>

<body class="">

    <div class="bmd-layout-container bmd-drawer-f-l avam-container animated bmd-drawer-in">

        {{-- Header Bar --}}

        @include('layouts.main-headerbar')

        {{-- Sidebar --}}

        @include('layouts.main-sidebar')

        <main class="bmd-layout-content">

            <div class="container-fluid ">

                <!-- content -->

                <!-- breadcrumb -->

                <div class="row  m-1 pb-4 mb-3 ">
                    <div class="col-xs-12  col-sm-12 col-md-12 col-lg-12 p-2">
                        <div class="page-header breadcrumb-header ">
                            <div class="row align-items-end ">
                                <div class="col-lg-8">
                                    <div class="page-header-title text-left-rtl">
                                        <div class="d-inline">
                                            <h3 class="lite-text ">@yield('page_title')</h3>
                                            <span class="lite-text text-gray">@yield('page_desc')</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item ">
                                            <a href="#">
                                                @yield('page_icon')
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item ">
                                            <a href="#">@yield('page_title1')</a>
                                        </li>
                                        <li class="breadcrumb-item active">@yield('page_title2')</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content --}}

                @yield('content')

            </div>
        </main>
    </div>

    </div>

    @include('layouts.footer')

    @include('layouts.scripts')

</body>

</html>
