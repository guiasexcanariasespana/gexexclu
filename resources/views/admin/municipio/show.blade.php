@extends('adminlte::page')

@section('template_title')
    {{ $municipio->name ?? 'Show Municipio' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Municipio</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('municipios.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $municipio->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $municipio->slug }}
                        </div>
                        <div class="form-group">
                            <strong>Provincia:</strong>
                            {{ $municipio->provincia ? $municipio->provincia->nombre : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>texto SEO:</strong>
                            {!! $municipio->texto_seo !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
