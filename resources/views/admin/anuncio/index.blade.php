@extends('adminlte::page')

@section('template_title')
    Anuncio
@endsection
@section('content_header')
    <h1>Lista de Anuncios</h1>
@stop

@section('css')
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    {{-- <div class="card">
        <div class="card-header">
                      
        </div>
 
        <div class="card-body">
            <table id='anuncios' class="table table-striped">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Fec. Publ.</th>
                        <th>Usuario</th>
                        <th>Clase</th>
                        <th>Nombre</th>

                        <th>Categoria</th>
                        <th>Zona</th>
                        <th>Plan</th>
                         <th>Estado</th>
                        
                          <th>Verificado</th>
                        <th> Acciones</th>
                    </tr>
                </thead>
                 <tbody>
                    @foreach ($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ date('d-m-Y', strtotime($pedido->fecha_at)) }}</td>
                            <td></td>
                            <td>{{ $pedido->cantidad_productos() }}</td>
                            <td>{{ $pedido->total() }}</td>
                            <td>{{ $pedido->estado_str() }}</td>
                            <td width="10px"><a class="btn btn-info btn-sm" href="">Mostrar</a></td>
                            <td width="10px"><a class="btn btn-danger btn-sm" href="">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody> 
            </table>
        </div>
        if ($anuncio->estado == 'Finalizado') {
                            $color = '#FABFBD'; //FBD3B6 FABFBD
                        } else {
                            //verifico si está a menos de 3 días para vencer
                            if (!is_null($anuncio->fecha_caducidad)) {
                                if ($anuncio->fecha_caducidad < $hoy) {
                                    $color = '#FE362F';
                                } else {
                                    if ($anuncio->fecha_caducidad <= $tres_dias) {
                                        $color = '#FBD3B6';
                                    }
                                }
      
    </div> --}}

    <p style="background-color:#FABFBD ; display: inline-block"> # Finalizado  </p> <p style="background-color: #FE362F; display: inline-block"> # Publicado con fecha finalizada  </p> <p style="background-color: #FBD3B6; display: inline-block"> # Vencen en menos de 72hrs </p>
   @livewire('anuncios-list-component')
<script>
    Livewire.on('alert', function(){
       // alert('Hola');
        //$('#modalDel').modal('show');
    });
</script>

@stop

{{-- @section('js')
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
       $('#anuncios').DataTable({language: {
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
            ajax: "{{route('datatable.anuncio')}}",
            columns: [
                {data:'id'},                
                {data: 'fecha_de_publicacion'},
                {data: 'user'},                
                {data: 'clase'},
                {data: 'nombre'},
              //  {data: 'tipo'},
              //  {data: 'orientacion'},
                {data: 'categoria'},
                {data: 'zona'},
                {data: 'plan'},
                {data: 'estado'},
              //  {data: 'destacado'},
                {data: 'verificacion'},
                 {data: 'action'},
                
            ],
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
            buttons: 
                [{
                            extend: 'pdfHtml5',
                            title: 'Listado de Anuncios',
                            exportOptions: {
                                columns: ':visible'
                            }
 
                        },
                         {
                            extend: 'excelHtml5',
                            title: 'Listado de Anuncios',
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
                            title: 'Listado de Anuncios',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

        ]}],
            


        });
   </script> 
@endsection --}}