        <!--1/3 col -->



 <div >
        <div class="relative h-0" style="padding-bottom: 145%">

                            <a href="{{route('portal.show', [$anuncio->provincia, $anuncio->municipio, $anuncio->categoria, $anuncio->user_id, $anuncio])}}" class="no-underline hover:no-underline">
                                @if(is_null($anuncio->portada))
                                <img  src="{{config('app.url')}}/images/logo.png " class="object-cover ">
                                @else

                                <img class="absolute h-full w-full object-contain  hover:shadow-xl transition-transform transform hover:border-4 border-[{{$anuncio->clase->color}}]" src="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/' . $anuncio->portada->nombre }}" loading="lazy" oncontextmenu="return false">
                                @endif


                            </a>

            </div>


                        <div class="py-2 px-2">
                          <h3 class="text-sm font-extrabold">{{ \Illuminate\Support\Str::limit($anuncio->nombre, 50, $end='...') }}  <span class="inline-block ml-1"><img src="{{config('app.url')}}/img/banderas/Bandera de {{$anuncio->nacionalidad}}.svg" class="inline-block w-3" alt=""/> </span></h3>






                         </div>







 </div>

