
        <!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
            @include('includes.css-link')
    <link rel="stylesheet" type="text/css" href="{{asset('css/stylelogin.css')}}" media="screen" />
</head>
<body>


<div class="container">
    <section id="content">
        @include('pages.admin.partials.messages')
        <form action="{{route('admin.login.submit')}}" method="post">
            <h1>Admin Login</h1>
            <div>
                <input type="text" placeholder="Email" required="" name="email"/>
            </div>
            <div>
                <input type="password" placeholder="Password" required="" name="password"/>
            </div>
            <div>
                <input type="submit" name="login" value="Log in" />
            </div>
            @csrf
        </form><!-- form -->
        <a href="{{route('admin.password.request')}}">Forget Password !</a>
        <div class="button">
        </div><!-- button -->
    </section><!-- content -->
</div><!-- container -->
</body>
</html>