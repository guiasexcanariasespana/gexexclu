<x-registro-layout>

<div class="px-4 py-3 text-white bg-pink-600 animate-pulse">
  <p class="text-lg font-medium text-center">
    {{__('Para continuar DEBES validar tu número de teléfono')}}
 </p>
</div>

<section>
 

<div class="px-4 py-32 mx-auto max-w-screen-xl lg:h-screen lg:flex">
    <div class="max-w-3xl mx-auto text-center">
    
      <h1 class="text-6xl font-extrabold text-pink-700">
      {{__('Información acerca de la verificación de tu número de')}}

        <span class="sm:block">
        {{__('Teléfono.')}}
        </span>
      </h1>
      <p class="max-w-xl mx-auto mt-4 sm:leading-relaxed sm:text-xl">
      {{__('Bienvenido, vamos con el primer paso, espera a que te llegue un SMS con un código de verificación de 6 dígitos que podrás ingresar en la pantalla de verificación. El código es único y cambia cada vez que verificas un número de teléfono o un dispositivo nuevos.')}}
      </p>
      <p class="mt-5">Si ya validaste tu telefono has click en el botón de continuar </p>
     
      <div class="flex flex-wrap justify-center mt-8 gap-4">
        <a class="block w-full px-12 py-3 text-lg font-medium text-white hover:text-pink-700 bg-pink-600 border border-pink-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent focus:outline-none focus:ring" href="{{route('enviar.codigo.validacion')}}">
        {{__('Validar mi número')}}
        </a>

        <a class="block w-full px-12 py-3 text-lg font-medium  border border-pink-600 rounded sm:w-auto hover:bg-pink-700 active:bg-pink-500 focus:outline-none focus:ring" href="{{ url('/dashboard') }}">
        {{__('Continuar')}}
        </a>
       
      </div>

      <div class="inline-block text-center my-10">
        <a href="{{ url('/') }}"
        class="underline text-sm  hover:text-pink-700  ">Volver al Portal</a>
      </div>
        </div> 
    </div>
   
  </div>
     
</section>

</x-registro-layout>
