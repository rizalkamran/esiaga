@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Data Kategori
    </div>
    <div class="card-body">
        @can('is-admin')
            <div class="row">
                <div class="col">
                    <a class="btn btn-sm btn-primary mb-3" href="{{ route('kategori.create') }}" role="button">Create</a>
                    <a class="btn btn-sm btn-secondary mb-3" href="{{ route('kategori.index') }}">Reset</a>
                </div>
                <div class="col">
                    <form action="{{ route('kategori.index') }}" method="GET">
                        <div class="input-group mb-3">
                            <select class="form-select form-select-sm" name="acara_id">
                                @foreach($acara as $a)
                                    <option value="{{ $a->id }}" {{ request('acara_id', $activeAcara->id ?? '') == $a->id ? 'selected' : '' }}>{{ $a->nama_acara }}</option>
                                @endforeach
                            </select>
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
                        <th scope="col">No</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Deskripsi</th>
                        @can('is-admin')
                            <th scope="col">Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $index => $kat)
                        <tr>
                            <td>{{ $index + $kategori->firstItem() }}</td>
                            <td>{{ $kat->nama_kategori }}</td>
                            <td>{{ $kat->desk_tambahan }}</td>
                            @can('is-admin')
                                <td>
                                    <a href="{{ route('kategori.edit', $kat->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" disabled onclick="event.preventDefault(); document.getElementById('delete-user-form-{{ $kat->id }}').submit()">Delete</button>
                                    <form id="delete-user-form-{{ $kat->id }}" action="{{ route('kategori.destroy', $kat->id) }}" method="POST" style="display: none">
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

        {{ $kategori->appends(request()->query())->links() }}

        <div>
            <div class="row">
                {{-- <div class="col">
                    <p class="btn btn-sm btn-secondary">Total Data: {{ $reffCabors->total() }}</p>
                </div> --}}
                <div class="col">
                    <div class="float-start">
                        <p class="btn btn-sm btn-secondary">Data/Page: {{ $kategori->count() }} / {{ $kategori->currentPage() }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('templates.footer')
@endsection
