<div>
    <div class="container  mx-auto my-10">

        <div class="flex-1 px-2 sm:px-0">

            <div class="mb-10 sm:mb-0 mt-10 grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($anuncios_usuario as $anun)
                    <div
                        class="relative group bg-gray-900 py-10 sm:py-20 px-4 flex flex-col space-y-2 items-center cursor-pointer rounded-md hover:bg-gray-900/80 hover:smooth-hover">
                        @if (is_null($anun->portada))
                            <img src="{{ config('app.url') }}/images/logo.png "
                                class="w-20 h-20 object-cover object-center rounded-full">
                        @else
                            <img class="w-20 h-20 object-cover object-center rounded-full"
                                src="{{ config('app.url') . '/images/anuncio/' . $anun->id . '/' . $anun->portada->nombre }}"
                                loading="lazy" oncontextmenu="return false">
                        @endif
                        <h4 class="text-white text-2xl font-bold capitalize text-center">{{ $anun->id }} -
                            {{ $anun->nombre }}</h4>
                        <p class="text-xs text-white"> {{ $anun->localidad }}</p>
                        @if ($anun->estado == 'Publicado')
                            <p class="absolute top-2 text-white inline-flex items-center text-xs">{{ $anun->estado }}
                                <span
                                    class="ml-2 w-2 h-2 block bg-green-500 rounded-full group-hover:animate-pulse"></span>
                            </p>
                        @else
                            <p class="absolute top-2 text-white inline-flex items-center text-xs">{{ $anun->estado }}
                                <span
                                    class="ml-2 w-2 h-2 block bg-red-700 rounded-full group-hover:animate-pulse"></span>
                            </p>
                        @endif
                        <p class="absolute top-6  inline-flex text-white/70 text-sm"><b>Días Pendientes:</b>
                            @if ($anun->estado == 'A_Publicar')
                                {{ $anun->dias }}
                            @else
                                {{ $anun->fecha_caducidad ? $anun->dias_restantes() : '' }} @if($anun->estado == 'Publicado')Hoy Incl.@endif
                            @endif
                        </p>
                        <p class="absolute top-10 inline-flex text-white/70 text-sm"><b>Desde:</b>
                            {{ $anun->fecha_de_publicacion ? date('d-m-Y', strtotime($anun->fecha_de_publicacion)) : '' }}
                        </p>

                        <p class="absolute top-14  inline-flex text-white/70 text-sm"><b>Vence:</b>
                            {{ $anun->fecha_caducidad ? date('d-m-Y', strtotime($anun->fecha_caducidad)) : '' }} </p>
                        <div class="flex-1 space-y-1.5 space-x-0.5 ">
                            @if ($anun->se_puede_editar())
                                <a class="btn btn-xs btn-outline btn-error" href="{{ route('edit_anuncio', $anun) }}">
                                    Editar </a>
                            @endif
                            <a class="btn btn-xs btn-outline btn-success "
                                href="{{ route('portal.show', [$anun->provincia, $anun->municipio, $anun->categoria, $anun->user_id, $anun]) }}">{{ __('Ver') }}</a>
                            @if ($anun->estado == 'Publicado' && $anun->dias_restantes() > 0 )
                                <a class="btn btn-xs btn-outline  btn-warning" href="#"
                                    onclick="confirmar_pusar({{ $anun->id }})">
                                    Pausar
                                </a>
                            @endif
                            @if ($anun->estado == 'Pausado' && $anun->dias_restantes() > 0)
                                <a class="btn btn-xs btn-outline btn-info" href="#"
                                    onclick="confirmar_reactivar({{ $anun->id }})">
                                    Reactivar
                                </a>
                            @endif
                            @if ($anun->se_puede_republicar())
                                <a class="btn btn-xs btn-outline btn-success" href="{{ route('republicar', $anun) }}">
                                    Republicar
                                </a>
                                @if (strtolower($anun->clase->nombre) != 'diamante')
                                    <a class="btn btn-xs btn-outline btn-info"
                                        href="{{ route('cambiar_plan_anuncio', [$anun, ($clase = 'Diamante')]) }}">
                                        Pasar a Diamante
                                    </a>
                                @endif
                            @endif
                            {{-- @if ($anun->se_puede_extender())
                                <a class="btn btn-xs btn-outline btn-accent"
                                    href="{{ route('extender_publicacion', $anun) }}">
                                    Extender</a>
                            @endif --}}
                            {{-- @if ($anun->estado != 'A_Publicar')
                            <a class="btn btn-xs btn-outline btn-success"
                                href="{{ route('cambiar_plan_anuncio', $anun) }}">
                                Cambiar de plan
                            </a>
                            @endif --}}


                        </div>
                        <div class="absolute bottom-8 inline-flex  text-white">

                            <div class="badge badge-outline">Plan: {{ $anun->plane->clase->nombre }}</div>

                            <div class="badge badge-outline">Pagado: {{ $anun->estado_pago }}</div>
                        </div>
                        <div class="absolute bottom-2 inline-flex  text-white">

                            <div class="badge badge-outline">Días: {{ $anun->dias }}</div>

                            <div class="badge badge-outline">Categ.:
                                {{ $anun->categoria ? $anun->categoria->nombre : 'N/D' }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $anuncios_usuario->links() }}
        </div>
    </div>
</div>
