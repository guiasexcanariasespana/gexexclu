<div>
    @if ($anuncio->estado != 'Publicado')
        @if ($anuncio->estado == 'Borrador' &&
            $anuncio->estado_pago == 'Si' &&
            !is_null($anuncio->imagen_verificacion) &&
            $anuncio->cantidad_imagenes_subidas() > 0)
            <h2 class="text-xl font-bold  mb-2">Una vez que hagas click en publicar , debes
                aguardar que se revise el anuncio</h2>
            <a class="btn h-10 w-44 text-white text-xl font-bold btn-success "
                href="{{ route('a_publicar', $anuncio) }}"><i class="fa fa-fw  fa-eye"></i>
                {{ __('Publicar') }}
            </a>
        @else
            <h2 class="text-xl text-red-700 font-bold  mb-2">Aún tu anuncio no cumple los requisitos necesarios par
                publicar
            </h2>
        @endif
    @endif
    <p class="leading-6 font-light pl-9 text-justify">
    <ul>Para poder publicar debes tener pago tu anuncio.
        <li class="@if (!$foto_perfil) text-[#bb1a19] @endif">Una foto de Verificacion para validar tu
            identidad.</li>
        <li class="@if (!$telefono) ) text-[#bb1a19] @endif">Un Telefono a mostrar en tu publicacion.
        </li>
        <li class="@if (!$cantidad_imagenes) text-[#bb1a19] @endif">Al menos una foto a publicar en tu anuncio.
        </li>
    </ul>
    </p>
    {{-- @if ($anuncio->estado != 'A_Publicar')
         <a class="btn btn-sm btn-success" href="{{ route('cambiar_plan_anuncio', $anuncio) }}"> Cambiar de plan
        </a>
    @endif --}}
   
    @if ($anuncio->se_puede_republicar() )
        <a class="btn btn-sm btn-success" href="{{ route('republicar', $anuncio) }}"> Republicar mi anuncio
        </a>
    @endif
    {{-- @if ($anuncio->se_puede_extender())
        <a class="btn btn-sm btn-primary" href="{{ route('extender_publicacion', $anuncio) }}">
            Extender mi anuncio</a>
    @endif --}}
    @if ($anuncio->estado == 'Publicado' && $anuncio->dias_restantes() > 0)
        <a class="btn btn-sm btn-success" href="#" onclick="confirmar_pusar({{ $anuncio->id }})"> Pausar anuncio
        </a>
    @endif
    @if ($anuncio->estado == 'Pausado' && $anuncio->dias_restantes() > 0)
        <a class="btn btn-sm btn-success" href="#" onclick="confirmar_reactivar({{ $anuncio->id }})"> Reactivar anuncio
        </a>
    @endif
    

</div>
