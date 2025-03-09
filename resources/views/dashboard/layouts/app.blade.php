@toastifyCss
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$urlArray[count($urlArray) - 1] == "" ? "Dashboard" : ucwords($urlArray[count($urlArray) - 1])}}</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <style>
        .wrapper {
            min-height: 100dvh;
            height: fit-content;
        }

        .elevation-4 {
            height: 100dvh;
        }

        .content-wrapper {
            min-height: 90dvh !important;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 70px !important;
            max-height: 70px !important;
        }

        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loader .spinner {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    @yield("style")
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div id="loader" class="loader">
            <span class="spinner"></span>
        </div>
        <div class="main-sidebar">
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="{{route('dashboard')}}" class="brand-link">
                    <span class="brand-text font-weight-light">Dashboard</span>
                </a>
                <div class="sidebar">
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                            <li class="nav-item">
                                <a href="{{route('products.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Products
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('categories.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Categories
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('orders.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Orders
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('users.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Users
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admins.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Admins
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
        </div>
        <div class="content-wrapper p-4">
            <div class="content-header">
                <div class="float-left">
                    @if($urlArray[count($urlArray) - 1] != "")
                    @foreach($urlArray as $url)
                    @if($urlArray[count($urlArray) - 1] !== $url)
                    <a href="{{config('app.url').implode("/", array_slice($urlArray, 0,array_search($url, $urlArray) + 1))}}">{{ucwords($url)}}</a>
                    @if($url !== $urlArray[0]) / @endif
                    @else
                    {{ucwords($url)}}
                    @endif
                    @endforeach
                    @else
                    Dashboard
                    @endif
                </div>
                <div class="float-center">
                    @yield('header-center-section')
                </div>
                <div class="float-right">
                    @yield('header-right-section')
                </div>
            </div>
            @yield("content")
        </div>
        <div class="main-footer">
            Developed By <a href="https://www.instagram.com/shee_7a/" target="_blank">Mazen Sheeha</a>
        </div>
    </div>
    @yield("script")
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            document.getElementById('loader').style.display = "flex";
        })
        window.addEventListener("load", () => {
            document.getElementById('loader').style.display = 'none';
        })
    </script>
    <script src="{{ asset('vendor/adminlte/js/adminlte.min.js')}}"></script>
</body>

</html>
@toastifyJs