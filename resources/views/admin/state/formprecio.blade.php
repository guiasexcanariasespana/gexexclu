<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
        <b>Provincia:</b> {{$state->name}}
        </div>
        {{ Form::hidden('state_id', $precio->state_id, ['class' => 'form-control' . ($errors->has('state_id') ? ' is-invalid' : ''), 'placeholder' => 'State Id']) }}        
        
         <div class="form-group">
            {!! Form::label('plan_id', 'Plan') !!}
            {!! Form::select('plan_id', $planes, $precio->plan_id, ['class' => 'form-control']) !!}

            @error('plan_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="form-group">
            {{ Form::label('precio') }}
            {{ Form::text('precio', $precio->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
            {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
       


    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
    </div>
</div>