@extends('layouts.dashboard')

@section('title', 'Subir Archivos')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Archivos de imagen</span>
                        <form id="addMediaForm" class="dropzone" enctype="multipart/form-data" role="form" method="POST" action="{{ url('admin/media') }}">
                            {{ csrf_field() }}
                            <div class="dz-message" data-dz-message><span>Arrastre sus fotos</span></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-script-end')

    <script>
        Dropzone.options.addMediaForm = {
            maxFilesize: 3,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp',
            init: function() {
                this.on('success', function( file, resp ){
                    console.log( file );
                    console.log( resp );
                });
                this.on('error', function( e ){
                    console.log('erors and stuff');
                    console.log( e );
                });
            }
        }
    </script>
@endsection