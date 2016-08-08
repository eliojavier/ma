@extends('layouts.app')

@section('title', 'Términos y condiciones ')

@section('nav')
    @include('layouts.partials._nav',[
    'modal' => 'true'
    ])
@endsection

@section('content')
<div class="container" style="margin-top: 35px">
    <div class="row">
        <div class="col s12">
            <h1 class="center-align home-title text-motivapp-blue">Privacidad</h1>

        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('layouts.partials._footer',['footerClass' => 'footer'])
@endsection
