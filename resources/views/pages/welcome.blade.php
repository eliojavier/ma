@extends('layouts.app')

@section('title', 'Bienvenido')
<h1>Holis</h1>
@section('nav')
    <div class="navbar-fixed">
        <!-- Dropdown Structure -->
        <ul id="dropdown1" class="dropdown-content" >
            <li><a href="{{ url('profile') }}">Perfil</a></li>
            <li class="divider"></li>
            <li><a href="{{ url('/logout') }}">Salir</a></li>
        </ul>
        <nav id="menu" role="navigation" class="remove-box-shadow">
            <div class="container">
                <div class="nav-wrapper" role="navigation">
                    <a href="{{ url('home') }}" class="brand-logo">
                        <img class="responsive-img" src="{{ asset('img/nav/Motivapp.png') }}" alt="Motivapp">
                    </a>
                    @if(Auth::guest())
                        <a class="button-collapse modal-trigger" href="#login-modal" style="float: right">
                            <div class="valign-wrapper login-icon-container">
                                <img class="valign responsive-img" src="{{ asset('img/nav/LoginIcon.png') }}" alt="Login">
                            </div>
                        </a>
                    @endif

                    <ul class="right hide-on-med-and-down">
                        @if (Auth::check())
                            <li class="valign-wrapper" style="height: 64px">
                                <a class="valign dropdown-button" href="#!" data-activates="dropdown1">
                                    <div class="circle center-align white-text nav-profile-icon">
                                        {{ Auth::user()->getInitialsFromName() }}
                                    </div>
                                </a>
                            </li>
                        @else
                            <li>¿Ya tienes una cuenta?</li>
                            <li><a class="waves-effect waves-light btn modal-trigger" href="#login-modal" style="margin-right: 0">Ingresa</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
@endsection

