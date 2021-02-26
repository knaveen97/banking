<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>A2N Bank</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .carousel-item {
            /* height: 900px; */
            overflow-y: hidden;
            width: 100%;
        }

        .carousel-item img {
            width: 100% !important;
            height: 90vh !important;
        }
    </style>
</head>

<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-0 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal">A2N BANK</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            @if (Route::has('login'))
            @auth
            <a class="btn btn-outline-primary" href="{{ url('/home') }}">Go To Home</a>
            @else
            <a class="btn btn-outline-primary" href="{{ route('login') }}">Log In</a>
            @if (Route::has('register'))
            <a class="btn btn-outline-success" href="{{ route('register') }}">Register</a>
            @endif
            @endauth
            @endif
        </nav>
    </div>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-75" src="{{url('/img/1.png')}}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-75" src="{{url('/img/3.png')}}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-75" src="{{url('/img/2.png')}}" alt="Third slide">
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

</body>

</html>