@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Cabang Olahraga
        </div>
        <div class="card-body">
            @can('is-admin')
                <div class="row">
                    <div class="col">
                        <a class="btn btn-sm btn-primary mb-3" href="{{ route('cabor.create') }}" role="button">Create</a>
                        <a class="btn btn-sm btn-secondary mb-3" href="{{ route('cabor.index') }}">Reset</a>
                    </div>
                    <div class="col">
                        <form action="{{ route('cabor.index') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-sm" placeholder="Search..." name="search" value="{{ request('search') }}">
                                <button class="btn btn-sm btn-primary" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endcan
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Deskripsi</th>
                            @can('is-admin')
                                <th scope="col">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reffCabors  as $index => $reffCabor)
                            <tr>
                                <td>{{ $index + $reffCabors->firstItem() }}</td>
                                <td>{{ $reffCabor->nama_cabor }}</td>
                                <td>{{ $reffCabor->deskripsi_cabor }}</td>
                                @can('is-admin')
                                    <td>
                                        <a href="{{ route('cabor.edit', $reffCabor->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="event.preventDefault();
                                            document.getElementById('delete-user-form-{{ $reffCabor->id }}').submit()">
                                            Delete
                                        </button>
                                        <form id="delete-user-form-{{ $reffCabor->id }}" action="{{ route('cabor.destroy', $reffCabor->id) }}" method="POST" style="display: none">
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

            {{ $reffCabors->links() }}
        </div>
    </div>

    @include('templates.footer')
@endsection
