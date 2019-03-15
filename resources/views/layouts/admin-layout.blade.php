<html>
    <head>
        <title>@yield('title')</title>
        @include('pages.admin.partials.css-link')
    </head>
    <body>
        <div class="container-scroller">


            <!--Navigation Start-->
            @include('pages.admin.partials.navbar')
            <div class="container-fluid page-body-wrapper">
                <!--End Navigation-->
                <!--Side bar + content start-->

                <!--Sidebar Start-->
                @include('pages.admin.partials.sidebar')
                <div class="main-panel">
                    <div class="content-wrapper">
                        @include('pages.admin.partials.messages')
                        @yield('content')

                        @include('pages.admin.partials.footer')
                    </div>
                </div>
            </div>
        </div>
        <!--Footer End-->
        @include('pages.admin.partials.scripts')
    </body>
</html>

