@extends('layouts.app')

@section('head')
        <meta property="og:type"   content="article" />
        <meta property="og:url"    content="{{ route('posts.show',$post) }}" />
        <meta property="og:title"  content="{{ $post->title }}" />
        <meta property="og:image"  content="{{ URL::to('/')."/".$post->media->path}}" />
@endsection

@section('title', 'Home')

@section('nav')
    @include('layouts.partials._nav',['modal' => 'true'])
@endsection

@section('content')
    <div class="container" style="margin-top: 20px">
        <div class="row">
            <div class="col s12">
                <div class="article-title">
                    <h1>
                        {{ $post->title }}
                    </h1>
                    <br>
                    <p>
                        Por <span>{{ $post->author }}</span> {{ $post->published_date->toFormattedDateString()}}
                    </p>
                </div>  

                @if(!empty($post->slider))
                    @include('layouts.partials._slider',[ 'slider' => $post->slider ])
                @else
                    <img class="responsive-img" style="margin: 0 auto;width: 100%" src="/{{ $post->media->path}}" >
                @endif

                <div style="position: relative; height: 70px;bottom: 65px;z-index: 100" >
                    <div id="share-google" class="fixed-action-btn horizontal click-to-toggle" style="position: absolute; right: 24px;">
                        <a class="btn-floating btn-large bg-motivapp-green">
                            <i class="material-icons" style="font-size: 2.2em">add</i>
                        </a>
                        <ul>
                            <li>
                                <a  href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show',$post) }}"
                                   class="share btn-floating bg-motivapp-green share-btn"
                                   target="_blank">
                                    <i class="icon-share-face"></i>
                                </a>
                            </li>
                            <li>
                                <a  href="http://twitter.com/share?text={{ $post->title }}&url={{ route('posts.show',$post) }}"
                                    class="share btn-floating bg-motivapp-green share-btn"
                                    target="_blank">
                                    <i class="icon-share-twi"></i>
                                </a>
                            </li>
                            <li>
                                <a  href="http://pinterest.com/pin/create/button/?url={{ urlencode(route('posts.show',$post)) }}&media={{  urlencode(URL::to('/')."/".$post->media->path)}}"
                                    class="share btn-floating bg-motivapp-green share-btn"
                                    target="_blank">
                                    <i class="icon-share-pin"></i>
                                </a>
                            </li>
                            <li>
                                <a  href="whatsapp://send?text={{ route('posts.show',$post) }}" data-action="share/whatsapp/share"
                                   class="share btn-floating bg-motivapp-green share-btn">
                                    <i class="icon-share-what"></i>
                                </a>
                            </li>
                            <li>
                                <a  href="mailto:someone@motivapp.com?subject=Articulo {{ $post->title }}&body={{ route('posts.show',$post) }}"
                                   class="share btn-floating bg-motivapp-green share-btn">
                                    <i class="icon-share-mail"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col m4 hide-on-small-and-down">
                <div class="row">
                <hr>
                </div>
                @for($i = 0; $i < 2; $i++)
                    @if(!empty($relatedPosts[$i]))
                        <div class="row">
                            <div class="photo-{{$relatedPosts[$i]->category->style}} col m5 no-padding fix-border-top-show">
                                <a  href="{{ route('posts.show',$relatedPosts[$i]) }}">
                                    <img class="responsive-img" src="/{{$relatedPosts[$i]->media->thumbnail_path}}" alt=" {{ $relatedPosts[$i]->media->display_name }}">
                                </a>
                            </div>
                            <article  class="col m7 no-padding article-fix">
                                <p style="text-indent: 10px" class="category-{{$relatedPosts[$i]->category->style}} fix-indent-show">{{$relatedPosts[$i]->category->display_name}}</p>
                                <a  href="{{ route('posts.show',$relatedPosts[$i]) }}">
                                    <h3 class="flow-text post-title tit-ultimo fix-padding-show" style="font-size: 16px">
                                        {{ $relatedPosts[$i]->title }}
                                    </h3>
                                </a>
                                <p class="left-align post-date date fix-padding-show"> {{ $relatedPosts[$i]->published_date->toFormattedDateString() }}</p>

                            </article>
                        </div>
                        <div class="row">
                            <hr>
                        </div>
                    @endif
                @endfor
            </div>
            <div class="col m8 s12">
                <div class="row">
                    <div class="col s12 post-content">
                        {!! html_entity_decode($post->body) !!}
                    </div>
                </div>
                @if(Auth::check())

                        <h2 style="font-size: 18pt">¿Qué te pareció el artículo anterior?</h2>

                        <div class="row row-border-rating">
                            <div class="col s12 col-border-rating" >
                                <div class="col s4 m2 center-align share-article">
                                    <span class="icon-motivador rating-icon"></span>
                                    <p>Motivador</p>
                                    <button data-type="motivador" class="rating-counter">{{ count($post->like()->first())? $post->like()->first()->motivador : 0 }}</button>
                                </div>

                                <div class="col s4 m2 center-align share-article">
                                    <span class="icon-interesante rating-icon"></span>
                                    <p>Interesante</p>
                                    <button data-type="interesante" class="rating-counter">{{ count($post->like()->first())? $post->like()->first()->interesante : 0 }}</button>
                                </div>

                                <div class="col s4 m2 center-align share-article">
                                    <span class="icon-satisfactorio rating-icon"></span>
                                    <p>Satisfactorio</p>
                                    <button data-type="satisfactorio" class="rating-counter">{{ count($post->like()->first())? $post->like()->first()->satisfactorio : 0 }}</button>
                                </div>
                                <div class="col s4 m2 center-align share-article">
                                    <span class="icon-informativo rating-icon"></span>
                                    <p>Informativo</p>
                                    <button data-type="informativo" class="rating-counter">{{ count($post->like()->first())? $post->like()->first()->informativo : 0 }}</button>
                                </div>
                                <div class="col s4 m2 center-align share-article">
                                    <span class="icon-soso rating-icon"></span>
                                    <p>Soso</p>
                                    <button data-type="soso" class="rating-counter">{{ count($post->like()->first())? $post->like()->first()->soso : 0 }}</button>
                                </div>

                                <div class="col s4 m2 center-align share-article">
                                    <span class="icon-aburrido rating-icon"></span>
                                    <p>Aburrido</p>
                                    <button data-type="aburrido" class="rating-counter">{{ count($post->like()->first())? $post->like()->first()->aburrido : 0 }}</button>
                                </div>
                            </div>
                            <div class="col s12" >
                                <ul class="list-inline rating-share-icon-list valign-wrapper">
                                    <li class="valign">
                                        <h2>COMPARTE<br/>ESTE ARTICULO</h2>
                                    </li>
                                    <li style="margin-top: 5px">
                                        <a class="share" target="_blank"  href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show',$post) }}">
                                            <i class="icon-share-face"></i>
                                        </a>
                                    </li>
                                    <li style="margin-top: 5px">
                                        <a class="share" target="_blank"  href="http://twitter.com/share?text={{ $post->title }}&url={{ route('posts.show',$post) }}">
                                            <i class="icon-share-twi"></i>
                                        </a>
                                    </li>
                                    <li style="margin-top: 5px">
                                        <a class="share" target="_blank"  href="http://pinterest.com/pin/create/button/?url={{ urlencode(route('posts.show',$post)) }}&media={{  urlencode(URL::to('/')."/".$post->media->path)}}">
                                            <i class="icon-share-pin"></i>
                                        </a>
                                    </li>
                                    <li style="margin-top: 5px">
                                        <a class="share" target="_blank"  href="whatsapp://send?text={{ route('posts.show',$post) }}" data-action="share/whatsapp/share">
                                            <i class="icon-share-what"></i>
                                        </a>
                                    </li>
                                    <li style="margin-top: 5px">
                                        <a class="share" target="_blank"  href="mailto:someone@motivapp.com?subject=Articulo {{ $post->title }}&body={{ route('posts.show',$post) }}">
                                            <i class="icon-share-mail"></i>
                                        </a>
                                    </li>
                                    <li class="valign">
                                        <h2 id="share-counter" class="center-align" style="padding-left: 20px">
                                            <span style="font-size: 1.2rem">
                                            {{ $post->share_counter }}
                                            </span>
                                            <br>
                                            COMPARTIDO
                                        </h2>
                                    </li>
                                </ul>
                            </div>
                        </div>

                @endif
            </div>
        </div>

        <div class="row">
            <div class="col m8 s12 offset-m4">
                <h3 style="font-size: 16pt;text-transform: uppercase">otros artículos relacionados</h3>

                @for($i = 2; $i < 4; $i++)
                    @if(!empty($relatedPosts[$i]))

                        <article class="col s6 order-article-right">
                        <a  href="{{ route('posts.show',$relatedPosts[$i]) }}">
                            <img class="responsive-img" src="/{{$relatedPosts[$i]->media->thumbnail_path}}" alt=" {{ $relatedPosts[$i]->media->display_name }}">
                        </a>
                        <p class="category-{{$relatedPosts[$i]->category->style}}">{{$relatedPosts[$i]->category->display_name}}</p>
                        <a  href="{{ route('posts.show',$relatedPosts[$i]) }}">
                            <h3 class="flow-text post-title">
                                {{ $relatedPosts[$i]->title }}
                            </h3>
                        </a>
                        <p class="left-align post-date"> {{ $relatedPosts[$i]->published_date->toFormattedDateString() }}</p>
                    </article>
                    @endif
                @endfor
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.partials._footer',['footerClass' => 'footer'])
@endsection


