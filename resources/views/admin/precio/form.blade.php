<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('precio') }}
            {{ Form::text('precio', $precio->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
            {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('plan_id') }}
            {{ Form::text('plan_id', $precio->plan_id, ['class' => 'form-control' . ($errors->has('plan_id') ? ' is-invalid' : ''), 'placeholder' => 'Plan Id']) }}
            {!! $errors->first('plan_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('state_id') }}
            {{ Form::text('state_id', $precio->state_id, ['class' => 'form-control' . ($errors->has('state_id') ? ' is-invalid' : ''), 'placeholder' => 'State Id']) }}
            {!! $errors->first('state_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('zone_id') }}
            {{ Form::text('zone_id', $precio->zone_id, ['class' => 'form-control' . ($errors->has('zone_id') ? ' is-invalid' : ''), 'placeholder' => 'Zone Id']) }}
            {!! $errors->first('zone_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
