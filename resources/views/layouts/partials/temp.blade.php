
<nav id="main-menu" role="navigation" class="remove-box-shadow">
    <div class="container">
        <div class="nav-wrapper center-align" role="navigation">
            <a id="logo" href="#!" class="brand-logo center">
                <img class="responsive-img" src="{{ asset('img/motivapp-written-logo.png') }}" alt="Motivapp"></a>
                <span id="section-article-title"></span>
            <ul class="right hide-on-small-and-down">
                <li>
                    <i class="fa fa-search" aria-hidden="true"></i>
                </li>
                @if (Auth::check())
                    <li class="valign-wrapper"style="height: 64px">
                        <a class="valign dropdown-button" href="#!" data-activates="dropdown1">
                            <div class="circle center-align white-text profile-icon">
                                {!! Auth::user()->getInitials() !!}
                            </div>
                        </a>
                    </li>
                @endif
            </ul>
            <ul id="slide-out" class="side-nav">
                @if (Auth::check())
                    <li>
                        <div class="row">
                            <div class="col s12">
                                <div class="circle valign-wrapper centering outer-profile-navbar">
                                    <div class="circle valing centering inner-profile-navbar">
                                        {!! Auth::user()->getInitials() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
                <li><a href="{{ url('nutrition') }}" class="link-nutrition">NUTRICIÓN</a></li>
                <li><a href="{{ url('health') }}" class="link-health">SALUD</a></li>
                <li><a href="{{ url('personal') }}" class="link-pg">CRECIMIENTO PERSONAL</a></li>
                <li><a href="{{ url('activity') }}" class="link-activity">ACTIVIDAD FÍSICA</a></li>
            </ul>
            <a href="#" data-activates="slide-out" class="button-collapse show-on-large">
                <img class="responsive-img menu-square" src="{{ asset('img/menu.png') }}" alt="Menu">
                <span class="hide-on-small-and-down">
                    @if( ! empty($Section))
                        @if($Section == 'Salud')
                            <span class="health">{!! $Section !!}</span>
                        @elseif($Section == 'Nutrición')
                            <span class="nutrition">{!! $Section !!}</span>
                        @elseif($Section == 'Crecimiento Personal')
                            <span class="personal-grow">{!! $Section !!}</span>
                        @elseif($Section == 'Actividad Física')
                            <span class="activity">{!! $Section !!}</span>
                        @endif
                    @endif
                </span>
            </a>
        </div>
    </div>

</nav>