@extends('layouts.portal')

@section('content')

<div class="container max-w-xl mx-auto">


    <div class="w-full my-5 ">

        <h2 class="text-center text-4xl my-10 font-bold"> Formulario de Contacto </h2>

        <form action="{{ route('contact.send') }}" method="POST" class="bg-white border border-gray-700 shadow-xl rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                <div class="col-sm-10">
                    <input value="{{old('nombre')}}" type="text" class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" requigray name="nombre" placeholder="nombre">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Teléfono</label>
                <div class="col-sm-10">
                    <input type="text"  value="{{old('telefono')}}" class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="telefono" placeholder="telefono">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <div class="col-sm-10">
                    <input type="email"  value="{{old('email')}}" class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" requigray name="email" placeholder="email">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Motivo</label>
                <div class="col-sm-10">
                    <input type="text"  value="{{old('motivo')}}" class="shadow appearance-none border border-gray-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" requigray name="motivo" placeholder="motivo">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Mensaje</label>
                <div class="col-sm-10">
                    <textarea name="mensaje" class="shadow appearance-none border border-gray-500 rounded w-full py-5 px-3"  cols="50" requigray placeholder="mensaje">
                       {{old('mensaje')}}
                    </textarea>
                </div>
            </div>
            <div class="mb-4">
                <label for="captcha">Captcha</label>
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
                @error('g-recaptcha-response')
                    <div class="alert alert-danger mt-1 mb-1">Debe completar el recaptcha</div>
                @enderror
            </div>
            <div class="mb-4">
                <x-jet-label for="terms" class="">
                    <div class="flex items-center">
                        <x-jet-checkbox name="terms" id="terms" />
    
                        <div class="ml-2">
                            He leído y acepto la {!! __(':privacy_policy', [
                                'terms_of_service' =>
                                    '<a target="_blank" href="' .
                                    route('terms.show') .
                                    '" class="underline text-sm  hover:text-pink-700">' .
                                    __('Terms of Service') .
                                    '</a>',
                                'privacy_policy' =>
                                    '<a target="_blank" href="' .
                                    route('policy.show') .
                                    '" class="underline text-sm  hover:text-pink-700">' .
                                    __('Privacy Policy') .
                                    '</a>',
                            ]) !!}
    
                        </div>
    
                    </div>
                     @error('terms')
                                    <div class="alert alert-danger mt-1 mb-1">Debe aceptar el campo terinos y servicios</div>
                                @enderror
                </x-jet-label>
    
            </div>
    
            <div class="form-group row">
                <button class="btn btn-info col-md-10">Enviar</button>
            </div>
        </form>




          
      </div>


      <div class="w-full my-8 ">
   <h3 class="font-bold text-center my-5"> INFORMACIÓN BÁSICA SOBRE PROTECCIÓN DE DATOS</h3>


<h4 class="font-bold mt-5">Finalidades</h4>

<p>Contactar contigo para resolver tus dudas y facilitarte la información solicitada, así como, en su caso, remitirte información sobre nuestros productos y servicios, que pueda ser de tu interés, por medios electrónicos.
Derechos.</p>

<p>Puedes acceder, rectificar y suprimir tus datos personales, así
como ejercer otros derechos dirigiéndote a info@canariasexclusiva.com.
</p>
<h4 class="font-bold mt-5">Info. Adicional</h4>
<p>Puede consultar nuestra Política de Privacidad completa <a target="_blank" href="{{route('policy.show')}}" class="underline text-sm  hover:text-pink-700">{{__('aquí')}} </a><p>
</div>

</div>
@endsection
