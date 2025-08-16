@extends('adminlte::page')

@section('title', 'Anuncios')

@section('content_header')

<!-- Mostrar mensaje de error -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Mostrar mensaje de éxito -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <!-- Título alineado a la izquierda -->
    <h1 class="m-0">Administracion de Anuncios</h1>

    <!-- Contenedor de botones alineados a la derecha -->
    <div>
        <a href="https://canariasexclusiva.com/nob1903/rosarioadmin/users/create" class="btn btn-primary mr-2">
            <i class="fas fa-user-plus"></i> Crear Usuario
        </a>

        <a href="https://canariasexclusiva.com/nob1903/rosarioadmin/roles" class="btn btn-secondary mr-2">
            <i class="fas fa-users-cog"></i> Administrar Roles
        </a>

        
    </div>
</div>

@stop

@section('content')
<div class="row">
<div class="col-6 col-sm-3">
                  <div class="info-box bg-light shadow-lg">
                    <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">Vencimiento</span>
                      <span class="info-box-number text-center text-muted mb-0"><span class="badge badge-danger">Hoy</span> : {{ $hoycount }}</span>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-sm-3">
                  <div class="info-box bg-light shadow-lg">
                    <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">Vencimiento</span>

                      <span class="info-box-number text-center text-muted mb-0"><span class="badge badge-warning">Mañana</span> : {{ $en24horascount }}</span>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-sm-3">
                  <div class="info-box bg-light shadow-lg">
                    <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">Vencimiento</span>

                      <span class="info-box-number text-center text-muted mb-0"><span class="badge badge-info">En 48 Horas</span> : {{ $en48horascount }}</span>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-sm-3">
                  <div class="info-box bg-light shadow-lg">
                    <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">Vencimiento</span>

                      <span class="info-box-number text-center text-muted mb-0"><span class="badge badge-secondary">En 72 Horas</span> : {{ $en72horascount }}</span>
                    </div>
                  </div>
                </div>
              </div>
              </div>
<div class="card m-2 p-2">
    <div class="card-header mb-3">
        <h3 class="card-title">Listado de Anuncios</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped" id="anunciosTable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Clase</th>
                    <th>Categoria</th>
                    <th>Zona</th>
                    <th>Plan</th>
                    <th>Estado</th>
                    <th>Vencimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($anuncios as $anuncio)
                @php
                    $rowColors = [
                        'Publicado' => 'background-color: #d4edda;', // Verde claro
                        'Finalizado' => 'background-color: #f8d7da;', // Rojo claro
                        'Pausado' => 'background-color: #e2e3e5;', // Gris claro
                        'Suspendido' => 'background-color: #fff3cd;', // Amarillo claro
                    ];
                    $rowStyle = $rowColors[$anuncio->estado] ?? '';
                @endphp

                <tr style="{{ $rowStyle }}">
                    <td @if ($anuncio->user) title="{{ $anuncio->user->name }} - {{ $anuncio->user->email }}" @endif>
                        {{ $anuncio->nombre }}
                    </td>
                    <td>{{ $anuncio->clase ? $anuncio->clase->nombre : 'N/D' }}</td>
                    <td>{{ $anuncio->categoria ? $anuncio->categoria->nombre : 'N/D' }}</td>
                    <td>{{ Str::limit($anuncio->localidad, 15) }}</td>
                    <td>{{ $anuncio->plane ? $anuncio->plane->nombre : 'N/D' }}</td>
                    <td class="text-center">
                        @php
                            $colores = [
                                'Publicado' => 'success',
                                'Finalizado' => 'danger',
                                'Pausado' => 'secondary',
                                'Suspendido' => 'warning',
                            ];
                            $color = $colores[$anuncio->estado] ?? 'primary';
                        @endphp
                        <span class="badge bg-{{ $color }}">{{ $anuncio->estado }}</span>
                    </td>
                    <td>
                        @php
                            $fechaCaducidad = \Carbon\Carbon::parse($anuncio->fecha_caducidad);
                            $hoy = \Carbon\Carbon::today();

                            if ($fechaCaducidad->isToday()) {
                                $color = 'primary'; // Hoy
                            } elseif ($fechaCaducidad->isFuture() && $fechaCaducidad->diffInDays($hoy) <= 15) {
                                $color = 'warning'; // Entre mañana y 15 días
                            } elseif ($fechaCaducidad->isFuture()) {
                                $color = 'success'; // Aún no vence
                            } else {
                                $color = 'danger'; // Ya venció
                            }
                        @endphp
                        <span class="badge bg-{{ $color }}">{{ $fechaCaducidad->diffForHumans() }}</span>
                    </td>
                    <td>
                        @can('admin.users.show')
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.users.edit_anuncio', $anuncio) }}">
                                <i class="fa fa-fw fa-eye"></i> Ver Anuncio
                            </a>
                        @endcan
                        
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@section('css')
<style>
    .content-wrapper {
        background: #f4f6f9 !important;
    }
</style>
@stop


@section('js')
<script>
    $(document).ready(function() {
        // Definir un orden personalizado para la columna de "Estado"
        $.fn.dataTable.ext.type.order['estado-pre'] = function(d) {
            var order = {
                'Publicado': 1,
                'Pausado': 2,
                'Suspendido': 3,
                'Finalizado': 4
            };
            return order[d] || 5; // Si no está en la lista, poner al final
        };

        $('#anunciosTable').DataTable({
            responsive: true,
            autoWidth: false,
            ordering: true, // Habilita la ordenación
            columnDefs: [
                { type: 'estado', targets: 5 } // Aplica la ordenación a la columna de "Estado" (índice 5)
            ],
            order: [[5, 'asc']], // Ordenar por la columna "Estado" en el orden definido
            language: {
                url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
            }
        });
    });
</script>
@stop

