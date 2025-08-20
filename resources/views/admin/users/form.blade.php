<div class="card card-info p-4">
    <div class="card-body">
        @csrf
        <input type="hidden" name="verificacion" value="Si">
        <input type="hidden" name="user_id" value="{{ $anuncio->user_id }}" 
               class="form-control @error('user_id') is-invalid @enderror" 
               placeholder="Usuario">
        @error('user_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="row">
            <div class="form-group col-md-6">
                <label for="titulo" class= "block text-sm font-medium text-gray-700 mb-1">Título</label>
                <input type="text" name="titulo" id="titulo" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('titulo') is-invalid @enderror" 
                       value="{{ old('titulo', $anuncio->titulo) }}" 
                       placeholder="Título">
                @error('titulo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="nombre" class= "block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" id="nombre" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('nombre') is-invalid @enderror" 
                       value="{{ old('nombre', $anuncio->nombre) }}" 
                       placeholder="Nombre">
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
            <input type="text" name="slug" id="slug" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('slug') is-invalid @enderror" 
                   value="{{ old('slug', $anuncio->slug) }}" 
                   placeholder="Slug">
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class= "block text-sm font-medium text-gray-700 mb-1">Presentación que se Muestra en el Anuncio</label>
            <div class="border p-2 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                {!! $anuncio->presentacion !!}
            </div>
        </div>

        <div class="form-group @if($anuncio->presentacion_aux != $anuncio->presentacion) text-danger @endif">
            <label for="presentacion_aux">Presentación</label>
            @if($anuncio->presentacion_aux != $anuncio->presentacion)
                <span class="badge badge-warning">Existen modificaciones</span>
            @endif
            <textarea name="presentacion_aux" id="presentacion_aux" 
                      class="form-control @error('presentacion_aux') is-invalid @enderror"
                      rows="2" maxlength="20"
                      placeholder="Ingrese la presentación del anuncio.">{{ old('presentacion_aux', $anuncio->presentacion_aux) }}</textarea>
            @error('presentacion_aux')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="horario">Horario</label>
            <textarea name="horario" id="horario" 
                      class="form-control @error('horario') is-invalid @enderror"
                      rows="2" maxlength="20"
                      placeholder="Ingrese su horarios disponibles.">{{ old('horario', $anuncio->horario) }}</textarea>
            @error('horario')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="bg-light p-3 mb-3 rounded">
            <label class="font-weight-bold">Tarifas €</label>
            <div class="row">

                 <!-- Sección 4: Tarifas -->
        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-7">Tarifas (€)</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-7 gap-3">
                @foreach([
                    'treinta_minutos' => '30 min',
                    'cuarenta_y_cinco_minutos' => '45 min', 
                    'una_hora' => '1 hora',
                    'medio_dia' => 'Medio día',
                    'todo_el_dia' => 'Día completo',
                    'fin_de_semana' => 'Fin de semana',
                    'hora_desplazamiento' => 'Hora despl.'
                ] as $field => $label)
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">{{ $label }}</label>
                        <input type="number" name="{{ $field }}" 
                               value="{{ old($field, $anuncio->$field) }}"
                               class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 @error($field) border-red-500 @enderror">
                        @error($field)
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
            </div>
        </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <p class="font-weight-bold">Orientación</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="orientacion" id="orientacion_heterosexual" 
                           value="Heterosexual" @checked(old('orientacion', $anuncio->orientacion ?: 'Heterosexual') == 'Heterosexual')>
                    <label class="form-check-label" for="orientacion_heterosexual">Heterosexual</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="orientacion" id="orientacion_bisexual" 
                           value="Bisexual" @checked(old('orientacion', $anuncio->orientacion) == 'Bisexual')>
                    <label class="form-check-label" for="orientacion_bisexual">Bisexual</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="orientacion" id="orientacion_homosexual" 
                           value="Homosexual" @checked(old('orientacion', $anuncio->orientacion) == 'Homosexual')>
                    <label class="form-check-label" for="orientacion_homosexual">Homosexual</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="orientacion" id="orientacion_otra" 
                           value="Otra" @checked(old('orientacion', $anuncio->orientacion) == 'Otra')>
                    <label class="form-check-label" for="orientacion_otra">Otra</label>
                </div>
                @error('orientacion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="space-y-2">
                <label for="telefono" class= "block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <input type="tel" name="telefono" id="telefono" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('telefono') is-invalid @enderror" 
                       value="{{ old('telefono', $anuncio->telefono) }}" 
                       required minlength="9" maxlength="9"
                       placeholder="Teléfono Publicación">
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="telefono_publicacion" class= "block text-sm font-medium text-gray-700 mb-1" >Teléfono Publicación</label>
                <input type="tel" name="telefono_publicacion" id="telefono_publicacion" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('telefono_publicacion') is-invalid @enderror" 
                       value="{{ old('telefono_publicacion', $anuncio->telefono_publicacion) }}" 
                       maxlength="9"
                       placeholder="Teléfono Publicación">
                @error('telefono_publicacion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="space-y-2">
                <p class="block text-sm font-medium text-gray-700 mb-1">Whatsapp</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="whatsapp" id="whatsapp_no" 
                           value="No" @checked(old('whatsapp', $anuncio->whatsapp == 'No'))>
                    <label class="form-check-label" for="whatsapp_no">No</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="whatsapp" id="whatsapp_si" 
                           value="Si" @checked(old('whatsapp', $anuncio->whatsapp == '' || $anuncio->whatsapp == 'Si'))>
                    <label class="form-check-label" for="whatsapp_si">Sí</label>
                </div>
                @error('whatsapp')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="space-y-2">
                <p class="block text-sm font-medium text-gray-700 mb-1">Tipo</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo" id="tipo_normal" 
                           value="Normal" @checked(old('tipo', $anuncio->tipo == '' || $anuncio->tipo == 'Normal'))>
                    <label class="form-check-label" for="tipo_normal">Normal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo" id="tipo_doble" 
                           value="Doble" @checked(old('tipo', $anuncio->tipo == 'Doble'))>
                    <label class="form-check-label" for="tipo_doble">Doble</label>
                </div>
                @error('tipo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>


        <div class="grid grid-cols-1 gap-4">
            @livewire('statedropdowns', [
                'anuncio' => $anuncio,
                'selectedMuni' => old('municipio_id', $anuncio->municipio_id),
                'selectedClase' => old('clase_id', $anuncio->clase_id),
                'selectedPlane' => old('plane_id', $anuncio->plane_id),
                'selectedCategoria' => old('categoria_id', $anuncio->categoria_id),
                'precio' => old('precio', $anuncio->precio),
                'dias' => old('dias', $anuncio->dias),
                'localidad' => old('localidad', $anuncio->localidad),
        ])
        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Edad</label>
                <select name="edad"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('edad') border-red-500 @enderror">
                    @for($i = 18; $i <= 99; $i++)
                        <option value="{{ $i }}" @selected(old('edad', $anuncio->edad) == $i)>{{ $i }}</option>
                    @endfor
                </select>
                @error('edad')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 mb-1 ">Nacionalidad</label>
                <select name="nacionalidad"
                 class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('nacionalidad') border-red-500 @enderror">
                    @foreach ($user->paises as $pais)
                        <option value="{{ $pais }}" @if (old('nacionalidad') == $pais or $pais == $anuncio->nacionalidad) Selected @endif>
                            {{ $pais }}</option>
                    @endforeach
                
                </select>
                @error('nacionalidad')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Profesión</label>
                <input type="text" name="profesion" value="{{ old('profesion', $anuncio->profesion) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('profesion') border-red-500 @enderror"
                       placeholder="Tu profesión">
                @error('profesion')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="space-y-2">
                <label for="fecha_de_publicacion" class="block text-sm font-medium text-gray-700 mb-1" >Fecha de Publicación</label>
                <input type="date" name="fecha_de_publicacion" id="fecha_de_publicacion" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('fecha_de_publicacion') is-invalid @enderror" 
                       value="{{ old('fecha_de_publicacion', $anuncio->fecha_de_publicacion? \Carbon\carbon::parse($anuncio->fecha_de_publicacion)->format('Y-m-d'): $anuncio->fecha_de_publicacion) }}" 
                       placeholder="Fecha de Publicación">
                @error('fecha_de_publicacion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="fecha_caducidad" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Caducidad</label>
                <input type="date" name="fecha_caducidad" id="fecha_caducidad" 
                 class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('fecha_caducidad') is-invalid @enderror" 
                       value="{{ old('fecha_caducidad', $anuncio->fecha_caducidad ? \Carbon\carbon::parse($anuncio->fecha_caducidad)->format('Y-m-d'): $anuncio->fecha_caducidad) }}" 
                       placeholder="Fecha de Caducidad">
                @error('fecha_caducidad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="fecha_pausa" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Pausa</label>
                <input type="date" name="fecha_pausa" id="fecha_pausa" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('fecha_pausa') is-invalid @enderror" 
                       value="{{ old('fecha_pausa', $anuncio->fecha_pausa ? \Carbon\carbon::parse($anuncio->fecha_pausa)->format('Y-m-d'): $anuncio->fecha_pausa) }}" 
                       placeholder="Fecha de Pausa">
                @error('fecha_pausa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="space-y-2">
                <label  for= "dias_restantes" class="block text-sm font-medium text-gray-700 mb-1" >Días Restantes</label>
                <div class="form-control-plaintext w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    {{ $anuncio->dias_restantes() }}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="space-y-2">
                <label for="gps" class="block text-sm font-medium text-gray-700 mb-1" >GPS</label>
                <input type="text" name="gps" id="gps" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('gps') is-invalid @enderror" 
                       value="{{ old('gps', $anuncio->gps) }}" 
                       placeholder="GPS">
                @error('gps')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="ip_address" class="block text-sm font-medium text-gray-700 mb-1" >IP Address</label>
                <input type="text" name="ip_address" id="ip_address" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('ip_address') is-invalid @enderror" 
                       value="{{ old('ip_address', $anuncio->ip_address) }}" 
                       placeholder="IP Address">
                @error('ip_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="port" class="block text-sm font-medium text-gray-700 mb-1">Port</label>
                <input type="text" name="port" id="port" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('port') is-invalid @enderror" 
                       value="{{ old('port', $anuncio->port) }}" 
                       placeholder="Port">
                @error('port')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @foreach(['Exterior' => $tag_al, 'Interior' => $tag_in, 'En Casa' => $tag_ec, 'En tu casa' => $tag_etc] as $section => $tags)
                <div class="space-y-2">
                    <p class="font-weight-bold block text-m font-m text-gray-700 mb-1">{{ $section }}</p>
                    @foreach($tags as $tag)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tags[]" 
                                   id="tag_{{ $tag->id }}" value="{{ $tag->id }}"
                                   @checked(in_array($tag->id, old('tags', $anuncio->tags->pluck('id')->toArray())))>
                            <label class="form-check-label text-sm" for="tag_{{ $tag->id }}">
                                {{ $tag->nombre }}
                            </label>
                        </div>
                    @endforeach
                    @error('tags')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach
        </div>  
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="space-y-2">
                <p class="font-weight-bold">Estado Pago</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="estado_pago" id="estado_pago_no" 
                        value="No" @checked(old('estado_pago', $anuncio->estado_pago ?: 'No') == 'No')>
                    <label class="form-check-label" for="estado_pago_no">No</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="estado_pago" id="estado_pago_si" 
                        value="Si" @checked(old('estado_pago', $anuncio->estado_pago) == 'Si')>
                    <label class="form-check-label" for="estado_pago_si">Sí</label>
                </div>
                @error('estado_pago')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <p class="font-weight-bold">Estado</p>
                @foreach(['Borrador', 'A_Publicar', 'Publicado', 'Pausado', 'Finalizado', 'Suspendido'] as $status)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="estado" id="estado_{{ $status }}" 
                            value="{{ $status }}" @checked($anuncio->estado == $status) disabled>
                        <label class="form-check-label" for="estado_{{ $status }}">{{ $status }}</label>
                    </div>
                @endforeach
                @error('estado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="space-y-2">
                <p class="text-sm">Autorizas mostrarte en las redes?</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="mostrar_en_redes" id="mostrar_en_redes_no" 
                    value="No" @checked(old('mostrar_en_redes', $anuncio->mostrar_en_redes ?: 'No') == 'No')>
                    <label class="form-check-label" for="mostrar_en_redes_no">No</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="mostrar_en_redes" id="mostrar_en_redes_si" 
                    value="Si" @checked(old('mostrar_en_redes', $anuncio->mostrar_en_redes) == 'Si')>
                    <label class="form-check-label" for="mostrar_en_redes_si">Sí</label>
                </div>
                @error('mostrar_en_redes')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </div>
    </div>
</div>