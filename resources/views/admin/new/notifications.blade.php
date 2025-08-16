@extends('adminlte::page')

@section('title', 'Notificaciones SMS')

@section('content_header')
    <h1>Notificaciones SMS</h1>
@stop

@section('content')
<p class="d-flex justify-content-between">
    <span>Bienvenido al Panel de Notificación SMS 2.0.</span>
    
</p>


   <!-- Widgets de estadísticas -->
<div class="row">
    <!-- Columna de estadísticas (col-md-6) -->
    <div class="col-md-6">
        <div class="row">
            <!-- Mensajes Enviados -->
            <div class="col-md-6 col-sm-6 col-6">
                <div class="info-box shadow">
                    <span class="info-box-icon bg-info">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Mensajes Enviados</span>
                        <span class="info-box-number" id="sentMessages">{{ $totalEnviados }}</span>
                    </div>
                </div>
            </div>

            <!-- Mensajes Rechazados -->
            <div class="col-md-6 col-sm-6 col-6">
                <div class="info-box shadow">
                    <span class="info-box-icon bg-danger">
                        <i class="fas fa-times"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Mensajes Rechazados</span>
                        <span class="info-box-number" id="rejectedMessages">{{ $totalErrores }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Columna para los botones (col-md-6) -->
    <div class="col-md-6 text-right mb-5">
        <!-- Botón para Configurar API Key -->
        <button class="btn btn-info mr-2" data-toggle="modal" data-target="#configModal">
            <i class="fas fa-key"></i> Configurar API Key
        </button>

        <!-- Botón para Configuración General -->
        <button class="btn btn-secondary" data-toggle="modal" data-target="#configGeneralModal">
            <i class="fas fa-cogs"></i> Configuración General
        </button>

    </div>
</div>


    <!-- Tabla de Notificaciones SMS -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Notificaciones SMS</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        
                        <th>Usuario</th>
                        <th>Mensaje</th>
                        <th class="text-center">Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                
                    @foreach($smsnotifications as $smsnotification)
                        <tr>
                            <td>
                            <div class="user-block">
                            @if (!empty($smsnotification->user->imagen_verificacion))
                                <img class="img-circle img-bordered-sm" src="{{ '/images/perfil/' . $smsnotification->user->id . '/' . $smsnotification->user->imagen_verificacion }}" alt="User Image">
                            @else
                            <img class="img-circle img-bordered-sm" src="https://www.guiasexcanarias.com/img/avatar-user.gif" alt="User Image">
                            @endif

                                
                                <span class="username">
                                @php
                                    $user = optional($smsnotification->user);
                                @endphp

                                @if ($user->exists)
                                    <a href="https://www.guiasexcanarias.com/bielsa22admin/users/{{ $user->id }}">{{ $user->name }}</a>
                                @else
                                    <span class="text-muted">Usuario no disponible</span>
                                @endif

                                </span>
                                <span class="description">
                                 Email: 
                                 
                                 @if (is_null(optional($smsnotification->user)->email_verified_at))
                                    <span class="text-secondary">Pendiente</span>
                                @else
                                    <span class="text-success">Verificado</span>
                                @endif

                                </span>
                            </div>
                                
                            </td>
                            
                            <td>
                            {{ Str::limit($smsnotification->mensaje, 50) }}

                            @php
                                $mensaje = strtolower($smsnotification->mensaje);
                            @endphp

                            @if(Str::contains($mensaje, 'hoy'))
                                <br><span class="badge bg-warning">Notificación de Vencimiento: Hoy</span>
                            @elseif(Str::contains($mensaje, '48'))
                                <br><span class="badge bg-info">Notificación de Vencimiento: 48 Horas</span>
                            @endif

                           
                            </td>

                            <td class="text-center" >
                            @if($smsnotification->respuesta == 'ok')
                                    <span class="badge bg-success">Enviado</span>
                                @elseif($smsnotification->respuesta == 'error')
                                    <span class="badge bg-danger">Error al Enviar</span>
                                @else
                                    <span class="badge bg-secondary">Pendiente</span>
                                @endif <br>
                                <div class="user-block text-center mt-1">
                                    <span class="description"><i class="far fa-clock"></i> {{ $smsnotification->created_at->diffForHumans() }}                                    </span>
                                </div>
                               
                            </td>
                            <td>
                            <button class="btn btn-info"
                                data-toggle="modal"
                                data-target="#editModal"
                                data-estado="{{ $smsnotification->respuesta }}"
                                data-user="{{ optional($smsnotification->user)->name ?? 'Usuario no disponible' }}"
                                data-mensaje="{{ $smsnotification->mensaje }}"
                                data-fecha="{{ optional($smsnotification->created_at)->diffForHumans() ?? 'Fecha no disponible' }}">
                                Ver Detalles
                            </button>



                            </td>

                        </tr>
                    @endforeach

                   
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center">
    {{ $smsnotifications->links('pagination::bootstrap-5') }}

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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Detalles de Notificación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Estado:</strong> <span id="estado"></span></p>
                <p><strong>Usuario:</strong> <span id="user"></span></p>
                <p><strong>Mensaje Enviado:</strong></p>
                <p id="mensaje" class="border p-2"></p>
                <p><strong>Enviado:</strong> <span id="fecha"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

   <!-- Modal para Configuración General -->
<div class="modal fade" id="configGeneralModal" tabindex="-1" role="dialog" aria-labelledby="configGeneralModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="configGeneralModalLabel">Configuración de Notificaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para actualizar los textos -->
                <form id="configGeneralForm" method="POST" action="{{ route('updateTexts') }}">
                    @csrf
                    <small class="text-muted">Posterior al mensaje que configures se enviara automaticamente el Concepto con el Nombre del Usuario y Numero de Telefono</small>
                    <hr>
                    <div class="form-group mt-1">
                        <label for="text_48h">Mensaje - 48 Horas antes</label>
                        <textarea class="form-control" id="text_48h" name="text_48h" rows="2">{{ env('TEXT_48H') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="text_24h">Mensaje - Dia del Vencimiento</label>
                        <textarea class="form-control" id="text_24h" name="text_24h" rows="2">{{ env('TEXT_24H') }}</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" form="configGeneralForm" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

   <!-- Modal para configurar API Key -->
<div class="modal fade" id="configModal" tabindex="-1" role="dialog" aria-labelledby="configModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="configModalLabel">Configuración de API Key</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <!-- Estado de conexión a la API -->
                <div class="d-flex align-items-center justify-content-between">
                    <label><strong>Conexión a SMSPubli:</strong></label>
                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate {{ $statusResult === 'ok' ? 'bootstrap-switch-on' : 'bootstrap-switch-off' }}" style="width: 86px;">
                    <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">
                        <span class="bootstrap-switch-handle-on bootstrap-switch-success" style="width: 42px;">ON</span>
                        <span class="bootstrap-switch-label" style="width: 42px;">&nbsp;</span>
                        <span class="bootstrap-switch-handle-off bootstrap-switch-danger" style="width: 42px;">OFF</span>
                        <input type="checkbox" name="api-connection" data-bootstrap-switch="" data-off-color="danger" data-on-color="success" {{ $statusResult === 'ok' ? 'checked' : 'disabled' }}>
                    </div>
                </div>

                </div>

                <hr> <!-- Separador -->

                <!-- API Key Actual -->
                <div class="mb-3">
                    <label><strong>API Key Actual:</strong></label>
                    <input type="text" class="form-control" value="****************{{ substr(env('SMS_API_KEY'), -4) }}" readonly>
                    <small class="text-muted">Por seguridad, solo se muestran los últimos 4 caracteres.</small>
                </div>

                <hr> <!-- Separador -->

                <!-- Actualizar API Key -->
                <h6 class="text-primary">Actualizar API Key</h6>
                <div class="form-group">
                    <label for="newApiKey">Nueva API Key</label>
                    <input type="text" class="form-control" id="newApiKey" placeholder="Introduce la nueva API Key">
                    <small class="text-danger">
                        <i class="fas fa-exclamation-triangle"></i> La modificación de la API Key es irreversible. Asegúrate de ingresar la clave correcta.
                    </small>
                </div>
                
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            Swal.fire({
                title: "Éxito!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "Aceptar"
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif
    });
</script>
<script>
    $('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var estado = button.data('estado');
    var user = button.data('user');
    var mensaje = button.data('mensaje');
    var fecha = button.data('fecha');

    var estadoSpan = estado === 'ok' 
        ? '<span class="badge bg-success">Enviado</span>' 
        : '<span class="badge bg-danger">Error</span>';

    var modal = $(this);
    modal.find('#estado').html(estadoSpan);
    modal.find('#user').text(user);
    modal.find('#mensaje').text(mensaje);
    modal.find('#fecha').text(fecha);
});

</script>
@stop
