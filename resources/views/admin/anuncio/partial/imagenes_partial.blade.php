         <form method="POST" action="{{ route('admin.imagenes.guardar_orden', $anuncio) }}" role="form"
             enctype="multipart/form-data" class="w-100">
             <div class="row ">

                 @csrf
                 @foreach ($anuncio->imagens->sortBy('position') as $img)
                     <div class="col-lg-2 ">

                         <a href="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}" data-toggle="lightbox"
                             data-gallery="gallery">
                             <img src="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}"
                                 class="mx-auto d-block w-auto" style="height: 120px; ">
                         </a>

                         <p class='text-sm mt-2'>
                             <input type="hidden" name='imagen[{{ $img->id }}][id]' id='imagen{{ $img->id }}'
                                 value={{ $img->id }} class='col-sm-4'>
                             <b>Nro:</b> <input type="number" name='imagen[{{ $img->id }}][posicion]'
                                 id='imagen{{ $img->position }}' value={{ $img->position }} class='col-sm-4'><br>
                             <b>Portada Solicitada:</b> {{ $img->portada }}<br>
                             {!! Form::radio('portada_id', $img->id, $anuncio->portada_id == $img->id) !!}
                             <b>Portada</b><br>
                             <b>Estado:</b> {{ $img->estado }}
                         </p>
                         @if ($img->estado == 'Pendiente' or $img->estado == 'Rechazado')
                             <a class="btn btn-success btn-sm"
                                 href="{{ route('admin.imagens.aceptar_imagen', $img) }}">
                                 {{ __('Aprobar') }}</a>
                         @endif
                         <a class="btn btn-info btn-sm"
                             href="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/original/' . $img->nombre }}"
                             target="_blank">
                             <ion-icon name="eye-outline"></ion-icon>
                         </a>
                         @if ($img->estado == 'Pendiente' or $img->estado == 'Verificada')
                             <a class="btn btn-danger btn-sm"
                                 href="{{ route('admin.imagens.rechazar_imagen', $img) }}">
                                 <ion-icon name="trash-outline"></ion-icon>
                             </a>
                         @endif

                     </div>
                 @endforeach

             </div>
             @if (count($anuncio->imagens) > 0)
                 <div class="mt-4 mb-4">
                     <button type="submit" class="btn btn-sm btn-primary">{{ __('Submit') }}</button>
             @endif

             </div>
         </form>
         @if ($anuncio->imagenes_pendientes() > 0)
             <a href="{{ route('admin.anuncio.create_images', $anuncio) }}" class="btn btn-primary "
                 data-placement="left">
                 Agregar Imágenes
             </a>
         @endif
