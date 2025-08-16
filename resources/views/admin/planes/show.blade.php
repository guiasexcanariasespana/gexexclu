@extends('adminlte::page')

@section('template_title')
    {{ $plane->name ?? 'Show Plane' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title"> {{ __('Show') }} {{ __('Plane') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('planes.index') }}"> {{ __('Back') }} </a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $plane->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $plane->slug }}
                        </div>
                        <div class="form-group">
                            <strong>Dias:</strong>
                            {{ $plane->dias }}
                        </div>
                         <div class="form-group">
                            <strong>Clase:</strong>
                            {{ $plane->clase->nombre}}
                             {{ is_null($plane->clase) ? 'N/D' : $plane->clase->nombre}}
                        </div>
                        <div class="form-group">
                            <strong>Categoría:</strong>
                            {{ is_null($plane->categoria) ? 'N/D' : $plane->categoria->nombre}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
