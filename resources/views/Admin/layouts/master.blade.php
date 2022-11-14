<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('Admin/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('Admin/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('Admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('Admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('Admin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Vendor CSS-->
    <link href="{{asset('Admin/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('Admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('Admin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('Admin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('Admin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('Admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('Admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    {{-- cdn font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Main CSS-->
    <link href="{{asset('Admin/css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('Admin/images/icon/logo.png')}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="{{route('Category#list')}}">
                                <i class="fas fa-chart-bar"></i>Category</a>
                        </li>
                        <li>
                            <a href="{{route('product#list')}}">
                                <i class="fa-solid fa-pizza-slice"></i>Product</a>
                        </li>
                        <li>
                            <a href="{{route('admin#orderlist')}}">
                                <i class="fa-solid fa-list-check"></i>Order List</a>
                        </li>
                        <li>
                            <a href="{{route('admin#userlist')}}">
                                <i class="fa-solid fa-people-group"></i>User List</a>
                        </li>
                        <li>
                            <a href="{{route('admin#contact')}}">
                                <i class="fa-solid fa-inbox"></i>Contact Message</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <h4>Admin Dashboard</h4>
                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <a href="#">
                                                        <img src="{{asset('image/unknown.jpg')}}" alt="John Doe" />
                                                    </a>
                                                @else
                                                    <a href="#">
                                                        <img src="{{asset('image/unknown_female.jpg')}}" alt="John Doe" />
                                                    </a>
                                                @endif
                                            @else
                                            <img class="img-thumbnail" src="{{asset('storage/'. Auth::user()->image)}}">
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    @if (Auth::user()->image == null)
                                                        @if (Auth::user()->gender == 'male')
                                                            <a href="#">
                                                                <img src="{{asset('image/unknown.jpg')}}" alt="John Doe" />
                                                            </a>
                                                        @else
                                                            <a href="#">
                                                                <img src="{{asset('image/unknown_female.jpg')}}" alt="John Doe" />
                                                            </a>
                                                        @endif
                                                    @else
                                                    <a href="#">
                                                        <img class="img-thumbnail w-75" src="{{asset('storage/'. Auth::user()->image)}}" alt="">
                                                    </a>
                                                    @endif
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('auth#detail')}}">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('auth#accountlist')}}">
                                                        <i class="zmdi zmdi-accounts-list"></i>Account List</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('auth#changepassword')}}">
                                                        <i class="zmdi zmdi-key"></i>Change Password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form action="{{route('logout')}}" method="post" class="d-flex justify-content-center my-3">
                                                    @csrf
                                                    <button class="btn btn-dark col-6" type="submit"><i class="zmdi zmdi-power"></i>   Logout</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            {{-- start main contat --}}
            <div class="main-content">
                @yield('myContent')
            </div>
            {{-- end main content --}}
    </div>

    <!-- Jquery JS-->
    <script src="{{asset('Admin/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('Admin/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('Admin/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('Admin/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('Admin/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('Admin/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('Admin/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{asset('Admin/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
@yield('adminjs')
</html>
<!-- end document-->
