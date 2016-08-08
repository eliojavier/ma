<div class="navbar-fixed">
    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content" >
        <li><a href="{{ url('profile') }}">Perfil</a></li>
        <li class="divider"></li>
        <li><a href="{{ url('/logout') }}">Salir</a></li>
    </ul>
    <nav id="menu" role="navigation" class="bar remove-box-shadow">
        <div class="container">
            <div class="nav-wrapper center-align" role="navigation">
                <a id="logo" href="{{ url('/') }}" class="brand-logo center">
                    <img class="responsive-img" src="{{ asset('img/nav/Motivapp.png') }}" alt="Motivapp">
                </a>

                @if(Auth::guest())
                    @if(! empty($modal))
                    <a class="button-collapse modal-trigger" href="#login-modal" style="float: right">
                        <div class="valign-wrapper login-icon-container">
                            <img class="valign responsive-img" src="{{ asset('img/nav/LoginIcon.png') }}" alt="Login">
                        </div>
                    </a>
                    @else
                        <a class="button-collapse" href="{{ url('/login') }}" style="float: right">
                            <div class="valign-wrapper login-icon-container">
                                <img class="valign responsive-img" src="{{ asset('img/nav/LoginIcon.png') }}" alt="Login">
                            </div>
                        </a>
                    @endif
                @endif
                <span id="section-article-title"></span>

                <ul class="right hide-on-med-and-down">
                    <li>
                        <form action="{{ url('search') }}" method="GET" class="right-align">
                            <div class="input-field">
                                <input id="search" name="q" type="search" placeholder="Buscar..." style=" padding: 0;display: inline-block;width: 50%">

                                <button type="button" id="bsearch" style="background: transparent;display: inline;border: none;padding: 0;margin-top: 0;">
                                    <i class="material-icons" style="color:#646464;font-size: 20px;">search</i>
                                </button>
                            </div>
                        </form>
                    </li>
                    @if (Auth::check())
                        <li class="valign-wrapper" style="height: 64px">
                            <a class="valign dropdown-button no-hover" href="#!" data-activates="dropdown1">
                                <div class="circle center-align white-text nav-profile-icon">
                                    {!!  Auth::user()->getProfileDisplay() !!}
                                </div>
                            </a>
                        </li>
                    @else
                        @if(! empty($modal))
                            <li><a class="waves-effect waves-light btn modal-trigger" href="#login-modal" style="margin-right: 0">Ingresa</a></li>
                        @else
                            <li><a class="waves-effect waves-light btn modal-trigger" href="{{ url('/login') }}" style="margin-right: 0">Ingresa</a></li>
                        @endif
                    @endif
                </ul>

                <ul id="slide-out" class="side-nav">
                    @if (Auth::check())
                        <li>
                            <div class="row">
                                <div class="col s12">
                                    <a href="{{ url('profile') }}" class="no-hover" style="height: auto">
                                        <div class="circle valign-wrapper centering outer-profile-navbar">
                                            <div class="circle valing centering inner-profile-navbar">
                                                {!! Auth::user()->getProfileDisplay() !!}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endif
                    @foreach($links as $link)
                        <li id="sections">
                            <a href="{{ url('pages',$link->slug) }}" class="text-{{ $link->style . " " . ($link->display_name == 'Crecimiento Personal'? 'fix-hover-two-lines': '') }}">

                                {!! mb_strtoupper($link->display_name) !!}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <a href="#" data-activates="slide-out" class="button-collapse show-on-large">
                    <img class="responsive-img icon-position" src="{{ asset('img/nav/Nav.png') }}" alt="Menu">
                    @if(! empty($title) && !empty($titleStyle))
                        <span class="hide-on-small-and-down title-{{ $titleStyle }}">
                            {{  $title }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </nav>
</div>

<div class="container" id="posts">


</div>

@section('after-script-end')
    <script>
        $(document).ready(function () {
            $('#search').keydown(function () {
                $.ajax({
                    url:'search',
                    type: 'GET',
                    data: {val: $('#search').val()},
                    success: function (result) {
                        console.log(result);
                        console.log(result.posts);
                        console.log(result.tags);

                        $.each(result.posts.data, function(key, value){
                            console.log(value.media.thumbnail_path);
                            console.log(value.media.display_name);
                            console.log(value.category.style);
                            console.log(value.category.display_name);
                            console.log(value.title);
                            console.log(value.published_date);

                            var slug = value.slug;
                            var thumbnail_path = value.media.thumbnail_path;
                            var m_display_name = value.media.display_name;
                            var category_style = value.category.style;
                            var c_display_name = value.category.display_name;
                            var title = value.title;
                            var published_date = value.published_date.date.toString();

                            $('#posts').append('<article class="col s12 m4">' +
                                                    '<div>' +
                                                        '<a href="/posts/' + slug + '">' +
                                                            '<img class="responsive-img" src="/' + thumbnail_path + '" alt="' + m_display_name +'">' +
                                                        '</a>' +
                                                    '</div>' +
                                                    '<p class="category-' + category_style + '">' + c_display_name + '</p>' +
                                                '<a href="/posts/' + slug + '">' +
                                                    '<h3 class="post-title left-align">' + title + '</h3>' +
                                                '</a>' +
                                                '<p class="left-align  post-date">' + published_date + '</p>' +
                                                '</article>');

                            {{--<article class="col s12 m4">--}}
                                    {{--<div>--}}
                                    {{--<a  href="{{ route('posts.show',$post) }}">--}}
                                    {{--<img class="responsive-img" src="/{{$post->media->thumbnail_path}}" alt=" {{ $post->media->display_name }}">--}}
                                    {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<p class="category-{{$post->category->style}}">{{$post->category->display_name}}</p>--}}
                                    {{--<a  href="{{ route('posts.show',$post) }}">--}}
                                    {{--<h3 class="post-title left-align">--}}
                                    {{--{{ $post->title }}--}}
                                    {{--</h3>--}}
                                    {{--</a>--}}
                                    {{--<p class="left-align  post-date"> {{ $post->published_date->toFormattedDateString() }}</p>--}}
                                    {{--</article>--}}








                        });
                    }
                });
            });
        });
    </script>
@endsection