@section('content')
    <div class="section no-pad-bot">
        {{-- Register --}}
        <div class="container">

            <div class="row">
                <div class="col s12">

                    <div class="register top">
                        <div class="halo center-align">
                            <img class="responsive-img" src="{{ asset('img/LogoBig.png') }}" alt="Motivapp logo">
                        </div>
                        {{-- Partial auth/register --}}
                        @include('auth.partials._register')
                    </div>
                </div>
                <div class="col s12 center-align" style="position: relative">
                    <ul id="first-text">
                        <li>
                            <h2>
                                ¿Cómo te puedes
                                <br/>
                                <span>motivar?</span>
                            </h2>
                        </li>
                    </ul>
                    <div class="gradient-line"></div>
                </div>
            </div>
        </div>
        {{-- learn --}}
        <div class="col s12">
            <div id="discover" class="hero">
                <div class="halo center-align">
                    <img class="responsive-img" src="{{ asset('img/LogoMedium.png') }}" alt="Motivapp logo">
                </div>
                <div class="motivapp-blue">
                    <div class="container">
                        <div class="row">
                            <div class="col s12  hero-content center-align valign-wrapper">
                                <div class="valing">
                                    <ul id="second-text">
                                        <li>
                                            <h2>DESCUBRE</h2>
                                            <p class="flow-text">
                                                Encuentra la forma de sentirte bien, con la ayuda de profesionales
                                                calificados en nuestros cuatro pilares.
                                            </p>
                                        </li>
                                    </ul>
                                    <div class="col m3 s6">
                                        <square type="activity">
                                            <a href="{{ url('pages/physical-activity') }}">
                                                <img class="responsive-img"
                                                     src="{{ asset('img/squareLinks/Activity.png') }}"
                                                     alt="Actividad Fisica | Imagen">
                                            </a>
                                        </square>
                                    </div>
                                    <div class="col m3 s6">
                                        <square type="personal-grow">
                                            <a href="{{ url('pages/personal-grow') }}">
                                                <img class="responsive-img" src="{{ asset('img/squareLinks/PG.png') }}"
                                                     alt="Crecimiento Personal | Imagen">
                                            </a>
                                        </square>
                                    </div>
                                    <div class="col m3 s6">
                                        <square type="health">
                                            <a href="{{ url('pages/health') }}">
                                                <img class="responsive-img"
                                                     src="{{ asset('img/squareLinks/Health.png') }}"
                                                     alt="Salud| Imagen">
                                            </a>
                                        </square>
                                    </div>
                                    <div class="col m3 s6">
                                        <square type="nutrition">
                                            <a href="{{ url('pages/nutrition') }}">
                                                <img class="responsive-img"
                                                     src="{{ asset('img/squareLinks/Nutrition.png') }}"
                                                     alt="Nutrición | Imagen">
                                            </a>
                                        </square>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- learn --}}
        <div class="col s12">
            <div id="learn" class="hero">
                <div class="halo center-align">
                    <img class="responsive-img" src="{{ asset('img/LogoMedium.png') }}" alt="Motivapp logo">
                </div>
                <div class="motivapp-green">
                    <div class="container">
                        <div class="row">
                            <div class="col m6 s12  hero-content center-align valign-wrapper">
                                <div class="valing">
                                    <ul id="third-text">
                                        <li>
                                            <h2>APRENDE</h2>
                                            <p class="flow-text">
                                                Identifica con nosotros las soluciones que mejor se adaptan a tu estilo
                                                de vida.
                                            </p>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            <div class="col m6 s12  hero-content valign-wrapper">
                                <ul id="labels">
                                    <li>
                                        <div class="valign center-align" style="padding: 20px 0 40px 0">
                                            @if(! empty($tags))
                                                @foreach($tags as $tag)
                                                    <div class="chip">
                                                        {{ $tag->display_name }}
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Share--}}
        <div class="col s12">
            <div id="share" class="hero">
                <div class="halo center-align">
                    <img class="responsive-img" src="{{ asset('img/LogoMedium.png') }}" alt="Motivapp logo">
                </div>
                <div class="motivapp-red">
                    <div class="container">
                        <div class="row">
                            <div class="col m6 s12  hero-content center-align valign-wrapper">
                                <div class="valing">
                                    <ul id="fourth-text">
                                        <li>
                                            <h2>COMPARTE</h2>
                                            <p class="flow-text open-sans">
                                                Cuéntanos lo que has
                                                logrado con nuestras recomendaciones y retos.
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <ul id="fab-menu" style="position: relative">
                                    <li>
                                        @include('layouts.partials._fab')
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Register Again --}}
        <div id="enterprise-registration" class="container">
            <div class="row no-margin-bottom">
                <div class="col s12">
                    <div class="register bottom">
                        @include('auth.partials._registerEnterprise')
                        <div class="halo"></div>
                    </div>
                </div>
            </div><!-- end .row-->

            <div class="valign-wrapper default-margin-bottom">
                <img class="responsive-img valign centering" src="{{ asset('img/LogoBig.png') }}" alt="Motivapp logo">
            </div>

        </div>
    </div>
    @endsection

    @section('footer')
    @include('layouts.partials._footer',['footerClass' => 'welcome-footer'])
    @endsection

@section('after-script-end')
    <!-- Modal Structure -->
    <div id="modal1" class="modal custom-modal">
        <div class="modal-content center-align">
            <img class="responsive-img centering" src="{{asset('img/popup.jpg')}}" alt="Motivapp">
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#modal1').openModal();
            
            var options = [
                {
                    selector: '#first-text', offset: 200, callback: function () {
                    Materialize.showStaggeredList("#first-text");
                }
                },
                {
                    selector: '#second-text', offset: 200, callback: function () {
                    Materialize.showStaggeredList("#second-text");
                }
                },
                {
                    selector: '#third-text', offset: 200, callback: function () {
                    Materialize.showStaggeredList("#third-text");
                }
                },
                {
                    selector: '#fourth-text', offset: 200, callback: function () {
                    Materialize.showStaggeredList("#fourth-text");
                }
                },
                {
                    selector: '#labels', offset: 200, callback: function () {
                    Materialize.showStaggeredList("#labels");
                }
                }
            ];
            Materialize.scrollFire(options);
        });
    </script>
@endsection