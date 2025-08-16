<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" 
                       value="{{ old('name', $user->name) }}"
                       class="form-control @error('name') is-invalid @enderror"
                       required maxlength="50" placeholder="Name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group col-lg-6">
                <label for="email">Email</label>
                <input type="email" name="email" id="email"
                       value="{{ old('email', $user->email) }}"
                       class="form-control @error('email') is-invalid @enderror"
                       required maxlength="120" placeholder="Email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="password">Password</label>
                <input type="password" name="password" id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       required minlength="8" placeholder="Password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-6">
                <label for="password_confirmation">Password Confirmación</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="form-control @error('password') is-invalid @enderror"
                       required minlength="8" placeholder="Password Confirmación">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="telefono">Teléfono</label>
                <input type="tel" name="telefono" id="telefono"
                       value="{{ old('telefono', $user->telefono) }}"
                       class="form-control @error('telefono') is-invalid @enderror"
                       required minlength="9" maxlength="9" placeholder="Telefono">
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group col-lg-6">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion"
                       value="{{ old('direccion', $user->direccion) }}"
                       class="form-control @error('direccion') is-invalid @enderror"
                       placeholder="Direccion">
                @error('direccion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-5">
                <label for="nacionalidad">Nacionalidad</label>
                <select name="nacionalidad" id="nacionalidad" 
                        class="form-control @error('nacionalidad') is-invalid @enderror">
                    @foreach ($user->paises as $pais)
                        <option value="{{ $pais }}" {{ old('nacionalidad', $user->nacionalidad) == $pais ? 'selected' : '' }}>
                            {{ $pais }}
                        </option>
                    @endforeach
                </select>
                @error('nacionalidad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group col-lg-4">
                <label for="profesion">Profesión</label>
                <input type="text" name="profesion" id="profesion"
                       value="{{ old('profesion', $user->profesion) }}"
                       class="form-control @error('profesion') is-invalid @enderror"
                       placeholder="Profesion">
                @error('profesion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group col-lg-3">
                <label for="edad">Edad</label>
                <select name="edad" id="edad" 
                        class="form-control @error('edad') is-invalid @enderror">
                    @for ($i = 18; $i <= 99; $i++)
                        <option value="{{ $i }}" {{ old('edad', $user->edad) == $i ? 'selected' : '' }}>
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
                <label for="gps">GPS</label>
                <input type="text" name="gps" id="gps"
                       value="{{ old('gps', $user->gps) }}"
                       class="form-control @error('gps') is-invalid @enderror"
                       placeholder="Gps">
                @error('gps')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group col-lg-3">
                <label for="ip_al_registrarse">IP al registrarse</label>
                <input type="text" name="ip_al_registrarse" id="ip_al_registrarse"
                       value="{{ old('ip_al_registrarse', $user->ip_al_registrarse) }}"
                       class="form-control @error('ip_al_registrarse') is-invalid @enderror"
                       placeholder="Ip Al Registrarse">
                @error('ip_al_registrarse')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3">
                <p class="font-weight-bold">Estado WSP</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="estado_wsp" id="estado_wsp_pendiente" 
                           value="Pendiente" {{ old('estado_wsp', $user->estado_wsp) == 'Pendiente' ? 'checked' : '' }}>
                    <label class="form-check-label" for="estado_wsp_pendiente">Pendiente</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="estado_wsp" id="estado_wsp_validado" 
                           value="Validado" {{ old('estado_wsp', $user->estado_wsp) == 'Validado' ? 'checked' : '' }}>
                    <label class="form-check-label" for="estado_wsp_validado">Validado</label>
                </div>
                @error('estado_wsp')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3">
                <p class="font-weight-bold">Verificado</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="verificado" id="verificado_no" 
                           value="No" {{ old('verificado', $user->verificado) == 'No' ? 'checked' : '' }}>
                    <label class="form-check-label" for="verificado_no">No</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="verificado" id="verificado_si" 
                           value="Si" {{ old('verificado', $user->verificado) == 'Si' ? 'checked' : '' }}>
                    <label class="form-check-label" for="verificado_si">Sí</label>
                </div>
                @error('verificado')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="box-footer mt20">
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </div>
    </div>
</div>