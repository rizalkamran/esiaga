@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Peran
        </div>
        <div class="card-body">

            @can('is-admin')
                <a class="btn btn-sm btn-primary mb-3" href="{{ route('peran.create') }}" role="button">Create</a>
            @endcan

            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Peran</th>
                            @can('is-admin')
                                <th scope="col">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reffPerans as $reffPeran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $reffPeran->nama_peran }}</td>
                                @can('is-admin')
                                    <td>
                                        <a href="#"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        {{-- <button type="button" class="btn btn-sm btn-danger"
                                            onclick="event.preventDefault();
                                            document.getElementById('delete-user-form-{{ $reffCabor->id }}').submit()">
                                            Delete
                                        </button>
                                        <form id="delete-user-form-{{ $reffCabor->id }}" action="{{ route('cabor.destroy', $reffCabor->id) }}" method="POST" style="display: none">
                                            @csrf
                                            @method("DELETE")
                                        </form> --}}
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $reffPerans->links() }}
        </div>
    </div>

    @include('templates.footer')
@endsection
