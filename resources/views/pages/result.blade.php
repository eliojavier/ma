@extends('layouts.app')

@section('title', 'Resultado')

@section('nav')
    @include('layouts.partials._nav',['modal' => 'true'])
@endsection

@section('content')
    <div class="container" style="border:1px solid black">

    </div>
    <div class="container" style="margin-top: 35px">
        @if($posts->count())
            @include('layouts.partials._posts',['posts' => $posts])
        @else
            <h1 class="left-align">No se encontraron resultados.</h1>
        @endif
        {{ $posts->appends(Input::except('page'))->links() }}
    </div>

@endsection

@section('footer')
    @include('layouts.partials._footer',['footerClass' => 'footer'])
@endsection


