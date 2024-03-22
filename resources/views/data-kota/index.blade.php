@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Kota/Kabupaten
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('data-kota.index') }}" method="GET"> <!-- Form for reset filter -->
                        <button type="submit" class="btn btn-sm btn-secondary">Reset</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="float-end">
                        <form action="{{ route('data-kota.index') }}" method="GET" class="flex-grow-1"> <!-- flex-grow-1 to expand the form -->
                            <div class="input-group">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by Provinsi..." value="{{ request()->query('search') }}">
                                <button type="submit" class="btn btn-sm btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- <div class="d-flex justify-content-between mb-3"> <!-- Flexbox for alignment -->
                <form action="{{ route('data-kota.index') }}" method="GET" class="flex-grow-1"> <!-- flex-grow-1 to expand the form -->
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by Provinsi..." value="{{ request()->query('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                <form action="{{ route('data-kota.index') }}" method="GET"> <!-- Form for reset filter -->
                    <button type="submit" class="btn btn-secondary">Reset</button>
                </form>
            </div> --}}

            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nomor</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Kota/Kabupaten</th>
                            <th scope="col">Provinsi</th>
                            @can('is-admin')
                                <th scope="col">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reffKota as $index => $Kota)
                            <tr>
                                <td>{{ $index + $reffKota->firstItem() }}</td>
                                <td>{{ $Kota->id }}</td>
                                <td>{{ $Kota->nama_kota }}</td>
                                <td>{{ $Kota->provinsi->nama_provinsi }}</td>
                                @can('is-admin')
                                    <td>
                                        <a href="{{ route('data-kota.edit', $Kota->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('delete-user-form-{{ $Kota->id }}').submit()" disabled>Delete</button>
                                        <form id="delete-user-form-{{ $Kota->id }}" action="{{ route('data-kota.destroy', $Kota->id) }}" method="POST" style="display: none">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $reffKota->appends(['search' => $searchQuery])->links() }}

            <div>
                <div class="row">
                    {{-- <div class="col">
                        <p class="btn btn-sm btn-secondary">Total Data: {{ $reffKota->total() }}</p>
                    </div> --}}
                    <div class="col">
                        <div class="float-start">
                            <p class="btn btn-sm btn-secondary">Data/Page: {{ $reffKota->count() }} / {{ $reffKota->currentPage() }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('templates.footer')
@endsection
