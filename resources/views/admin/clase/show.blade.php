@extends('adminlte::page')

@section('template_title')
    {{ $clase->name ?? 'Show Clase' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title"> {{ __('Show') }} {{ __('Clase') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('clases.index') }}">{{ __('Back') }} </a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $clase->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $clase->slug }}
                        </div>
                         <div class="form-group">
                            <strong>Color:</strong>
                            {{ $clase->color }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
