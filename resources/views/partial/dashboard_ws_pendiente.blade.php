<section class="text-white bg-gray-900">
@if (is_null($user->codigo_ws) or $user->paso == 0)  

<div class="px-4 py-32 mx-auto max-w-screen-xl lg:h-screen lg:flex">
    <div class="max-w-3xl mx-auto text-center">
    
      <h1 class="text-3xl font-extrabold text-transparent sm:text-5xl bg-clip-text bg-gradient-to-r from-green-300 via-blue-500 to-purple-600">
      {{__('Información acerca de la verificación de')}}

        <span class="sm:block">
        {{__('su teléfono.')}}
        </span>
      </h1>
      <p class="max-w-xl mx-auto mt-4 sm:leading-relaxed sm:text-xl">
      {{__('Bienvenido, vamos con el primer paso, espera a que te llegue un SMS con un código de verificación de 6 dígitos que podrás ingresar en la pantalla de verificación. El código es único y cambia cada vez que verificas un número de teléfono o un dispositivo nuevos.')}}
      </p>
    
     
      <div class="flex flex-wrap justify-center mt-8 gap-4">
        <a class="block w-full px-12 py-3 text-lg font-medium text-white bg-blue-600 border border-blue-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-white focus:outline-none focus:ring" href="{{route('enviar.codigo.validacion')}}">
        {{__('Validar mi número')}}
        </a>

        <a class="block w-full px-12 py-3 text-lg font-medium text-white border border-blue-600 rounded sm:w-auto hover:bg-blue-600 active:bg-blue-500 focus:outline-none focus:ring" href="/about">
        {{__('¿ Necesitas Ayuda ?')}}
        </a>
      </div>

        <div class="mt-10 relative pt-1">
              <progress class="progress progress-accent w-56" value="10" max="100"></progress>  
                  
                  <p class="mt-2 mb-10 justify-left text-md font-bold text-pink-600">
              {{__('20% completado')}} 
              </p>
              </div>
              <ul class="steps steps-vertical lg:steps-horizontal">
              <li class="step step-accent">Registro</li>
              <li class="step step-accent">Validación</li>
              <li class="step">Zona</li>
              <li class="step">Plan</li>
              <li class="step">Pago</li>
              <li class="step">Anuncio</li>
              </ul>
        </div> 
    </div>
    
  </div>
     
@else

    @if ($user->paso == 2)
    @include('partial.dashboard_paso2')
    @endif


@endif 
</section>