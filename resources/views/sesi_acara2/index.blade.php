@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Sesi Kejuaraan
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    @can('is-admin')
                        <a class="btn btn-sm btn-primary mb-3" href="{{ route('sesi_acara2.create') }}" role="button">Create</a>
                    @endcan
                    <a class="btn btn-sm btn-secondary mb-3" href="{{ route('sesi_acara2.index') }}">Reset</a>
                </div>
                <div class="col-md-6">
                    <div class="float-end">
                        <form action="{{ route('sesi_acara2.index') }}" method="GET" class="flex-grow-1">
                            <div class="input-group">
                                <select name="acara_id" class="form-control form-control-sm">
                                    <option value="">Pilih Kejuaraan</option>
                                    @foreach($acaraList as $acara)
                                        <option value="{{ $acara->id }}" {{ request()->query('acara_id') == $acara->id ? 'selected' : '' }}>
                                            {{ $acara->nama_acara }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
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
                            <th scope="col">Nama Kejuaraan</th>
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
