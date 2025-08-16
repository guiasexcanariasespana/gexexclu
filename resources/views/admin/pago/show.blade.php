@extends('adminlte::page')

@section('template_title')
    {{ $pago->name ?? 'Show Pago' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{__('Show')}} Pago</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('pagos.index') }}"> {{__('Back')}}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Usuario:</strong>
                             @if(is_null($pago->user))
                                                    'N/D'
                                                @else
                                                    ({{ $pago->user_id }}) - {{ $pago->user->name }}
                                                @endif
                        </div>
                        <div class="form-group">
                            <strong>Mail Pago:</strong>
                            {{ $pago->mail_pago }}
                        </div>
                        <div class="form-group">
                            <strong>Anuncio Id:</strong>
                            {{ $pago->anuncio_id }}
                        </div>
                        <div class="form-group">
                            <strong>Moneda Precio:</strong>
                            {{ $pago->moneda_precio }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $pago->precio }}
                        </div>
                        <div class="form-group">
                            <strong>Moneda Pago:</strong>
                            {{ $pago->moneda_pago }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Pago:</strong>
                            {{ $pago->monto_pago }}
                        </div>
                        <div class="form-group">
                            <strong>Fee:</strong>
                            {{ $pago->fee }}
                        </div>
                        <div class="form-group">
                            <strong>Medio Pago:</strong>
                            {{ $pago->medio_pago }}
                        </div>
                        <div class="form-group">
                            <strong>Nro Transac:</strong>
                            {{ $pago->nro_transac }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Transac:</strong>
                            {{ $pago->fecha_transac }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $pago->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
