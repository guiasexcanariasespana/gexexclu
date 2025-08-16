@extends('adminlte::page')

@section('title', 'Gmarket ADMIN PANEL')
        @vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content_header')
    <header class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary mr-2">
                <i class="fas fa-arrow-left mr-1"></i> Listado
            </a>
            Editar Rol
        </h1>
    </header>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('info') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                
                @include('admin.roles.partials.form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <i class="fas fa-save mr-2"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <!-- Usando asset() con versionado para cache busting -->
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nombreInput = document.getElementById('nombre');
            const slugInput = document.getElementById('slug');

            if (nombreInput && slugInput) {
                nombreInput.addEventListener('input', function() {
                    slugInput.value = stringToSlug(this.value);
                });
            }

            function stringToSlug(str) {
                return str.toLowerCase()
                    .replace(/\s+/g, '-')           // Reemplaza espacios con -
                    .replace(/[^\w\-]+/g, '')       // Elimina caracteres no alfanuméricos
                    .replace(/\-\-+/g, '-')         // Reemplaza múltiples - con uno solo
                    .replace(/^-+/, '')             // Elimina - del inicio
                    .replace(/-+$/, '');            // Elimina - del final
            }
        });
    </script>
@endsection