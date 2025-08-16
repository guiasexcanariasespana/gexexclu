<section class="text-white bg-gray-900">

<div class="px-4 py-24 mx-auto max-w-screen-xl">
    <div class="max-w-3xl mx-auto text-center">
    <!-- Mensaje de WS validado  -->
       <div class="alert alert-success shadow-lg mb-10">
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Has Validado tu número de Whatsapp</span>
              </div>
                  <button class="bg-transparent text-2xl font-semibold leading-none relative outline-none focus:outline-none" onclick="closeAlert(event)">
                  <span>×</span></button>
        </div>

              <div class="p-1 shadow-xl bg-gradient-to-r from-pink-500 via-red-500 to-pink-500 rounded-xl ">
                  
                      <div class="block p-6 bg-gray-900 sm:p-8 rounded-xl">
                          <p class=" text-3xl text-pink-600">
                          {{__('Bienvenido/a')}} {{$user->name }}
                          </p>
                          <div class="m-8 sm:px-8">
                          <h5 class="text-4xl font-bold text-pink-600">{{__('Comencemos a crear tu Anuncio')}}</h5>
                        </div>
                        <img  class="w-14/16 mx-auto 2xl "
                          src="img/anuncio-icon.gif" />
                      </div> 

                      
              </div> 
             <!-- Guardar en Anuncio   -->
             <form method="POST" action="{{ route('admin.users.store_anuncio', $user) }}"  role="form" enctype="multipart/form-data">
                      @csrf
                         <div class="relative block p-8 pb-24 border-t-4 border-pink-600 rounded-sm shadow-xl mt-10">
                              <h5 class="text-4xl font-bold text-pink-700"> {{ __('¿ Tu eres ?') }}</h5>
                                      <label class="mr-2">
                                          {!! Form::radio(
                                              'orientacion',
                                              'Heterosexual',
                                              $anuncio->orientacion == '' ? true : $anuncio->orientacion == 'Heterosexual',
                                          ) !!}
                                          Heterosexual
                                      </label>
                                      <label class="mr-2">
                                          {!! Form::radio(
                                              'orientacion',
                                              'Bisexual',
                                              $anuncio->orientacion == '' ? true : $anuncio->orientacion == 'Bisexual',
                                          ) !!}
                                          Bisexual
                                      </label>
                                      <label class="mr-2">
                                          {!! Form::radio(
                                              'orientacion',
                                              'Otra',
                                              $anuncio->orientacion == '' ? true : $anuncio->orientacion == 'Otra',
                                          ) !!}
                                          Otra
                                      </label>
                                  <div class="mt-10">
                                    
                                    <img  class="inline" src="img/avatar-woman.gif" />
                                    <img  class="inline" src="img/avatar-man.gif" />
                                    <img  class="inline" src="img/avatar-trans.gif" />
                                    <img  class="inline" src="img/avatar-otro.gif" />
                                  </div>
                                
                          </div> 
                           @livewire('planes-component', [
                                            'selectedZone'=>'',
                                            'selectedOrientacion'=>'',
                                            'selectedPlane'=>'',
                                            'selectedCategoria' => '',
                                            'precio' => '',
                                            'dias' => ''])

                                            <button type="submit" class="mt-10 px-12 py-3 text-lg font-medium text-white bg-pink-600 border border-pink-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-white focus:outline-none focus:ring" href="">
        {{__('Continuar')}}
        </button>

              </form>  
            
            
                    <div class="mt-10 relative pt-1">
                      <progress class="progress progress-accent w-56" value="40" max="100"></progress>  
                          
                          <p class="mt-2 mb-10 justify-left text-md font-bold text-pink-600">
                      {{__('40% completado')}} 
                      </p>
                  </div>
                      <ul class="steps steps-vertical lg:steps-horizontal">
                      <li class="step step-accent">Registro</li>
                      <li class="step step-accent">Validación</li>
                      <li class="step step-accent">Zona</li>
                      <li class="step">Plan</li>
                      <li class="step">Pago</li>
                      <li class="step">Anuncio</li>
                      </ul>
            
           
      </div>
</div>            

       
    @if ($user->paso == 2)
   
       @include('partial.dashboard_paso3_zones')

    @endif         
    
    @if ($user->paso == 3)
   
       @include('partial.dashboard_paso3_pago')

    @endif  

</section>


<!-- JS de mensaje  -->
<script>
  function closeAlert(event){
    let element = event.target;
    while(element.nodeName !== "BUTTON"){
      element = element.parentNode;
    }
    element.parentNode.parentNode.removeChild(element.parentNode);
  }
</script>
