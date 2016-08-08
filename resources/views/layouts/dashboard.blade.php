<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Motivapp Admin| @yield('title')</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/dropzone.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.js"></script>

</head>
<body id="admin">

<header>
    <nav class="top-nav">
        <div class="nav-wrapper">
            <div class="container-fluid">
                <a class="btn" style="margin-left: 15px" href="{{ url('home') }}" target="_blank">Ver Página</a>
                <a class="page-title hide-on-small-and-down">Panel de Control</a>
                <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only">
                    <i class="material-icons">menu</i>
                </a>
                <ul class="right" style="padding-right: 50px">
                    <li><a style="color: #00aeef" href="{{ url('/logout') }}">Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <ul id="nav-mobile" class="side-nav fixed">
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="center-align">
                    <img style="padding:15px;" src="{{asset('img/LogoBig.png')}}" alt="Motivapp logo">
                </li>
                <li class="bold">
                    <a class="collapsible-header  waves-effect waves-motivapp-blue">Entradas</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('admin.posts.index') }}">Todos</a></li>
                            <li><a href="{{ route('admin.posts.create') }}">Añadir Nueva</a></li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header  waves-effect waves-motivapp-blue">Categorias</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('admin.categories.index') }}">Todos</a></li>
                            <li><a href="{{ route('admin.categories.create') }}">Añadir Nueva</a></li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header  waves-effect waves-motivapp-blue">Etiquetas</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('admin.tags.index') }}">Todos</a></li>
                            <li><a href="{{ route('admin.tags.create') }}">Añadir Nueva</a></li>
                        </ul>
                    </div>
                </li>
                <li class="bold">
                    <a class="collapsible-header  waves-effect waves-motivapp-blue">Medios</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('admin.media.index')}}">Biblioteca</a></li>
                            <li><a href="{{ route('admin.media.create') }}">Añadir Nuevo</a></li>
                        </ul>
                    </div>
                </li>
                <li class="bold">
                    <a  class="waves-effect waves-motivapp-blue" href="{{route('admin.slider.index')}}">Slider</a>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-motivapp-blue">Usuarios</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{route('admin.users.index')}}">Todos</a></li>
                            <li><a href="{{route('admin.users.create')}}">Añadir Nuevo</a></li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a href="{{route('collaborators.create')}}" class="collapsible-header waves-effect waves-motivapp-blue">Colaboradores</a>
                </li>
                <li class="bold">
                    <a href="{{ route('admin.videos.index') }}" class="waves-effect waves-motivapp-blue">Video</a>
                </li>
            </ul>
        </li>
    </ul>
</header>

<main>
    @yield('content')
</main>

<footer>
    @yield('footer')
</footer>

    <!-- Scripts -->
    @yield('before-script-begin')
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(".button-collapse").sideNav();
        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
    @yield('after-script-end')


</body>
</html>