@extends('layouts.app')

@section('title', 'Home')

@section('nav')
    @include('layouts.partials._nav',['modal' => 'true'])
@endsection

@section('content')
    <div class="container" style="margin-top: 40px">
        <div class="row">
            <div class="col s12">
                <h1 class="center-align home-title">Colaboradores</h1>

                <div class="row">
                    @foreach( array_chunk($alphabet,9) as $set)
                        <div class="col m3 offset-m1 s5 offset-s1">
                            @foreach($set as $letter)
                                <p class="letter ">{{$letter}}</p>
                                @if(isset($collaborators[$letter]))
                                    @foreach($collaborators[$letter] as $collaborator)
                                        <a href="{{route('collaborators.show', $collaborator)}}" style="color:#565656">
                                            <p class="name">
                                                {{ $collaborator['complete_name'] }}
                                            </p>
                                        </a>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.partials._footer',['footerClass' => 'footer'])
@endsection

