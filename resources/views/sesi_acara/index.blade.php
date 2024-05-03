@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Sesi Acara
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    @can('is-admin')
                        <a class="btn btn-sm btn-primary mb-3" href="{{ route('sesi_acara.create') }}" role="button">Create</a>
                    @endcan
                    <a class="btn btn-sm btn-secondary mb-3" href="{{ route('sesi_acara.index') }}">Reset</a>
                    {{-- <form action="#" method="GET"> <!-- Form for reset filter -->
                        <button type="submit" class="btn btn-sm btn-secondary">Reset</button>
                    </form> --}}
                </div>
                <div class="col-md-6">
                    <div class="float-end">
                        <form action="{{ route('sesi_acara.index') }}" method="GET" class="flex-grow-1">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari..." value="{{ request()->query('search') }}">
                                <button type="submit" class="btn btn-sm btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nomor</th>
                            <th scope="col">Nama Acara</th>
                            <th scope="col">Nama Sesi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sesi as $index => $s)
                            <tr>
                                <td>{{ $index + $sesi->firstItem() }}</td>
                                <td>{{ $s->acara->nama_acara }}</td>
                                <td>{{ $s->sesi }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $sesi->appends(['search' => request()->query('search')])->links() }}
        </div>
    </div>

    @include('templates.footer')
@endsection
