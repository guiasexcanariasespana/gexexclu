@extends('adminlte::page')

@section('title', 'Gmarket ADMIN PANEL')

@section('content_header')
    <h1><a href="{{ route('admin.users.index') }}" class=" btn btn-lg mr-1">
        <i class="far fa-arrow-alt-circle-left"></i> Listado </a> Asignar Roles</h1>
@stop



@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif


    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <p class="h5">Nombre</p>
                <p class="form-control">{{ $user->name }}</p>
            </div>
            <h2 class="h5">Listado de Roles</h2>
            {!! Form::model($user, ['route' => ['admin.users.updateroles', $user], 'method' => 'put']) !!}

                @foreach ($roles as $role)
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, null, ['class'=>'mr-1']) !!}
                            {{ $role->name}}
                        </label>
                    </div>
                @endforeach

            
            {!! Form::submit('Asignar Rol', ['class' => 'btn btn-primary mt-2']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

