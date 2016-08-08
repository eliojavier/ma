<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="motivapp">
    <meta name="application-name" content="motivapp">
    <meta name="theme-color" content="#ffffff">

    <title>Motivapp | @yield('title')</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('head')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
    <body>
        <header>
            @yield('nav')
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            @yield('footer')
        </footer>

        <!-- Modal Structure -->
        <div id="login-modal" class="modal">
            <div class="modal-header right-align">
                <a href="#!" class="modal-action modal-close btn-floating waves-effect waves-light"
                   style="margin: 10px 10px 0 0">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
            <div class="modal-content">
                <div class="row">
                    <div class="col s8 offset-m2">
                        <a href="{{ url('/login/facebook') }}" class="btn waves-effect waves-light col s12 facebook-button">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                            Ingresa con tu cuenta de Facebook
                        </a>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 0">
                    <div class="col s12 m12">
                        <form class="card-panel hoverable" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            @include('auth.partials._login')
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        @yield('before-script-begin')
            <script src="{{ asset('js/main.js') }}"></script>
            <script src="{{ asset('js/plugins.js') }}"></script>
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                ga('create', 'UA-71284837-1', 'auto');
                ga('send', 'pageview');

            </script>

        @yield('after-script-end')

    </body>
</html>