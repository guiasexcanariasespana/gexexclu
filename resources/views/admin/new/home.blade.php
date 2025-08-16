@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Bienvenido, {{ Auth::user()->name }}</h1>
            <p class="text-muted">Hoy es <span id="currentDate"></span>. Aquí tienes un resumen de la actividad reciente.</p>
        </div>
        <div class="d-flex">
            <div class="info-box shadow-lg mr-1 ml-1">
                <span class="info-box-icon bg-info" id="timeIcon"><i class="far fa-clock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Hora Actual</span>
                    <span class="info-box-number" id="localTime"></span>
                </div>
            </div>
            <div class="info-box shadow-lg mr-1 ml-1">
                <span class="info-box-icon bg-warning" id="weatherIcon"><i class="far fa-sun"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Temperatura Actual</span>
                    <span class="info-box-number" id="weather"></span>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
    <div class="col-md-8">
    <h5>Vencimientos de Anuncios</h5>
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
            <div class="card card-secondary shadow-lg">
                <div class="card-header">Anuncios a Verificar 
                   
                </div>
                <div class="card-body">
                <style>
                    .table tbody tr td {
                        vertical-align: middle; /* Centrar verticalmente */
                        text-align: center; /* Centrar horizontalmente */
                    }

                    .table thead tr th {
                        vertical-align: middle; /* Centrar verticalmente */
                        text-align: center; /* Centrar horizontalmente */
                    }

                    .table tbody tr td:first-child {
                        text-align: left; /* Mantener la columna "Nombre" alineada a la izquierda */
                    }

                    .table thead tr th:first-child {
                        text-align: left; /* Mantener la columna "Nombre" alineada a la izquierda */
                    }

                    .table tbody tr td:last-child {
                        text-align: right; /* Alinear la columna "Acciones" a la derecha */
                    }
                    .table thead tr th:last-child {
                        text-align: right; /* Alinear la columna "Acciones" a la derecha */
                    }
                </style>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Verificación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anuncios_a_verificar as $anuncio)
                            <tr>
                                <td>{{ $anuncio->nombre }}</td>
                                <td>{{ $anuncio->estado }}</td>
                                <td>{{ $anuncio->verificacion }}</td>
                                <td>
                                    <div class="btn-group">
                                    <form action="{{ route('admin.anuncios.destroy', $anuncio) }}" method="POST">
                                        <a class="btn btn-secondary" href="{{ route('admin.anuncios.show', $anuncio) }}" >
                                            <i class="far fa-eye"></i> Mostrar
                                        </a>
                                        <a type="button" class="btn btn-secondary dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </a>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" href="{{ route('admin.users.edit_anuncio', $anuncio) }}"><i class="far fa-edit text-info"></i> Editar</a>
                                            <div class="dropdown-divider"></div>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item" ><i class="fas fa-trash text-danger"></i> Eliminar</button>
                                        </div>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                {{ $anuncios_a_verificar->appends(['anuncios_a_verificar_page' => request('anuncios_a_verificar_page'), 'anuncios_a_verificar_page' => request('anuncios_a_verificar_page')])->links('pagination::bootstrap-4') }} 
                </div>
                </div>
            </div>
            <div class="card card-primary shadow-lg">
                <div class="card-header">Usuarios a Verificar 
                
                </div>
                <div class="card-body">
                <style>
                    .table tbody tr td {
                        vertical-align: middle; /* Centrar verticalmente */
                        text-align: center; /* Centrar horizontalmente */
                    }

                    .table thead tr th {
                        vertical-align: middle; /* Centrar verticalmente */
                        text-align: center; /* Centrar horizontalmente */
                    }

                    .table tbody tr td:first-child {
                        text-align: left; /* Mantener la columna "Nombre" alineada a la izquierda */
                    }

                    .table thead tr th:first-child {
                        text-align: left; /* Mantener la columna "Nombre" alineada a la izquierda */
                    }

                    .table tbody tr td:last-child {
                        text-align: right; /* Alinear la columna "Acciones" a la derecha */
                    }
                    .table thead tr th:last-child {
                        text-align: right; /* Alinear la columna "Acciones" a la derecha */
                    }
                </style>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($usuarios_a_verificar as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @php
                                        $role = $user->getRoleNames()->first(); // Obtiene el primer rol
                                    @endphp

                                    @if ($role === "Usuario")
                                        <span class="badge badge-success">Usuario</span>
                                    @elseif ($role === "Admin")
                                        <span class="badge badge-secondary">Admin</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-primary mr-1" href="{{ route('admin.users.show', $user) }}">
                                            <i class="far fa-eye"></i> Mostrar
                                        </a>
                                        <a type="button"  class="btn btn-primary dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                         </a>
                                        <div class="dropdown-menu" role="menu">
                                            @can('admin.users.edit')
                                                <a class="dropdown-item" href="{{ route('admin.users.editroles', $user) }}"><i class="fas fa-user-shield text-primary"></i> Roles</a>
                                                <a class="dropdown-item" href="{{ route('admin.users.edit', $user) }}"><i class="far fa-edit text-info"></i> Editar</a>
                                                <a class="dropdown-item" href="{{ route('admin.users.ver_autorizar', $user->id) }}"><i class="fas fa-check-circle text-success"></i> Verificar</a>
                                            @endcan
                                            <div class="dropdown-divider"></div>
                                            @can('admin.users.destroy')
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="dropdown-item"><i class="fas fa-trash text-danger"></i> Eliminar</button>
                                                </form>
                                            @endcan
                                            
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                {{ $usuarios_a_verificar->appends(['usuarios_a_verificar_page' => request('usuarios_a_verificar_page'), 'usuarios_a_verificar_page' => request('usuarios_a_verificar_page')])->links('pagination::bootstrap-4') }} 
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="card card-info shadow-lg">
            <div class="card-header">
              <h3 class="card-title">Anuncios por Vencer 
             
              </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Vence</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($anuncios_vencen as $anuncio)
                  <tr>
                    <td>{{ $anuncio->nombre }}</td>
                    <td>{{ $anuncio->tipo }}</td>
                    <td>
                        @php
                            $hoy = \Carbon\Carbon::now()->toDateString(); // Fecha de hoy en formato Y-m-d
                            $diferencia = \Carbon\Carbon::parse($anuncio->fecha_caducidad)->diffInDays($hoy);
                        @endphp

                        @if ($anuncio->fecha_caducidad == $hoy)
                            <span class="badge badge-danger">Vence hoy</span>
                        @elseif ($diferencia == 1)
                            <span class="badge badge-warning"> Mañana</span>
                        @elseif ($diferencia == 2)
                            <span class="badge badge-info">en 48 horas</span>
                        @elseif ($diferencia == 3)
                            <span class="badge badge-info">en 72 horas</span>
                        @endif


                    </td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="{{ route('admin.anuncios.show', $anuncio) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="d-flex justify-content-center">
              {{ $anuncios_vencen->appends(['anuncios_vencen_page' => request('anuncios_vencen_page'), 'anuncios_vencen_page' => request('anuncios_vencen_page')])->links('pagination::bootstrap-5') }} 

            </div>
            </div>
            <!-- /.card-body -->
            </div>
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
        function updateTime() {
            const options = { timeZone: 'Europe/Madrid', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            document.getElementById('localTime').innerText = new Intl.DateTimeFormat('es-ES', options).format(new Date());
        }
        setInterval(updateTime, 1000);
        document.getElementById('currentDate').innerText = new Date().toLocaleDateString('es-ES', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        // Obtener pronóstico del tiempo
        fetch('https://api.open-meteo.com/v1/forecast?latitude=28.4682&longitude=-16.2546&current=temperature_2m,weathercode&forecast_days=1')
            .then(response => response.json())
            .then(data => {
                document.getElementById('weather').innerText = data.current.temperature_2m + '°C';
                
                let weatherCode = data.current.weathercode;
                let iconClass = "far fa-sun";
                if (weatherCode >= 3 && weatherCode <= 4) iconClass = "far fa-cloud";
                else if (weatherCode >= 5 && weatherCode <= 7) iconClass = "fas fa-cloud-rain";
                else if (weatherCode >= 8) iconClass = "fas fa-snowflake";
                
                document.getElementById('weatherIcon').innerHTML = `<i class="${iconClass}"></i>`;
            })
            .catch(error => console.error('Error obteniendo el pronóstico:', error));
    </script>
@stop
