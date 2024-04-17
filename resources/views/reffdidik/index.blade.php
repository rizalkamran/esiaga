@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Tingkat Pendidikan
        </div>
        <div class="card-body">
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Pendidikan</th>
                            @can('is-admin')
                                <th scope="col">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reffdidik  as $index => $reff)
                            <tr>
                                <td>{{ $reff->id }}</td>
                                <td>{{ $reff->nama_pendidikan }}</td>
                                @can('is-admin')
                                    <td>
                                        <a href="#"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" disabled
                                            onclick="event.preventDefault();
                                            document.getElementById('delete-user-form-{{ $reff->id }}').submit()">
                                            Delete
                                        </button>
                                        <form id="delete-user-form-{{ $reff->id }}" action="{{ route('reffdidik.destroy', $reff->id) }}" method="POST" style="display: none">
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

            {{ $reffdidik->links() }}

            <div>
                <div class="row">
                    <div class="col">
                        <p class="btn btn-sm btn-secondary">Total Data: {{ $reffdidik->total() }}</p>
                    </div>
                    <div class="col">
                        <div class="float-end">
                            <p class="btn btn-sm btn-secondary">Data/Page: {{ $reffdidik->count() }} / {{ $reffdidik->currentPage() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('templates.footer')
@endsection
