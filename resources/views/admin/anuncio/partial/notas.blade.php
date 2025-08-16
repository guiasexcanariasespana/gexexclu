<div class="card">
    <div class="card-header">
        <div class="float-left">
            <span class="card-title"><b>{{ __('Notas') }}</b></span>
        </div>

        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('admin.anuncio.notas.anunciocreate', $anuncio) }}">
                {{ __('Crear') }}</a>
        </div>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="notas" class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Fecha</th>
                        <th>Titulo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notas as $nota)
                        <tr>
                            <td>{{ $nota->id }}</td>
                            <td>{{ $nota->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $nota->titulo }}</td>
                            <td>
                                <form action="{{ route('admin.notas.delete', $nota) }}" method="POST">
                                    <a class="btn btn-sm btn-primary " href="{{ route('admin.notas.show', $nota) }}"><i
                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                    <a class="btn btn-sm btn-success" href="{{ route('admin.nota.edit', $nota) }}"><i
                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
