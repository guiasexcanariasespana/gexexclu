@extends('adminlte::page')

@section('template_title')
    {{ $anuncio->name ?? 'Gest. Imágenes' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Registrar Pago</span>
                        </div>
                        <div class="float-right">

                            <a class="btn btn-primary" href="{{ route('admin.anuncios.show', $anuncio) }}">
                                {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <strong>Usuario:</strong>
                            {{ $anuncio->user ? '(' . $anuncio->user->id . ') ' . $anuncio->user->name : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $anuncio->nombre }}
                        </div>

                        <form method="POST" action="{{ route('admin.anuncios.store_pago', $anuncio) }}" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            
                            {{ Form::hidden('user_id', $pago->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}

                            {{ Form::label('mail_pago') }}
                            {{ Form::text('mail_pago', $pago->mail_pago, ['class' => 'form-control' . ($errors->has('mail_pago') ? ' is-invalid' : ''), 'placeholder' => 'Mail Pago']) }}

                           
                            {{ Form::hidden('anuncio_id', $pago->anuncio_id, ['class' => 'form-control' . ($errors->has('anuncio_id') ? ' is-invalid' : ''), 'placeholder' => 'Anuncio Id']) }}

                            {{ Form::label('moneda_precio') }}
                            {{ Form::text('moneda_precio', 'EUR', ['class' => 'form-control' . ($errors->has('moneda_precio') ? ' is-invalid' : ''), 'placeholder' => 'Moneda Precio']) }}

                            {{ Form::label('precio') }}
                            {{ Form::text('precio', $pago->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}

                            <div class="form-group">
                                {{ Form::label('moneda_pago') }}
                                {{ Form::text('moneda_pago', $pago->moneda_pago, ['class' => 'form-control' . ($errors->has('moneda_pago') ? ' is-invalid' : ''), 'placeholder' => 'Moneda Pago']) }}
                                {!! $errors->first('moneda_pago', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('monto_pago') }}
                                {{ Form::text('monto_pago', $pago->monto_pago, ['class' => 'form-control' . ($errors->has('monto_pago') ? ' is-invalid' : ''), 'placeholder' => 'Monto Pago']) }}
                                {!! $errors->first('monto_pago', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('medio_pago') }}
                                {{ Form::text('medio_pago', $pago->medio_pago, ['class' => 'form-control' . ($errors->has('medio_pago') ? ' is-invalid' : ''), 'placeholder' => 'Medio Pago']) }}
                                {!! $errors->first('medio_pago', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('nro_transac') }}
                                {{ Form::text('nro_transac', $pago->nro_transac, ['class' => 'form-control' . ($errors->has('nro_transac') ? ' is-invalid' : ''), 'placeholder' => 'Nro Transac']) }}
                                {!! $errors->first('nro_transac', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('fecha_transac') }}
                                {{ Form::date('fecha_transac', $pago->fecha_transac, ['class' => 'form-control' . ($errors->has('fecha_transac') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Transaccion']) }}
                                {!! $errors->first('fecha_transac', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            
                            <div class="form-group">
                                <p class="font-weight-bold">Estado</p>
                                <label class="mr-2">
                                    {!! Form::radio('estado', 'Aprobado', $anuncio->estado == '' ? true : $anuncio->estado == 'Aprobado') !!}
                                    Aprobado
                                </label>
                                <label class="mr-2">
                                    {!! Form::radio('estado', 'Rechazado', $anuncio->estado == 'Rechazado') !!}
                                    Rechazado
                                </label>
                                @error('estado')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="box-footer mt20">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>


        <script>
            document.getElementById("videoUpload")
                .onchange = function(event) {
                    let file = event.target.files[0];
                    let blobURL = URL.createObjectURL(file);
                    document.querySelector("video").src = blobURL;
                }
        </script>
        <script>
            function limpiar() {
                var $img = $user - > imagen_verificacion;
                if (img) {
                    document.getElementById('uploadPreview').src = "/img/logo.png";
                } else {
                    document.getElementById('uploadPreview').src = '/images/perfil/'.$user - > id.
                    '/'.$user - > imagen_verificacion;
                }

                document.getElementById('btnrm').style.display = 'none';
                //document.getElementById('lblportada' + nb).style.display = 'none';

                document.getElementById('uploadImage').value = '';
            }
        </script>





    </section>
@endsection
