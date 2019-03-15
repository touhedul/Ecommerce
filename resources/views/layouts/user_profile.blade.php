<html>
<head>
    <title>@yield('title')</title>
    @include('includes.css-link')
</head>
<body>
    <!--Navigation Start-->
    @include('includes.navbar')
    <!--End Navigation-->
    <!--Side bar + content start-->
    <div class="container margin-top-20">
        <div class="row">
            <!--Sidebar Start-->
            @include('includes.user_sidebar')
            <!--Stidebar End-->
            <!--Content Start-->

            <div class="col-md-8">
                @include('pages.admin.partials.messages')
                <div class="card card-body">
                    @yield('content')
                </div>
            </div>
            <!--Content End-->
        </div>
    </div>

    <!--Side bar + content end-->
    <!--Footer Start-->
    @include('includes.footer')
    <!--Footer End-->
    @include('includes.scripts')
</body>
</html>

