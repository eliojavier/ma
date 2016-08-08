@extends('layouts.dashboard')

@section('title', 'Agregar Fotos')

@section('content')
    <div class="container-fluid">
        <p style="padding-left: 50px">
            <b>Nombre del slider:</b> {{ $slider->name }}<br/>
            <b>Tipo de Slider:</b>
            <input type="radio" id="post" value="post" v-model="picked">
            <label for="post">Artículo</label>
            <input type="radio" id="personalized" value="personalized" v-model="picked">
            <label for="personalized">Personalizado</label>
        </p>


        <div class="row" v-show="picked == 'post'">
            <h2 style="padding-left: 50px">Slider de Articulos</h2>
        </div>

        <hr>
        <div class="row" v-show="picked == 'personalized'">
                <h2 style="padding-left: 50px">Slider Personalizado</h2>
                <div class="col s12">
                    <form id="addMediaForm"
                          class="dropzone"
                          enctype="multipart/form-data" role="form"
                          method="POST"

                          action="{{ route('add_pictures_to_slider',$slider) }}">
                        {{ csrf_field() }}
                        <div class="dz-message" data-dz-message><span>Arrastre sus fotos</span></div>
                    </form>
                </div>
                <div class="col s12">
                    @foreach($slider->images->chunk(4) as $row)
                        <div class="row">
                            @foreach($row as $item)
                                <div class="col s3">
                                    <form method="POST" action="{{url('admin/media',$item->id)}}">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <div class="input-field col s12 center-align">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i> Borrar
                                            </button>
                                        </div>
                                    </form>
                                    <img style="margin-top: 15px"
                                         class="responsive-img"
                                         src="/{{$item->thumbnail_path}}"
                                         alt=""
                                    >
                                    <form method="POST" action="{{url('admin/media',$item->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}

                                        <div class="input-field col s12">
                                            <label for="caption">Descripción personalizada</label>
                                            <textarea id="caption" class="caption validate materialize-textarea {{ $errors->has('caption') ? ' has-error' : '' }}"  name="caption">{{ $item->caption}}</textarea>

                                            @if ($errors->has('caption'))
                                                <span class="has-error">{{ $errors->first('caption') }}</span>
                                            @endif
                                        </div>
                                        <div class="input-field col s12 center-align">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-plus"></i> Descripción
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

            </div>
    </div>
@endsection
@section('after-script-end')
    <script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        Dropzone.options.addMediaForm = {
            maxFilesize: 3,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp',
            init: function() {
                this.on('success', function( file, resp ){
                    console.log( file );
                    console.log( resp );
                    //location.reload();
                });
                this.on('error', function( e ){
                    console.log('erors and stuff');
                    console.log( e );
                });
                this.on("complete", function (file) {
                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                        console.log('Imagenes cargadas')
                        location.reload();
                    }
                });
            }
        }
    </script>
@endsection
