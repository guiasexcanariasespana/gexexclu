@extends('adminlte::page')

@section('template_title')
    {{ $provincia->name ?? 'Show Provincia' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{__('Show')}} Provincia</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('provincias.index') }}"> {{__('Back')}}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $provincia->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $provincia->slug }}
                        </div>
                        {{-- <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $provincia->state ?  $provincia->state->name : 'N/D' }}
                        </div> --}}
                         <div class="form-group">
                            <strong>texto SEO:</strong>
                            {!! $provincia->texto_seo !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
