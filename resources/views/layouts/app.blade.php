<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Tıbbi Atık Paneli</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">

    @stack('customCss')

    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
</head>

<body>

<!--Preloader start-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--Preloader end-->

<!--Main wrapper start-->
<div id="main-wrapper">

    <!--Nav header start-->
    <div class="nav-header">
        <a href="{{route('dashboard')}}" class="brand-logo">
            <img class="logo-abbr" src="{{asset('assets/images/favicon.png')}}" alt="">
            <img class="logo-compact" src="{{asset('assets/images/logo-text.png')}}" alt="">
            <img class="brand-title" src="{{asset('assets/images/logo-text.png')}}" alt="">
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--Nav header end-->

    <!--Header start-->
        @include('inc.header')
    <!--Header end ti-comment-alt-->

    <!--Sidebar start-->
        @include('inc.sidebar')
    <!--Sidebar end-->

    <!--Content body start-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Tıbbi Atık Paneli</h4>
                        <p class="mb-0">Lütfen emin olmadığınız bir işlemi yapmayınız!</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="text-dark">Ana Sayfa</a></li>
                        <li class="breadcrumb-item active text-capitalize">{{request()->segment(1)}}</li>
                    </ol>
                </div>
            </div>

            @yield('content')

            <a class="btn btn-dark" href="javascript:void(0);" onclick="goBack();">Geri Dön</a>
        </div>
    </div>
    <!--Content body end-->

    <!--Footer start-->
    @include('inc.footer');
    <!--Footer end-->
</div>

<script src="{{asset('assets/js/global.min.js')}}"></script>
<script src="{{asset('assets/js/quixnav-init.js')}}"></script>
<script src="{{asset('assets/js/custom.min.js')}}"></script>
<script>
    function goBack() {
        var url = window.location.href;
        var segments = url.split('/');
        segments.pop();
        var previousUrl = segments.join('/');
        window.location.href = previousUrl;
    }
</script>
@stack('customJs')

</body>

</html>
