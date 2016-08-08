@extends('layouts.dashboard')

@section('title', 'Biblioteca')

@section('content')
    <div class="container" style="margin-top: 70px;">
       @foreach($images->chunk(4) as $row)
           <div class="row">
               @foreach($row as $item)
                   <div class="col s4">
                       <form method="POST" action="{{url('admin/media',$item->id)}}">
                           {{ method_field('DELETE') }}
                           {{ csrf_field() }}

                           <div class="input-field col s12 center-align">
                               <button type="submit" class="btn btn-danger">
                                   <i class="fa fa-trash"></i> Borrar
                               </button>
                           </div>
                       </form>
                       <img  style="margin-top: 15px" class="responsive-img" src="/{{$item->thumbnail_path}}" alt="">
                       <code style="font-size: 10px">{{URL::to('/')."/".$item->path}}</code>
                   </div>
               @endforeach
           </div>
       @endforeach
        {{ $images->links() }}
    </div>
@endsection
