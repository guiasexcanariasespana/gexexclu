<x-registro-layout>
<section>

<div class="px-4 py-32 mx-auto max-w-screen-xl lg:h-screen lg:flex">
    <div class="max-w-3xl mx-auto text-center">
         
      <div class="max-w-xl mx-auto  mt-4 sm:leading-relaxed sm:text-xl">
      
                <div class="card w-96 bg-base-200 mx-auto shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title">{{__('Ingresa el código recibido para validar')}}</h2>
                         
                                        <p>
                                    <form action="{{ route('verificar.codigows') }}" method="POST">   
                                        {{ csrf_field() }}  
                                            <input id="codigows" name="codigows" type="text" placeholder="Type here" class="input input-bordered focus:border-pink-700 w-full max-w-xs" /> 
                                        </p>
                                        <div class="card-actions justify-center">
                                            <button type="submit" class="block w-full px-12 py-3 mt-5 text-lg font-medium text-white bg-pink-600 border border-pink-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-pink-700 focus:outline-none focus:ring" href="{{route('enviar.codigo.validacion')}}">
                                                        {{__('Validar código')}}
                                            </button>
                                            
                                        </div>
                                        
                                    </form>
                        </div>
                      
                </div>

                
        </div>
        
        </div> 
    </div>
  
  </div>
</section>
</x-registro-layout>