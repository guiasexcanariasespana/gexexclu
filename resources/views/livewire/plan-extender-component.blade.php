<div>

    <div class="stats stats-vertical lg:stats-horizontal shadow mt-5 mx-auto">

        <div class="stat place-items-center">

            <div class="stat-value text-secondary">
                {{ Form::label('Plane', 'Plan') }}
                <select class="form-control" id="plane_id" name="plane_id" wire:model='selectedPlane' wire:poll.1s>
                    @foreach ($planes as $plan)
                        <option value="{{ $plan->id }}">{{ $plan->nombre }}</option>
                    @endforeach
                </select>

                {!! $errors->first('plane_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div>

        <div class="stat place-items-center">

            <div class="stat-value text-secondary">
                {{ Form::label('Precio', 'Precio €: ' . $this->precio) }}
                {{ Form::hidden('precio', null, ['wire:model' => 'precio', 'class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div>

        <div class="stat place-items-center">

            <div class="stat-value">
                {{ Form::label('Días', 'Días: ' . $this->dias) }}
                {{ Form::hidden('dias', null, ['wire:model' => 'dias', 'class' => 'form-control' . ($errors->has('dias') ? ' is-invalid' : ''), 'placeholder' => 'dias']) }}
                {!! $errors->first('dias', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div>

    </div>

</div>
