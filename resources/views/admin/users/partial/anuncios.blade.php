<div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title"><b>{{ __('Anuncios') }}</b></span>
                        </div>

                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('admin.users.create_anuncio', $user) }}">
                                {{ __('Crear') }}</a>
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
                                        <th>Zone</th>
                                        <th>Plan</th>
                                        <th>Estado</th>
                                        <th>Pago</th>
                                        <th>Destacado</th>
                                        <th>Verificacion</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anuncios as $anuncio)
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
                                                
                                                                       
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('admin.users.edit_anuncio', $anuncio) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>