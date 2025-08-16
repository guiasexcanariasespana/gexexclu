@extends('adminlte::page')

@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-outline card-warning collapsed-card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3>{{ count($anuncios_a_verificar) }}</h3>
                            <span id="card_title">
                                {{ __('Anuncios') }} Por Verificar
                            </span>
                            <div class="float-right">
                                <div class="card-tools">
                                    <!-- Collapse Button -->
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-plus"></i></button>
                                </div>

                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        @include('admin.home.partial.lista_a_verificar')
                    </div>
                </div>

            </div>
            <div class="col-sm-12">
                <div class="card card-outline card-danger collapsed-card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3>{{ count($anuncios_vencen) }}</h3>
                            <span id="card_title">
                                {{ __('Anuncios') }} Por vencer
                            </span>

                            <div class="float-right">
                                <div class="card-tools">
                                    <!-- Collapse Button -->
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        @include('admin.home.partial.lista_vencen')

                    </div>
                </div>

            </div>

            <div class="col-sm-12">
                <div class="card card-outline card-info collapsed-card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3>{{ count($usuarios_a_verificar) }}</h3>
                            <span id="card_title">
                                {{ __('Perfiles') }} Por Verificar
                            </span>

                            <div class="float-right">
                                <div class="card-tools">
                                    <!-- Collapse Button -->
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        @include('admin.home.partial.lista_perfiles_verificar')
                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection
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
