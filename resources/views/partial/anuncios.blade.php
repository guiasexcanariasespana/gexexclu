<div class="container px-4 md:px-0 max-w-9xl mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <span class="card-title"><b>{{ __('Anuncios') }}</b></span>
            </div>



        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="anuncios" class="table table-striped table-hover">
                    <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Orientacion</th>
                            <th>Categoria</th>
                            <th>Zona</th>
                            <th>Plan</th>
                            <th>Estado</th>
                            <th>Pagado</th>
                            <th>Destacado</th>
                            <th>Verificacion</th>
                            <th></th>
                            {{-- <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anuncios_usuario as $anuncio)
                            <tr>
                                <td>{{ $anuncio->id }}</td>
                                <td>{{ $anuncio->nombre }}</td>
                                <td>{{ $anuncio->tipo }}</td>
                                <td>{{ $anuncio->orientacion }}</td>
                                <td>{{ $anuncio->categoria ? $anuncio->categoria->nombre : 'N/D' }}</td>
                                <td>{{ $anuncio->zone ? $anuncio->zone->nombre : 'N/D' }}</td>
                                <td>{{ $anuncio->plane ? $anuncio->plane->nombre : 'N/D' }}</td>
                                <td>{{ $anuncio->estado }}</td>
                                <td>{{ $anuncio->estado_pago }}</td>
                                <td>{{ $anuncio->destacado }}</td>
                                <td>{{ $anuncio->verificacion }}</td>

                                <td>
                                    
                                    <a class="btn btn-sm btn-warning "
                                        href="{{ route('subir_imagenes', $anuncio) }}"><i class="fa fa-fw  fa-eye"></i>
                                        {{ __('Imágenes') }}
                                    </a>
                                    <a class="btn btn-sm btn-warning " href="{{ route('cargar_video', $anuncio) }}"><i
                                            class="fa fa-fw  fa-eye"></i> {{ __('Video') }}
                                    </a>

                                    @if ($anuncio->estado == 'Borrador' && $anuncio->estado_pago == 'No')
                                        <a class="btn btn-sm btn-success "
                                            href="{{ route('pagar_anuncio', $anuncio) }}"><i
                                                class="fa fa-fw  fa-eye"></i> {{ __('Pagar') }}
                                        </a>
                                    @endif
                                    @if ($anuncio->estado == 'Borrador' && $anuncio->estado_pago == 'Si')
                                        <a class="btn btn-sm btn-success "
                                            href="{{ route('editar_mi_anuncio', $anuncio) }}"><i class="fa fa-fw  fa-eye"></i>
                                            {{ __('Completar/editar') }}
                                        </a>
                                    @endif
                                    @if ($anuncio->estado == 'Borrador' && $anuncio->estado_pago == 'Si')
                                        <a class="btn btn-sm btn-success "
                                            href="{{ route('a_publicar', $anuncio) }}"><i class="fa fa-fw  fa-eye"></i>
                                            {{ __('Publicar') }}
                                        </a>
                                    @endif
                                    <a class="btn btn-sm btn-primary " href="{{route('', [$anuncio->user_id, $anuncio->categoria, $anuncio->provincia, $anuncio->municipio, $anuncio])}}"><i
                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>

                                    @if ($anuncio->estado == 'Publicado')
                                        <a class="btn btn-sm btn-warning "
                                            href="{{ route('pausar_anuncio', $anuncio) }}"><i
                                                class="fa fa-fw  fa-eye"></i> {{ __('Pausar') }}
                                        </a>
                                    @endif
                                    @if ($anuncio->estado == 'Pausado')
                                        <a class="btn btn-sm btn-info "
                                            href="{{ route('reactivar_anuncio', $anuncio) }}"><i
                                                class="fa fa-fw  fa-eye"></i> {{ __('Reactivar') }}
                                        </a>
                                    @endif
                                    @if ($anuncio->se_puede_republicar())
                                        <a class="btn btn-sm btn-success "
                                            href="{{ route('republicar', $anuncio) }}"><i class="fa fa-fw  fa-eye"></i>
                                            {{ __('Republicar') }}
                                        </a>
                                    @endif


                                </td>
                                {{-- <td>
                                    <form action="{{ route('admin.anuncios.destroy', $anuncio) }}" method="POST">


                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>
