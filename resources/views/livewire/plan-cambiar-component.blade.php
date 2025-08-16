<div>

    <div class="stats w-full stats-vertical lg:stats-horizontal shadow mt-5 mx-auto">

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
                {{ Form::label('Precio', 'Pagaras €: ' . number_format($this->precio_pagar, 2, '.', ' ')) }}
            </div>
            {{ Form::hidden('precio', null, ['wire:model' => 'precio_pagar', 'class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
            {{ Form::label('Precio', 'Precio Plan €: ' . number_format($precio, 2, '.', ' ')) }}
            {{ Form::label('Precio', 'Tienes a Favor €: ' . number_format($this->saldo, 2, '.', ' ')) }}
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
