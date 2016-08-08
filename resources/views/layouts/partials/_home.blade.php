@if(count($posts))
    <div class="row">
        <div class="col m6 s12">
            <div class="row">
                <article class="col s12 m12">
                    <div>
                        <a href="{{ route('posts.show',$posts[0]) }}">
                            <img class="responsive-img" src="/{{$posts[0]->media->thumbnail_path}}" alt=" {{ $posts[0]->media->display_name }}">
                        </a>
                    </div>
                    <p class="category-{{$posts[0]->category->style}}">{{$posts[0]->category->display_name}}</p>
                    <a href="{{ route('posts.show',$posts[0]) }}">
                        <h3 class="post-title left-align" style="font-size: 19pt;Padding-top:8px;Margin-top:5px;">
                            {{ $posts[0]->title }}
                        </h3>
                    </a>

                    <p class="left-align post-date"> {{ $posts[0]->published_date->toFormattedDateString() }}</p>
                </article>
            </div>
            <hr style="margin-bottom: 30px">
            <div class="row">
                @for($i = 1; $i < 3; $i++)
                    @if(!empty($posts[$i]))
                        <article class="col s12 m6 {{ $i == 1 ? 'border-article-right' : '' }}">
                            <div>
                                <a  href="{{ route('posts.show',$posts[$i]) }}">
                                    <img class="responsive-img" src="/{{$posts[$i]->media->thumbnail_path}}" alt=" {{ $posts[$i]->media->display_name }}">
                                </a>
                            </div>
                            <p class="category-{{$posts[$i]->category->style}}">{{$posts[$i]->category->display_name}}</p>
                            <a  href="{{ route('posts.show',$posts[$i]) }}">
                                <h3 class="post-title left-align">
                                    {{ $posts[$i]->title }}
                                </h3>
                            </a>
                            <p class="left-align  post-date"> {{ $posts[$i]->published_date->toFormattedDateString() }}</p>

                        </article>
                    @endif
                @endfor
            </div>
        </div>
        <div class="col s12 m6 border-article-left">
            <h2 class="center-align home-title" style="margin-top:0;">Los Más leídos</h2>
            @if(!empty($moreViews))
                @for($i = 0; $i < 4; $i++)
                    @if(!empty($moreViews[$i]))
                        <div class="row">
                            <div class="photo-{{$moreViews[$i]->category->style}} col m5 no-padding fix-border-top" style="margin: 0  0 0 0.75rem">
                                <a  href="{{ route('posts.show',$moreViews[$i]) }}">

                                <img class="responsive-img" src="/{{$moreViews[$i]->media->thumbnail_path}}" alt=" {{ $moreViews[$i]->media->display_name }}">
                                </a>
                            </div>
                            <article id="more-reads" class="texto col m6 no-padding">
                                <p class="category-{{$moreViews[$i]->category->style}}">{{$moreViews[$i]->category->display_name}}</p>
                                <a  href="{{ route('posts.show',$moreViews[$i]) }}">
                                    <h3 class="flow-text post-title tit-ultimo" style="font-size: 16px">
                                        {{ $moreViews[$i]->title }}
                                    </h3>
                                </a>
                                <p class="left-align  post-date date"> {{ $moreViews[$i]->published_date->toFormattedDateString() }}</p>

                            </article>
                        </div>
                        <div class="row">
                            {!!  $i != 3 ? '<hr style="margin-bottom:10px;margin-left:15px" >' : '' !!}

                        </div>

                    @endif
                @endfor
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col s12" style="margin-top: 35px; margin-bottom: 35px">
            <h2 class="home-title">Video</h2>
            {{--<div class="col l2 hide-on-med-and-down" style="padding-right: 0">--}}
                {{--<img class="img-responsive"  src="{{ asset('img/video.png')}}" alt="Video" >--}}
            {{--</div>--}}
            <div class="col s12 m12 l12" style="padding-left: 0">
                <div id="playlist"></div>
            </div>
        </div>

    </div>
    <hr>
    <div class="row">
        <h2 class=" center-align home-title">Favoritos</h2>
        <div class="row">
            @if(!empty($topRated))
                @for($i = 0; $i < 3; $i++)
                    @if(!empty($topRated[$i]))
                        <article class="col s12 m4 center-align {{ $i ==1? 'border-article' : '' }}">
                            <p class="category-{{$topRated[$i]['post']->category->style}}">{{$topRated[$i]['post']->category->display_name}}</p>
                            <a  href="{{ route('posts.show',$topRated[$i]['post']) }}">
                                <h3 class="flow-text post-title" style="text-transform: uppercase">
                                    {{ $topRated[$i]['post']->title }}
                                </h3>
                            </a>
                        </article>
                    @endif

                @endfor
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col s12 m5 border-article-right">
            <h2 class="center-align more-reads-title truncate fix-collaborator-title">COLABORADORES</h2>

            @for($i = 0; $i < 3; $i++)
                @if(!empty($collaborators[$i]))
                    <div class="row">
                        <div class="photo-{{$collaborators[$i]->category->style}} col m4 s4 no-padding fix-border-top">
                            <div class="blue centering center-align collaborator" style="width:100%;max-width: 100px;height: 100px;float: left;margin-bottom: 5px" >
                                {{$collaborators[$i]->getProfileDisplay()}}
                            </div>
                        </div>
                        <div id="more" class="col m6 s6 no-padding">
                            <p class="category-{{$collaborators[$i]->category->style}}">{{$collaborators[$i]->category->display_name}}</p>
                            <div style="clear: both"></div>
                            <h3 class="flow-text name-bold" style="margin-bottom: 0;margin-left: 10px">{{$collaborators[$i]->complete_name}}</h3>

                            <a href="{{route('collaborators.show',$collaborators[$i])}}">
                                <span class="left-align open-sans" style="font-size: 8pt;margin-left: 10px">VER PERFIL >></span>
                            </a>

                        </div>
                    </div>
                <div class="row" style="padding-right: 15px">
                    {!!  $i != 2 ? '<hr>' : '' !!}
                </div>

                @endif
            @endfor

            <div class="row center-align">
                <div class="col s12">
                    <a href="{{url('collaborators')}}"  class="waves-effect waves-light btn fix-button-collaborators" style="font-size: 8pt;box-shadow: none;border: solid 1px #989898; background-color: transparent;color: #646464">
                    <span>
                    CONOCE A TODOS NUESTROS COLABORADORES

                    </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col s12 m7">
            <div style="margin-top: 78px">
                @for($i = 3; $i < 5; $i++)
                    @if(!empty($posts[$i]))
                        <div class="row">
                            <div class="photo-{{$posts[$i]->category->style}} col m5 s6 offset-m1 no-padding">
                                <a  href="{{ route('posts.show',$posts[$i]) }}">
                                    <img class="responsive-img" src="/{{$posts[$i]->media->thumbnail_path}}" alt=" {{ $posts[$i]->media->display_name }}">
                                </a>
                            </div>
                            <article id="more" class="texto col m6 s6 no-padding">
                                <p class="category-{{$posts[$i]->category->style}}">{{$posts[$i]->category->display_name}}</p>
                                <a  href="{{ route('posts.show',$posts[$i]) }}">
                                    <h3 class="flow-text post-title tit-ultimo text-padding-responsive" style="text-transform: uppercase">
                                        {{ $posts[$i]->title }}
                                    </h3>
                                </a>
                                <p class="left-align post-date date text-padding-responsive"> {{ $posts[$i]->published_date->toFormattedDateString() }}</p>
                            </article>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>
@endif