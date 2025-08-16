@extends('adminlte::page')

@section('template_title')
    {{ $user->name ?? 'Crear nota' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Nota</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.users.notas.userstore', $user) }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('admin.nota.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
