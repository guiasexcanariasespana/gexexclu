<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="space-y-4">

        <!-- User Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm font-medium text-gray-700">Usuario:</p>
                <p class="mt-1 text-sm text-gray-900">
                    @if (is_null($pago->user_id))
                        'N/D'
                    @else
                        ({{ $pago->user_id }}) - {{ $pago->user->name }}
                    @endif
                </p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-700">Mail Pago:</p>
                <p class="mt-1 text-sm text-gray-900">{{ $pago->mail_pago }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-700">Anuncio Id:</p>
                <p class="mt-1 text-sm text-gray-900">{{ $pago->anuncio_id }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-700">Moneda Precio:</p>
                <p class="mt-1 text-sm text-gray-900">{{ $pago->moneda_precio }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-700">Precio:</p>
                <p class="mt-1 text-sm text-gray-900">{{ $pago->precio }}</p>
            </div>
        </div>

        <!-- Editable Form Fields -->
        <div class="space-y-4 mt-6">
            <!-- Moneda Pago Field -->
            <div class="space-y-1">
                <label for="moneda_pago" class="block text-sm font-medium text-gray-700">Moneda Pago</label>
                <input type="text"
                       id="moneda_pago"
                       name="moneda_pago"
                       value="{{ old('moneda_pago', $pago->moneda_pago) }}"
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('moneda_pago') border-red-500 @enderror"
                       placeholder="Moneda Pago">
                @error('moneda_pago')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Monto Pago Field -->
            <div class="space-y-1">
                <label for="monto_pago" class="block text-sm font-medium text-gray-700">Monto Pago</label>
                <input type="text"
                       id="monto_pago"
                       name="monto_pago"
                       value="{{ old('monto_pago', $pago->monto_pago) }}"
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('monto_pago') border-red-500 @enderror"
                       placeholder="Monto Pago">
                @error('monto_pago')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Medio Pago Field -->
            <div class="space-y-1">
                <label for="medio_pago" class="block text-sm font-medium text-gray-700">Medio Pago</label>
                <input type="text"
                       id="medio_pago"
                       name="medio_pago"
                       value="{{ old('medio_pago', $pago->medio_pago) }}"
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('medio_pago') border-red-500 @enderror"
                       placeholder="Medio Pago">
                @error('medio_pago')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nro Transac Field -->
            <div class="space-y-1">
                <label for="nro_transac" class="block text-sm font-medium text-gray-700">Nro Transac</label>
                <input type="text"
                       id="nro_transac"
                       name="nro_transac"
                       value="{{ old('nro_transac', $pago->nro_transac) }}"
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('nro_transac') border-red-500 @enderror"
                       placeholder="Nro Transac">
                @error('nro_transac')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fecha Transac Field -->
            <div class="space-y-1">
                <label for="fecha_transac" class="block text-sm font-medium text-gray-700">Fecha Transac</label>
                <input type="text"
                       id="fecha_transac"
                       name="fecha_transac"
                       value="{{ old('fecha_transac', $pago->fecha_transac) }}"
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('fecha_transac') border-red-500 @enderror"
                       placeholder="Fecha Transac">
                @error('fecha_transac')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Estado Radio Buttons -->
        <div class="mt-6">
            <p class="text-sm font-medium text-gray-700 mb-2">Estado</p>
            <div class="flex items-center space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio"
                           name="estado"
                           value="Aprobado"
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                           @checked(old('estado', $pago->estado ?: 'Aprobado') === 'Aprobado')>
                    <span class="ml-2 text-sm text-gray-700">Aprobado</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio"
                           name="estado"
                           value="Rechazado"
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                           @checked(old('estado', $pago->estado) === 'Rechazado')>
                    <span class="ml-2 text-sm text-gray-700">Rechazado</span>
                </label>
            </div>
            @error('estado')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Submit Button -->
    <div class="mt-6 flex justify-end">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
            Guardar
        </button>
    </div>
</div>