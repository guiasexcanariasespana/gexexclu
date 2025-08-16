<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $smsnotification->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('anuncio_id') }}
            {{ Form::text('anuncio_id', $smsnotification->anuncio_id, ['class' => 'form-control' . ($errors->has('anuncio_id') ? ' is-invalid' : ''), 'placeholder' => 'Anuncio Id']) }}
            {!! $errors->first('anuncio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('telefono') }}
            {{ Form::text('telefono', $smsnotification->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('mensaje') }}
            {{ Form::text('mensaje', $smsnotification->mensaje, ['class' => 'form-control' . ($errors->has('mensaje') ? ' is-invalid' : ''), 'placeholder' => 'Mensaje']) }}
            {!! $errors->first('mensaje', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('respuesta') }}
            {{ Form::text('respuesta', $smsnotification->respuesta, ['class' => 'form-control' . ($errors->has('respuesta') ? ' is-invalid' : ''), 'placeholder' => 'Respuesta']) }}
            {!! $errors->first('respuesta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('sms_id') }}
            {{ Form::text('sms_id', $smsnotification->sms_id, ['class' => 'form-control' . ($errors->has('sms_id') ? ' is-invalid' : ''), 'placeholder' => 'Sms Id']) }}
            {!! $errors->first('sms_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('error_id') }}
            {{ Form::text('error_id', $smsnotification->error_id, ['class' => 'form-control' . ($errors->has('error_id') ? ' is-invalid' : ''), 'placeholder' => 'Error Id']) }}
            {!! $errors->first('error_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('error_msg') }}
            {{ Form::text('error_msg', $smsnotification->error_msg, ['class' => 'form-control' . ($errors->has('error_msg') ? ' is-invalid' : ''), 'placeholder' => 'Error Msg']) }}
            {!! $errors->first('error_msg', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
    </div>
</div>