@extends('layouts.dashboard')

@section('name', 'Sliders')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col s4 ">
                <h3>Crear Slider</h3>
                <form enctype="multipart/form-data" role="form" method="POST" action="{{ url('admin/slider') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="name">Nombre</label>
                            <input class="validate {{ $errors->has('name') ? ' has-error' : '' }}"
                                   id="name" type="text"
                                   name="name"
                                   value="{{  !empty($post) ?  $post->name : old('name') }}">
                            @if ($errors->has('name'))
                                <span class="has-error">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="input-field col s12">
                            <select  id="category" name="category"><option value="" disabled selected>Categorías</option>
                                @foreach($categories as $category)
                                    <option {{ !empty($post) && $category->id == $post->category_id ? 'selected' : '' }} value="{{$category->id}}">{{$category->display_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category'))
                                <span class="has-error">{{ $errors->first('category') }}</span>
                            @endif
                            <label class="hide">Categoría</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 center-align">
                            <button type="submit" class="btn waves-effect waves-light">
                                <i class="fa {{ !empty($icon) ? $icon : 'fa-plus' }}"></i>
                                Crear
                                {{--{{ $submitButtonText }}--}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col s8">

                <table class="striped">
                    <thead>
                    <tr>
                        <th data-field="title">Nombre</th>
                        <th>Agregar Slides</th>
                        <th>Categoría</th>
                        <th>Borrar</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($sliders as $slider)
                        <tr>
                            <td>
                                {{ $slider->name }}
                            </td>
                            <td>
                                <a href="{{ route('admin.slider.show', $slider) }}">
                                    {{ "Agregar Slides "}}
                                </a>
                            </td>
                            <td>
                                {{ count($slider->category) ? $slider->category->display_name : ''}}
                            </td>
                            <td>
                                <form action="{{ url('admin/slider',$slider) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Borrar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $sliders->links() }}
            </div>
        </div>
    </div>

@endsection