@section('after-script-end')
    <script>
        var title ='<p class="scroll-title"><span>Estas leyendo: </span>{{ $post->title }}</p>';
        $(document).scroll(function() {
            var y = $(this).scrollTop();
            if (y > 100) {
                $('#logo').css('left','110px');
                $('#logo img').css('height','30px');
                $('#section-article-title').html(title);
            } else {
                $('#logo').css('left','50%');
                $('#logo img').css('height','auto');
                $('#section-article-title').html('');
            }
        });

        $.ajaxSetup(
                {
                    headers:
                    {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    }
                });
        $(document).ready(function(){

            var count = parseInt($('#share-counter').text());

            $('a.share').click(function(e) {
                e.preventDefault();
                var href = $(this).attr('href');
                count = count + 1;
                $.ajax({
                    url: "{{ route('count.shares') }}",
                    type: "POST",
                    data:{id: "{{$post->id}}", count: count},
                    success: function(data){
                    console.log(data);
                        $('#share-counter').text(count)
//                        window.location.href = href;
                        window.open(
                                href,
                                '_blank' // <- This is what makes it open in a new window.
                        );


                    }
                });
            });


            $('.rating-counter').click(function(){
                var $this = $(this);
                var countLikes = parseInt($this.text());
                countLikes = countLikes + 1;
                var type = $(this).data("type");
                $.ajax({
                    url: "{{ route('count.likes') }}",
                    type: "POST",
                    data:{id: "{{$post->id}}", count: countLikes, type:type},
                    success: function(data){
                        console.log(data);
                        $this.text(countLikes);
                    }
                });
            });
        });

    </script>
@endsection
