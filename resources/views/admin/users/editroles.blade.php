@extends('adminlte::page')

@section('title', 'Gmarket ADMIN PANEL')

@section('content_header')
    <div class="d-flex align-items-center">
        <a href="{{ route('admin.users.index') }}" class="btn btn-lg mr-3">
            <i class="far fa-arrow-alt-circle-left"></i> Listado
        </a>
        <h1 class="m-0">Asignar Roles</h1>
    </div>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('info') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label fw-bold">Nombre</label>
                <input type="text" class="form-control-plaintext" value="{{ $user->name }}" readonly>
            </div>

            <h2 class="h5 mb-3">Listado de Roles</h2>
            
            <form action="{{ route('admin.users.updateroles', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="list-group list-group-flush mb-4">
                    @foreach ($roles as $role)
                        <div class="list-group-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="roles[]" 
                                       value="{{ $role->id }}" 
                                       id="role_{{ $role->id }}"
                                       {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_{{ $role->id }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary px-4 py-2">
                    <i class="fas fa-save me-2"></i> Asignar Rol
                </button>
            </form>
        </div>
    </div>
@stop