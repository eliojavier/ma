@extends('layouts.dashboard')

@section('name', 'Configurar Youtube')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col m4 s12" style="margin-top: 50px">
                <form role="form" method="POST" action="{{ url('admin/videos',['id' => $youtube->id]) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="youtube_id">Id de youtube</label>
                            <input class="validate {{ $errors->has('youtube_id') ? ' has-error' : '' }}"
                                   id="youtube_id" type="text"
                                   name="youtube_id"
                                   value="{{  !empty($youtube) ?  $youtube->youtube_id : old('youtube_id') }}">
                        @if ($errors->has('youtube_id'))
                                <span class="has-error">{{ $errors->first('youtube_id') }}</span>
                            @endif
                        </div>
                        <div class="input-field col s12">
                            <select  id="choices" name="choices">
                                <option value="channel"
                                    {{!empty($youtube) && $youtube->choices == 'channel' ? 'selected' : ''}}>
                                    channel
                                </option>
                                <option value="playlist"
                                    {{!empty($youtube) && $youtube->choices == 'playlist' ? 'selected' : ''}}>
                                    playlist
                                </option>
                                <option {{!empty($youtube) && $youtube->choices == 'user' ? 'selected' : ''}}
                                        value="user">
                                    user
                                </option>
                            </select>
                            <label class="hide">Tipo</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 center-align">
                            <button type="submit" class="btn waves-effect waves-light">
                                <i class="fa {{ !empty($icon) ? $icon : 'fa-plus' }}"></i>
                                Cambiar
                                {{--{{ $submitButtonText }}--}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col m8 s12">
                <h3 class="center-align">Configurar Youtube</h3>
                <div>
                    <p>
                        Para configurar la conexion a youtube debe de proveer el id dependiendo de la opción que elijas.
                    </p>
                    <h4>Id de playlist</h4>
                    <img class="responsive-img" src="{{asset('img/id_playlist.png')}}">
                    <h4>Id de canal</h4>
                    <img class="responsive-img" src="{{asset('img/id_channel.png')}}">
                    <h4>Id de Usuario</h4>
                    <img class="responsive-img" src="{{asset('img/id_user.png')}}">

                </div>
            </div>
        </div>
    </div>

@endsection
