<div class="card">
    <div class="card-header">
        <div class="float-left">
            <span class="card-title"><b>{{ __('Pagos') }}</b></span>
        </div>

        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('admin.anuncio.registrar_pago', $anuncio) }}">
                {{ __('Crear') }}</a>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="pagos" class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>User Id</th>
                        <th>Mail Pago</th>
                        <th>Anuncio Id</th>
                        <th>Moneda</th>
                        <th>Precio</th>
                        <th>Moneda Pago</th>
                        <th>Monto Pago</th>
                        <th>Medio Pago</th>
                        <th>Nro Transac</th>
                        <th>Fecha Transac</th>
                        <th>Estado</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $pago)
                        <tr>
                            <td>{{ $pago->id }}</td>

                            <td>
                                @if (is_null($pago->user_id))
                                    'N/D'
                                @else
                                    ({{ $pago->user_id }})
                                    - {{ $pago->user->name }}
                                @endif

                            </td>
                            <td>{{ $pago->mail_pago }}</td>
                            <td>{{ $pago->anuncio_id }}</td>
                            <td>{{ $pago->moneda_precio }}</td>
                            <td>{{ $pago->precio }}</td>
                            <td>{{ $pago->moneda_pago }}</td>
                            <td>{{ $pago->monto_pago }}</td>
                            <td>{{ $pago->medio_pago }}</td>
                            <td>{{ $pago->nro_transac }}</td>
                            <td>
                                @if (is_null($pago->fecha_transac))
                                    'N/D'
                                @else
                                    {{ date('d-m-Y', strtotime($pago->fecha_transac)) }}
                                @endif
                            </td>
                            <td>{{ $pago->estado }}</td>

                            <td>
                                <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST">
                                    <a class="btn btn-sm btn-primary " href="{{ route('pagos.show', $pago->id) }}"><i
                                            class="fa fa-fw fa-eye"></i> Show</a>
                                    <a class="btn btn-sm btn-success" href="{{ route('pagos.edit', $pago->id) }}"><i
                                            class="fa fa-fw fa-edit"></i> Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="fa fa-fw fa-trash"></i>
                                        Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>    
