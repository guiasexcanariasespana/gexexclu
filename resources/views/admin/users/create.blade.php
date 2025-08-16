@extends('adminlte::page')

@section('title', 'Gmarket ADMIN PANEL')

@section('content_header')
    <h1><a href="{{ route('admin.users.index') }}" class=" btn btn-lg mr-1">
        <i class="far fa-arrow-alt-circle-left"></i> Listado </a>   Alta de Usuario</h1>
@stop



@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    
 
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.users.store']) !!}
                
            @include('admin.users.formuser')
           
            {!! Form::close() !!}
        </div>
    </div>
@stop

