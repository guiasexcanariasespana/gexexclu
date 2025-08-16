<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="form-group  col-lg-6">
                {{ Form::label('Nombre') }}
                {{ Form::text('name', $user->name, ['required', 'maxlength' => '50', 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group  col-lg-6">
                {{ Form::label('email') }}
                {{ Form::text('email', $user->email, ['required', 'maxlength' => '120', 'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
                {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group  col-lg-6">
                {{ Form::label('password') }}
                <input type="text" class="form-control" name="password" id="password" placeholder="{{ __('Ingresa el password si lo cambia') }}">                
                {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
            </div>           
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                {{ Form::label('telefono') }}
                {{ Form::text('telefono', $user->telefono, ['required', 'minlength' => '9', 'maxlength' => '9', 'class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
                {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-6">
                {{ Form::label('direccion') }}
                {{ Form::text('direccion', $user->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion']) }}
                {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        {{-- <div class="form-group col-lg-6">
                {{ Form::label('direccion_a_mostrar') }}
                {{ Form::text('direccion_a_mostrar', $user->direccion_a_mostrar, ['class' => 'form-control' . ($errors->has('direccion_a_mostrar') ? ' is-invalid' : ''), 'placeholder' => 'Direccion A Mostrar']) }}
                {!! $errors->first('direccion_a_mostrar', '<div class="invalid-feedback">:message</div>') !!}
            </div> --}}

        <div class="row">

            <div class="form-group col-lg-5">
                {{ Form::label('Nacionalidad') }}
                {{-- {{ Form::select('nacionalidad', $user->paises, $user->nacionalidad, ['class' => 'form-control' . ($errors->has('nacionalidad') ? ' is-invalid' : '')]) }} --}}
                <select name='nacionalidad' id='nacionalidad' class='form-control'>
                    @foreach ($user->paises as $pais)
                        <option value="{{ $pais }}" @if (old('nacionalidad' == $pais) or $pais == $user->nacionalidad) selected @endif>
                            {{ $pais }}</option>
                    @endforeach
                </select>
                {!! $errors->first('nacionalidad', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-4">
                {{ Form::label('profesion') }}
                {{ Form::text('profesion', $user->profesion, ['class' => 'form-control' . ($errors->has('profesion') ? ' is-invalid' : ''), 'placeholder' => 'profesion']) }}
                {!! $errors->first('profesion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-3">
               {{ Form::label('edad') }}
                {{-- {{ Form::number('edad', old('edad', $anuncio->edad), ['class' => 'form-control' . ($errors->has('edad') ? ' is-invalid' : ''), 'placeholder' => 'Edad']) }} --}}
                <div class="form-group">
                    {{ Form::selectRange('edad', 18, 99, $user->edad, ['class' => 'form-control' . ($errors->has('edad') ? ' is-invalid' : '')]) }}
                    {!! $errors->first('edad', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

        </div>
        <div class="row">


            <div class="form-group col-lg-3">
                 {{ Form::label('gps') }}
                {{ Form::text('gps', $user->gps, ['class' => 'form-control' . ($errors->has('gps') ? ' is-invalid' : ''), 'placeholder' => 'Gps']) }}
                {!! $errors->first('gps', '<div class="invalid-feedback">:message</div>') !!}
            </div>
                
            <div class="form-group col-lg-3">
                {{ Form::label('ip_al_registrarse') }}
                {{ Form::text('ip_al_registrarse', $user->ip_al_registrarse, ['class' => 'form-control' . ($errors->has('ip_al_registrarse') ? ' is-invalid' : ''), 'placeholder' => 'Ip Al Registrarse']) }}
                {!! $errors->first('ip_al_registrarse', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            {{-- <div class="form-group">
            {{ Form::label('whatsapp') }}
            {{ Form::text('whatsapp', $user->whatsapp, ['class' => 'form-control' . ($errors->has('whatsapp') ? ' is-invalid' : ''), 'placeholder' => 'Whatsapp']) }}
            {!! $errors->first('whatsapp', '<div class="invalid-feedback">:message</div>') !!}
        </div> --}}
        </div>
        <div class="row">
          <div class="form-group col-lg-3">
            {{ Form::label('email_verified_at', 'Fecha validacion Email') }}
            {{ Form::date('email_verified_at', $user->email_verified_at, ['class' => 'form-control' . ($errors->has('email_verified_at') ? ' is-invalid' : ''), 'placeholder' => 'Email Verificado?']) }}
            {!! $errors->first('email_verified_at', '<div class="invalid-feedback">:message</div>') !!}
          </div>

            <div class="form-group col-lg-3">
                <p class="font-weight-bold">Estado WSP</p>
                <label class="mr-2">
                    {!! Form::radio('estado_wsp', 'Pendiente', $user->estado_wsp == 'Pendiente') !!}
                    Pendiente
                </label>
                <label class="mr-2">
                    {!! Form::radio('estado_wsp', 'Validado', $user->estado_wsp == 'Validado') !!}
                    Validado
                </label>
                @error('estado_wsp')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-lg-3">
                <p class="font-weight-bold">Verificado</p>
                <label class="mr-2">
                    {!! Form::radio('verificado', 'No', $user->verificado == 'No') !!}
                    No
                </label>
                <label class="mr-2">
                    {!! Form::radio('verificado', 'Si', $user->verificado == 'Si') !!}
                    Si
                </label>
                @error('verificado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </div>
        <div class="box-footer mt20">
            <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
        </div>
    </div>
</div>
