@extends('adminlte::page')

@section('template_title')
    {{ $nota->name ?? 'Show Nota' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Nota</span>

                        </div>
                        <div class="float-right">
                            @if (is_null($nota->anuncio_id))
                                <a class="btn btn-primary" href="{{ route('admin.users.show', $nota->user) }}">
                                    {{ __('Back') }}</a>
                            @else
                                <a class="btn btn-primary" href="{{ route('admin.users.edit_anuncio', $nota->anuncio) }}">
                                    {{ __('Back') }}</a>
                            @endif

                        </div>
                    </div>

                    <div class="card-body">


                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $nota->created_at->format('d-m-Y H:i:s') }}
                            


                        </div>
                        <div class="form-group">
                            @if (is_null($nota->anuncio_id))
                                <strong>Usuario:</strong>
                                ({{ $nota->user_id }} ) {{ $nota->user->name }}
                            @else
                                <strong>Anuncio Id:</strong>
                                {{ $nota->anuncio_id }}
                            @endif


                        </div>

                        <div class="form-group">
                            <strong>Nota:</strong>
                            {{ $nota->nota }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
