
<div class="w-full mx-auto">
    <div class=" mx-auto">
     
       
             <div class="my-4 bg-white rounded overflow-hidden p-4 ">
                
               <p class="font-bold my-5">Anuncio:  {{ __('Nombre y Título') }}</p>
               <p><strong>Nombre:</strong> {{ $anuncio->nombre }}</p>
               <p><strong>Título: </strong>{{ $anuncio->nombre }}</p>

               <div class="h-1 w-full mx-auto border-b my-2"></div>

               <strong> <label>Género/Identidad </label></strong>
               <p>{{ $anuncio->orientacion }}</p>
               @if ($anuncio->orientacion == 'Otra')
                   <p>{{ $anuncio->orientacion_otra }}</p>
               @endif




            </div>

            <div class="my-4 bg-white rounded overflow-hidden p-4 ">
                @php
                $muni = null;
                if (!is_null($anuncio->zone_id)) {
                    $muni = $anuncio->zone->municipio_id;
                }
                @endphp
                <h3 class="font-bold uppercase my-5"> {{ __(' Datos del plan actual ') }}</h3>
                <label class="">
                    <p> <strong> Categoría:  </strong> {{ $anuncio->categoria->nombre }}</p>
                    <p><strong> Provincia: </strong> {{ $anuncio->provincia->nombre }}</p>
                    <p><strong>Municipio:</strong> {{ $anuncio->municipio->nombre }}</p>
                    <p><strong>Localidad: </strong>{{ $anuncio->localidad }}</p>
                </label>

            </div>


    </div>

    
</div>
                    
                    @livewire('plan-cambiar-component', [
                        'selectedPlane' =>  null,                        
                        'categoria' => $anuncio->categoria,
                        'precio' => $anuncio->precio,
                        'dias' => $anuncio->dias,
                        'anuncio' => $anuncio,
                        'saldo' => $anuncio->saldo_a_favor(),
                        'clase' => $clase,
                    ])
