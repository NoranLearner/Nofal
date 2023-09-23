<title>@yield('title')</title>

<link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('assets/img/favicon/apple-touch-icon.png') }}">

<link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('assets/img/favicon/favicon-32x32.png') }}">

<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('assets/img/favicon/favicon-16x16.png') }}">

<link rel="manifest" href="{{ URL::asset('assets/img/favicon/site.webmanifest') }}">

<link rel="mask-icon" href="{{ URL::asset('assets/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">

<!-- Place favicon.ico in the root directory -->

<link rel="stylesheet" href="{{ URL::asset('assets/css/normalize.css') }}">

<link rel="stylesheet" href="{{ URL::asset('assets/css/fontawsome/all.min.css') }}">

<link rel="stylesheet"
    href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
    integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">

{{-- Error --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<link rel="stylesheet" href="{{ URL::asset('assets/css/main.css') }}">

@yield('css')
