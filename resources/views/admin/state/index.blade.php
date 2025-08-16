@extends('adminlte::page')

@section('template_title')
    {{ $state->name ?? 'Show State' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('State') }}
                            </span>

                            <div class="float-right">
                                @can('admin.states.create')
                                    <a href="{{ route('states.create') }}" class="btn btn-primary btn-sm float-right"
                                        data-placement="left">
                                        {{ __('Create New') }}
                                    </a>
                                @endcan
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Name</th>
                                        <th>Slug</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($states as $state)
                                        <tr>
                                            <td>{{ $state->id }}</td>

                                            <td>{{ $state->name }}</td>
                                            <td>{{ $state->slug }}</td>

                                            <td>
                                                <form id="submitForm" action="{{ route('states.destroy', $state) }}"
                                                    method="POST">
                                                    @can('admin.states.show')
                                                        <a class="btn btn-sm btn-primary "
                                                            href="{{ route('states.show', $state) }}"><i
                                                                class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    @endcan
                                                    @can('admin.states.edit')
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('states.edit', $state) }}"><i
                                                                class="fa fa-fw fa-edit"></i>{{ __('Edit') }} </a>
                                                    @endcan
                                                    @can('admin.states.destroy')
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" onclick="archiveFunction()"
                                                            class="btn btn-danger btn-sm show-alert"><i
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
                {!! $states->links() !!}
            </div>
        </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/sw2alert.js') }}"></script>
@endsection
