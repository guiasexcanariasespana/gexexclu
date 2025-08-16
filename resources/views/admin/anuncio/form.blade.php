<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            <label for="user_id">Usuario</label>
            <input type="text" name="user_id" id="user_id" 
                   value="{{ old('user_id', $anuncio->user_id) }}"
                   class="form-control @error('user_id') is-invalid @enderror" 
                   placeholder="Usuario">
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" 
                   value="{{ old('nombre', $anuncio->nombre) }}"
                   class="form-control @error('nombre') is-invalid @enderror" 
                   placeholder="Nombre">
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" 
                   value="{{ old('titulo', $anuncio->titulo) }}"
                   class="form-control @error('titulo') is-invalid @enderror" 
                   placeholder="Título">
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" 
                   value="{{ old('slug', $anuncio->slug) }}"
                   class="form-control @error('slug') is-invalid @enderror" 
                   placeholder="Slug">
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="presentacion">Descripción corta</label>
            <textarea name="presentacion" id="presentacion" 
                      class="form-control @error('presentacion') is-invalid @enderror" 
                      placeholder="Ingrese una Descripción corta del Producto">{{ old('presentacion', $anuncio->presentacion) }}</textarea>
            @error('presentacion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <p class="font-weight-bold">Tipo</p>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="tipo_normal" 
                       value="Normal" {{ (old('tipo', $anuncio->tipo ?: 'Normal') == 'Normal') ? 'checked' : '' }}>
                <label class="form-check-label" for="tipo_normal">Normal</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="tipo_doble" 
                       value="Doble" {{ old('tipo', $anuncio->tipo) == 'Doble' ? 'checked' : '' }}>
                <label class="form-check-label" for="tipo_doble">Doble</label>
            </div>
            @error('tipo')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <p class="font-weight-bold">Orientación</p>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="orientacion" id="orientacion_hetero" 
                       value="Heterosexual" {{ (old('orientacion', $anuncio->orientacion ?: 'Heterosexual') == 'Heterosexual' ? 'checked' : '' }}>
                <label class="form-check-label" for="orientacion_hetero">Heterosexual</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="orientacion" id="orientacion_bi" 
                       value="Bisexual" {{ old('orientacion', $anuncio->orientacion) == 'Bisexual' ? 'checked' : '' }}>
                <label class="form-check-label" for="orientacion_bi">Bisexual</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="orientacion" id="orientacion_otra" 
                       value="Otra" {{ old('orientacion', $anuncio->orientacion) == 'Otra' ? 'checked' : '' }}>
                <label class="form-check-label" for="orientacion_otra">Otra</label>
            </div>
            @error('orientacion')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" 
                   value="{{ old('telefono', $anuncio->telefono) }}"
                   class="form-control @error('telefono') is-invalid @enderror" 
                   placeholder="Teléfono">
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <p class="font-weight-bold">Mostrar Teléfono</p>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="mostrar_telefono" id="mostrar_tel_no" 
                       value="No" {{ (old('mostrar_telefono', $anuncio->mostrar_telefono ?: 'No') == 'No') ? 'checked' : '' }}>
                <label class="form-check-label" for="mostrar_tel_no">No</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="mostrar_telefono" id="mostrar_tel_si" 
                       value="Si" {{ old('mostrar_telefono', $anuncio->mostrar_telefono) == 'Si' ? 'checked' : '' }}>
                <label class="form-check-label" for="mostrar_tel_si">Sí</label>
            </div>
            @error('mostrar_telefono')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="whatsapp">WhatsApp</label>
            <input type="text" name="whatsapp" id="whatsapp" 
                   value="{{ old('whatsapp', $anuncio->whatsapp) }}"
                   class="form-control @error('whatsapp') is-invalid @enderror" 
                   placeholder="WhatsApp">
            @error('whatsapp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="clase_id">Clase</label>
            <select name="clase_id" id="clase_id" 
                    class="form-control @error('clase_id') is-invalid @enderror">
                @foreach($clases as $id => $name)
                    <option value="{{ $id }}" {{ old('clase_id', $anuncio->clase_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @error('clase_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @livewire('statedropdowns', [
            'selectedState' => $anuncio->state,
            'selectedZone' => $anuncio->zone,
            'selectedPlane' => $anuncio->plane,
            'selectedCategoria' => $anuncio->categoria_id
        ])

        <div class="form-group">
            <label for="localidad">Localidad</label>
            <input type="text" name="localidad" id="localidad" 
                   value="{{ old('localidad', $anuncio->localidad) }}"
                   class="form-control @error('localidad') is-invalid @enderror" 
                   placeholder="Localidad">
            @error('localidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" 
                   value="{{ old('fecha_nacimiento', $anuncio->fecha_nacimiento) }}"
                   class="form-control @error('fecha_nacimiento') is-invalid @enderror">
            @error('fecha_nacimiento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="edad">Edad</label>
            <input type="number" name="edad" id="edad" 
                   value="{{ old('edad', $anuncio->edad) }}"
                   class="form-control @error('edad') is-invalid @enderror" 
                   placeholder="Edad">
            @error('edad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nacionalidad">Nacionalidad</label>
            <select name="nacionalidad" id="nacionalidad" 
                    class="form-control @error('nacionalidad') is-invalid @enderror">
                @foreach($anuncio->user->paises as $id => $name)
                    <option value="{{ $id }}" {{ old('nacionalidad', $anuncio->nacionalidad) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @error('nacionalidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="profesion">Profesión</label>
            <input type="text" name="profesion" id="profesion" 
                   value="{{ old('profesion', $anuncio->profesion) }}"
                   class="form-control @error('profesion') is-invalid @enderror" 
                   placeholder="Profesión">
            @error('profesion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="gps">GPS</label>
            <input type="text" name="gps" id="gps" 
                   value="{{ old('gps', $anuncio->gps) }}"
                   class="form-control @error('gps') is-invalid @enderror" 
                   placeholder="GPS">
            @error('gps')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="ip_address">Dirección IP</label>
            <input type="text" name="ip_address" id="ip_address" 
                   value="{{ old('ip_address', $anuncio->ip_address) }}"
                   class="form-control @error('ip_address') is-invalid @enderror" 
                   placeholder="Dirección IP">
            @error('ip_address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="port">Puerto</label>
            <input type="text" name="port" id="port" 
                   value="{{ old('port', $anuncio->port) }}"
                   class="form-control @error('port') is-invalid @enderror" 
                   placeholder="Puerto">
            @error('port')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="estado" id="estado" 
                   value="{{ old('estado', $anuncio->estado) }}"
                   class="form-control @error('estado') is-invalid @enderror" 
                   placeholder="Estado">
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="destacado">Destacado</label>
            <input type="text" name="destacado" id="destacado" 
                   value="{{ old('destacado', $anuncio->destacado) }}"
                   class="form-control @error('destacado') is-invalid @enderror" 
                   placeholder="Destacado">
            @error('destacado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="verificacion">Verificación</label>
            <input type="text" name="verificacion" id="verificacion" 
                   value="{{ old('verificacion', $anuncio->verificacion) }}"
                   class="form-control @error('verificacion') is-invalid @enderror" 
                   placeholder="Verificación">
            @error('verificacion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>