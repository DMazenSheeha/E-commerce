@toastifyCss
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('loginForm')}}/fonts/icomoon/style.css">
    <link rel="stylesheet" href="{{asset('loginForm')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('loginForm')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('loginForm')}}/css/style.css">
    <title>@yield('title')</title>
</head>

<body>
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('{{asset('loginForm')}}/images/bg_1.jpg');"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    @yield("content")
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('loginForm')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{asset('loginForm')}}/js/popper.min.js"></script>
    <script src="{{asset('loginForm')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('loginForm')}}/js/main.js"></script>
</body>

</html>
@toastifyJs