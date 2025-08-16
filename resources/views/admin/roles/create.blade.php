@extends('adminlte::page')

@section('title', 'Gmarket ADMIN PANEL')

@section('content_header')
    <h1> <a href="{{ route('admin.roles.index') }}" class=" btn btn-lg mr-1">
        <i class="far fa-arrow-alt-circle-left"></i> Listado </a> Crear Nuevo Rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.roles.store']) !!}

             @include('admin.roles.partials.form')   
            
            {!! Form::submit('Crear Rol', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
   <script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>

   <script>  
    $(document).ready( function() {
        $("#nombre").stringToSlug({
        setEvents: 'keyup keydown blur',
        getPut: '#slug',
        space: '-'
        });
    });
    </script>
@endsection