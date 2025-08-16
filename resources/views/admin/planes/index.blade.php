@extends('adminlte::page')

@section('template_title')
    {{ __('Plane') }}
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Plane') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('planes.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id='planes' class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre</th>
                                        <th>Categoria</th>
                                        <th>Clase</th>
                                        <th>Dias</th>
                                        <th>Precio</th>
                                        <th>Interno</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($planes as $plane)
                                        <tr>
                                            <td>{{ $plane->id }}</td>

                                            <td>{{ $plane->nombre }}</td>

                                            <td>{{ is_null($plane->categoria) ? 'N/D' : $plane->categoria->nombre }}</td>
                                            <td>{{ is_null($plane->clase) ? 'N/D' : $plane->clase->nombre }}</td>
                                            <td>{{ $plane->dias }}</td>
                                            <td>{{ $plane->precio }}</td>
                                            <td>{{ $plane->interno }}</td>
                                            <td>
                                                <form action="{{ route('planes.destroy', $plane) }}" method="POST">
                                                    @can('admin.planes.show')
                                                        <a class="btn btn-sm btn-primary "
                                                            href="{{ route('planes.show', $plane) }}"><i
                                                                class="fa fa-fw fa-eye"></i>{{ __('Show') }}</a>
                                                    @endcan
                                                    @can('admin.planes.edit')
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('planes.edit', $plane) }}"><i
                                                                class="fa fa-fw fa-edit"></i>{{ __('Edit') }} </a>
                                                    @endcan
                                                    @can('admin.planes.destroy')
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm show-alert"><i
                                                                class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                    @endcan
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/sw2alert.js') }}"></script>

 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>


    <script>
        $('#planes').DataTable({
            order: [
                [0, 'desc']
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-AR.json',
                buttons: {
                    copyTitle: 'Copiado al Portapales',
                    copySuccess: {
                        _: '%d Lineas copiadas',
                        1: '1 linea copiada'
                    }
                },

            },
            responsive: true,
            autoWidth: false,
            dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-4'i><'col-sm-4'p>>",
            buttons: [{
                    extend: 'colvis',
                    text: 'Columnas Visibles'
                },
                {
                    extend: 'collection',
                    text: 'Exportar',
                    buttons: [{
                            extend: 'pdfHtml5',
                            title: 'Listado de Planes',
                            exportOptions: {
                                columns: ':visible'
                            }

                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Listado de Planes',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'copy',
                            text: 'Copiar',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        'csv',
                        {
                            extend: 'print',
                            text: 'Imprimir',
                            title: 'Listado de Planes',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                    ]
                }
            ],

        });
    </script> 

@endsection
