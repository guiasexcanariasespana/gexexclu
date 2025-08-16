<div class="card card-info">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="name">{{ __('Nombre') }}</label>
                <input type="text" name="name" id="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name', $user->name) }}" 
                       required maxlength="50" 
                       placeholder="{{ __('Name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group col-lg-6">
                <label for="email">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email', $user->email) }}" 
                       required maxlength="120" 
                       placeholder="{{ __('Email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="password">{{ __('Password') }}</label>
                <input type="password" name="password" id="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       placeholder="{{ __('Ingresa el password si lo cambia') }}">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>           
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="telefono">{{ __('Telefono') }}</label>
                <input type="tel" name="telefono" id="telefono" 
                       class="form-control @error('telefono') is-invalid @enderror" 
                       value="{{ old('telefono', $user->telefono) }}" 
                       required minlength="9" maxlength="9" 
                       placeholder="{{ __('Telefono') }}">
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group col-lg-6">
                <label for="direccion">{{ __('Direccion') }}</label>
                <input type="text" name="direccion" id="direccion" 
                       class="form-control @error('direccion') is-invalid @enderror" 
                       value="{{ old('direccion', $user->direccion) }}" 
                       placeholder="{{ __('Direccion') }}">
                @error('direccion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-5">
                <label for="nacionalidad">{{ __('Nacionalidad') }}</label>
                <select name="nacionalidad" id="nacionalidad" 
                        class="form-control @error('nacionalidad') is-invalid @enderror">
                    @foreach ($user->paises as $pais)
                        <option value="{{ $pais }}" 
                            @selected(old('nacionalidad', $user->nacionalidad) == $pais)>
                            {{ $pais }}
                        </option>
                    @endforeach
                </select>
                @error('nacionalidad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group col-lg-4">
                <label for="profesion">{{ __('Profesion') }}</label>
                <input type="text" name="profesion" id="profesion" 
                       class="form-control @error('profesion') is-invalid @enderror" 
                       value="{{ old('profesion', $user->profesion) }}" 
                       placeholder="{{ __('Profesion') }}">
                @error('profesion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group col-lg-3">
                <label for="edad">{{ __('Edad') }}</label>
                <select name="edad" id="edad" 
                        class="form-control @error('edad') is-invalid @enderror">
                    @for ($i = 18; $i <= 99; $i++)
                        <option value="{{ $i }}" @selected(old('edad', $user->edad) == $i)>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
                @error('edad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-3">
                <label for="gps">{{ __('GPS') }}</label>
                <input type="text" name="gps" id="gps" 
                       class="form-control @error('gps') is-invalid @enderror" 
                       value="{{ old('gps', $user->gps) }}" 
                       placeholder="{{ __('GPS') }}">
                @error('gps')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
                
            <div class="form-group col-lg-3">
                <label for="ip_al_registrarse">{{ __('IP al registrarse') }}</label>
                <input type="text" name="ip_al_registrarse" id="ip_al_registrarse" 
                       class="form-control @error('ip_al_registrarse') is-invalid @enderror" 
                       value="{{ old('ip_al_registrarse', $user->ip_al_registrarse) }}" 
                       placeholder="{{ __('IP al registrarse') }}">
                @error('ip_al_registrarse')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-3">
                <label for="email_verified_at">{{ __('Fecha validacion Email') }}</label>
                <input type="date" name="email_verified_at" id="email_verified_at" 
                       class="form-control @error('email_verified_at') is-invalid @enderror" 
                       value="{{ old('email_verified_at', $user->email_verified_at ? $user->email_verified_at->format('Y-m-d') : '') }}">
                @error('email_verified_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3">
                <p class="font-weight-bold">{{ __('Estado WSP') }}</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="estado_wsp" id="estado_wsp_pendiente" 
                           value="Pendiente" @checked(old('estado_wsp', $user->estado_wsp) == 'Pendiente')>
                    <label class="form-check-label" for="estado_wsp_pendiente">{{ __('Pendiente') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="estado_wsp" id="estado_wsp_validado" 
                           value="Validado" @checked(old('estado_wsp', $user->estado_wsp) == 'Validado')>
                    <label class="form-check-label" for="estado_wsp_validado">{{ __('Validado') }}</label>
                </div>
                @error('estado_wsp')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3">
                <p class="font-weight-bold">{{ __('Verificado') }}</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="verificado" id="verificado_no" 
                           value="No" @checked(old('verificado', $user->verificado) == 'No')>
                    <label class="form-check-label" for="verificado_no">{{ __('No') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="verificado" id="verificado_si" 
                           value="Si" @checked(old('verificado', $user->verificado) == 'Si')>
                    <label class="form-check-label" for="verificado_si">{{ __('Si') }}</label>
                </div>
                @error('verificado')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="card-footer mt-4">
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </div>
    </div>
</div>