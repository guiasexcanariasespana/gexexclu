@extends('layouts.portal')

@section('denunciaTitle', "Denunciar Perfil: {$anuncio->nombre} - {$anuncio->titulo}")

@section('denunciaDescription', "Denuncia de Perfil para {$anuncio->nombre} - {$anuncio->titulo} Escort en España para encuentros. Acompañantes chicas, chicos, transexuales, servicios de masajistas en España, no anuncios de sexo ni putas en España")

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container max-w-4xl mx-auto px-4">
        <!-- Encabezado -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Formulario de Denuncia de Perfil
            </h1>
            <p class="text-xl text-gray-700 font-medium">
                Perfil: <span class="text-indigo-600">({{ $anuncio->slug }}) {{ $anuncio->nombre }} - {{ $anuncio->titulo }}</span>
            </p>
        </div>

        <!-- Formulario -->
        <div class="bg-white border border-gray-200 shadow-xl rounded-xl p-6 md:p-8 mb-8">
            <form action="{{ route('denuncia.send', $anuncio) }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">Nombre</label>
                        <input 
                            id="nombre"
                            value="{{ old('nombre') }}" 
                            type="text" 
                            class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition duration-200" 
                            required 
                            name="nombre" 
                            placeholder="Tu nombre completo"
                        >
                        @error('nombre')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="telefono">Teléfono</label>
                        <input 
                            id="telefono"
                            type="text"  
                            value="{{ old('telefono') }}" 
                            class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition duration-200" 
                            required 
                            name="telefono" 
                            placeholder="Número de teléfono"
                        >
                        @error('telefono')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                    <input 
                        id="email"
                        type="email"  
                        value="{{ old('email') }}" 
                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition duration-200" 
                        required 
                        name="email" 
                        placeholder="correo@ejemplo.com"
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="motivo">Motivo de la denuncia</label>
                    <input 
                        id="motivo"
                        type="text"  
                        value="{{ old('motivo') }}" 
                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition duration-200" 
                        required 
                        name="motivo" 
                        placeholder="Breve descripción del motivo"
                    >
                    @error('motivo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mensaje">Mensaje</label>
                    <textarea 
                        id="mensaje"
                        name="mensaje" 
                        rows="5" 
                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition duration-200" 
                        required 
                        placeholder="Describe con detalle los motivos de tu denuncia..."
                    >{{ old('mensaje') }}</textarea>
                    @error('mensaje')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Captcha</label>
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display(['data-theme' => 'light']) !!}
                    @error('g-recaptcha-response')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input 
                                id="terms" 
                                name="terms" 
                                type="checkbox" 
                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                {{ old('terms') ? 'checked' : '' }}
                            >
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-gray-700">
                                He leído y acepto la 
                                <a href="{{ route('terms.show') }}" target="_blank" class="text-indigo-600 hover:text-indigo-500">Política de Términos de Servicio</a> 
                                y la 
                                <a href="{{ route('policy.show') }}" target="_blank" class="text-indigo-600 hover:text-indigo-500">Política de Privacidad</a>
                            </label>
                            @error('terms')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-8">
                    <a href="{{ url()->previous() }}" class="px-6 py-3 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 transition duration-200 font-medium w-full sm:w-auto text-center">
                        Cancelar
                    </a>
                    <button type="submit" class="px-6 py-3 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition duration-200 font-medium shadow-md w-full sm:w-auto text-center">
                        Enviar Denuncia
                    </button>
                </div>
            </form>
        </div>

        <!-- Información de protección de datos -->
        <div class="bg-white border border-gray-200 shadow-xl rounded-xl p-6 md:p-8">
            <h3 class="font-bold text-gray-900 text-xl text-center mb-6">INFORMACIÓN BÁSICA SOBRE PROTECCIÓN DE DATOS</h3>

            <div class="space-y-5">
                <div>
                    <h4 class="font-bold text-gray-800 text-lg mb-2">Finalidades</h4>
                    <p class="text-gray-600">
                        Poder recibir, gestionar y tramitar la petición enviada a través del formulario de denuncias y, en su caso, tomar las medidas necesarias para retirar contenido o cualquier otra acción necesaria.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800 text-lg mb-2">Derechos</h4>
                    <p class="text-gray-600">
                        Puedes acceder, rectificar y suprimir tus datos personales, así como ejercer otros derechos dirigiéndote a <a href="mailto:info@canariasexclusiva.com" class="text-indigo-600 hover:text-indigo-500">info@canariasexclusiva.com</a>.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800 text-lg mb-2">Información Adicional</h4>
                    <p class="text-gray-600">
                        Puede consultar nuestra Política de Privacidad completa <a href="{{ route('policy.show') }}" target="_blank" class="text-indigo-600 hover:text-indigo-500">aquí</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        border-color: #4f46e5;
    }
    
    .btn-primary {
        background-color: #4f46e5;
        transition: all 0.2s ease;
    }
    
    .btn-primary:hover {
        background-color: #4338ca;
        transform: translateY(-1px);
    }
    
    .alert-danger {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    /* Estilos para el recaptcha */
    .g-recaptcha {
        display: inline-block;
        margin: 10px 0;
    }
</style>
@endsection