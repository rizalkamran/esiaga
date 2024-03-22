@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Provinsi
        </div>
        <div class="card-body">
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nomor</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Provinsi</th>
                            @can('is-admin')
                                <th scope="col">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reffProvinsi  as $index => $Provinsi)
                            <tr>
                                <td>{{ $index + $reffProvinsi->firstItem() }}</td>
                                <td>{{ $Provinsi->id }}</td>
                                <td>{{ $Provinsi->nama_provinsi }}</td>
                                @can('is-admin')
                                    <td>
                                        <a href="{{ route('data-provinsi.edit', $Provinsi->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" disabled
                                            onclick="event.preventDefault();
                                            document.getElementById('delete-user-form-{{ $Provinsi->id }}').submit()">
                                            Delete
                                        </button>
                                        <form id="delete-user-form-{{ $Provinsi->id }}" action="{{ route('data-provinsi.destroy', $Provinsi->id) }}" method="POST" style="display: none">
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

            {{ $reffProvinsi->links() }}

            <div>
                <div class="row">
                    <div class="col">
                        <p class="btn btn-sm btn-secondary">Total Data: {{ $reffProvinsi->total() }}</p>
                    </div>
                    <div class="col">
                        <div class="float-end">
                            <p class="btn btn-sm btn-secondary">Data/Page: {{ $reffProvinsi->count() }} / {{ $reffProvinsi->currentPage() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('templates.footer')
@endsection
