@extends('adminlte::page')


@section('template_title')
    {{__('Show')}} SMS Notificaciones
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{__('Show')}} SMS Notificaciones</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('smsnotifications.index') }}"> {{__('Back')}}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Usuario:</strong>
                            @if(is_null($smsnotification->user_id))
                                  'N/D'
                            @else
                                 ({{ $smsnotification->user_id }}) -  {{ $smsnotification->user->name }}
                            @endif

                        </div>                       
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $smsnotification->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Mensaje:</strong>
                            {{ $smsnotification->mensaje }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $smsnotification->respuesta }}
                        </div>
                        <div class="form-group">
                            <strong>Sms Id:</strong>
                            {{ $smsnotification->sms_id }}
                        </div>
                        <div class="form-group">
                            <strong>Error Id:</strong>
                            {{ $smsnotification->error_id }}
                        </div>
                        <div class="form-group">
                            <strong>Error Msg:</strong>
                            {{ $smsnotification->error_msg }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
