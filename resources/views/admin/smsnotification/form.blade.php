<section class="bg-white rounded-lg shadow-md p-6">
    <div class="space-y-4">
        <!-- Campo user_id -->
        <div class="form-group">
            <label for="user_id" class="block text-sm font-medium text-gray-700">Usuario ID</label>
            <input type="text" name="user_id" id="user_id" value="{{ old('user_id', $smsnotification->user_id) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('user_id') border-red-500 @enderror"
                   placeholder="User Id">
            @error('user_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo anuncio_id -->
        <div class="form-group">
            <label for="anuncio_id" class="block text-sm font-medium text-gray-700">Anuncio ID</label>
            <input type="text" name="anuncio_id" id="anuncio_id" value="{{ old('anuncio_id', $smsnotification->anuncio_id) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('anuncio_id') border-red-500 @enderror"
                   placeholder="Anuncio Id">
            @error('anuncio_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo telefono -->
        <div class="form-group">
            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
            <input type="tel" name="telefono" id="telefono" value="{{ old('telefono', $smsnotification->telefono) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('telefono') border-red-500 @enderror"
                   placeholder="Telefono">
            @error('telefono')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo mensaje -->
        <div class="form-group">
            <label for="mensaje" class="block text-sm font-medium text-gray-700">Mensaje</label>
            <textarea name="mensaje" id="mensaje" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('mensaje') border-red-500 @enderror"
                      placeholder="Mensaje">{{ old('mensaje', $smsnotification->mensaje) }}</textarea>
            @error('mensaje')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo respuesta -->
        <div class="form-group">
            <label for="respuesta" class="block text-sm font-medium text-gray-700">Respuesta</label>
            <input type="text" name="respuesta" id="respuesta" value="{{ old('respuesta', $smsnotification->respuesta) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('respuesta') border-red-500 @enderror"
                   placeholder="Respuesta">
            @error('respuesta')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo sms_id -->
        <div class="form-group">
            <label for="sms_id" class="block text-sm font-medium text-gray-700">SMS ID</label>
            <input type="text" name="sms_id" id="sms_id" value="{{ old('sms_id', $smsnotification->sms_id) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('sms_id') border-red-500 @enderror"
                   placeholder="Sms Id">
            @error('sms_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo error_id -->
        <div class="form-group">
            <label for="error_id" class="block text-sm font-medium text-gray-700">Error ID</label>
            <input type="text" name="error_id" id="error_id" value="{{ old('error_id', $smsnotification->error_id) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('error_id') border-red-500 @enderror"
                   placeholder="Error Id">
            @error('error_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo error_msg -->
        <div class="form-group">
            <label for="error_msg" class="block text-sm font-medium text-gray-700">Mensaje de Error</label>
            <input type="text" name="error_msg" id="error_msg" value="{{ old('error_msg', $smsnotification->error_msg) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('error_msg') border-red-500 @enderror"
                   placeholder="Error Msg">
            @error('error_msg')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Submit') }}
        </button>
    </div>
</section>