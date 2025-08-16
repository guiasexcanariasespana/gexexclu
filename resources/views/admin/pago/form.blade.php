<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            <strong>Usuario:</strong>
            @if (is_null($pago->user_id))
                'N/D'
            @else
                ({{ $pago->user_id }})
                - {{ $pago->user->name }}
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
            {{ Form::text('fecha_transac', $pago->fecha_transac, ['class' => 'form-control' . ($errors->has('fecha_transac') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Transac']) }}
            {!! $errors->first('fecha_transac', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <p class="font-weight-bold">Estado</p>
            <label class="mr-2">
                {!! Form::radio('estado', 'Aprobado', $pago->estado == '' ? true : $pago->estado == 'Aprobado') !!}
                Aprobado
            </label>
            <label class="mr-2">
                {!! Form::radio('estado', 'Rechazado', $pago->estado == 'Rechazado') !!}
                Rechazado
            </label>
            @error('estado')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
