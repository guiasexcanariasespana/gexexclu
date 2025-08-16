@extends('adminlte::page')

@section('template_title')
    {{ $formaPago->name ?? 'Show Forma Pago' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{__('Show')}} Forma Pago</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('formapagos.index') }}"> {{__('Back')}}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $formapago->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $formapago->slug }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
