<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('titulo') }}
            {{ Form::text('titulo', $nota->titulo, ['class' => 'form-control' . ($errors->has('titulo') ? ' is-invalid' : ''), 'placeholder' => 'Nota']) }}
            {!! $errors->first('titulo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('nota') }}
            {{ Form::text('nota', $nota->nota, ['class' => 'form-control' . ($errors->has('nota') ? ' is-invalid' : ''), 'placeholder' => 'Nota']) }}
            {!! $errors->first('nota', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
    </div>
</div>
