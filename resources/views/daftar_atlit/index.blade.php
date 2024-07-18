@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Daftar Atlit
    </div>
    <div class="card-body">
        @can('is-admin')
            <div class="row">
                <div class="col">
                    <a class="btn btn-sm btn-primary mb-3" href="{{ route('daftar_atlit.create') }}" role="button">Create</a>
                    <a class="btn btn-sm btn-secondary mb-3" href="{{ route('daftar_atlit.index') }}">Reset</a>
                </div>
                <div class="col">
                    <form action="{{ route('daftar_atlit.index') }}" method="GET">
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
                        <th scope="col">Nama</th>
                        <th scope="col">Kategori</th>
                        @can('is-admin')
                            <th scope="col">Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftaratlit as $index => $daftar)
                        <tr>
                            <td>{{ $index + $daftaratlit->firstItem() }}</td>
                            <td>{{ $daftar->user->nama_lengkap }}</td>
                            <td>{{ $daftar->kategori->nama_kategori }} {{ $daftar->kategori->desk_tambahan }}</td>
                            @can('is-admin')
                                <td>
                                    <a href="{{ route('daftar_atlit.edit', $daftar->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" disabled onclick="event.preventDefault(); document.getElementById('delete-user-form-{{ $daftar->id }}').submit()">Delete</button>
                                    <form id="delete-user-form-{{ $daftar->id }}" action="{{ route('daftar_atlit.destroy', $daftar->id) }}" method="POST" style="display: none">
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

        {{ $daftaratlit->appends(request()->query())->links() }}

        <div>
            <div class="row">
                <div class="col">
                    <div class="float-start">
                        <p class="btn btn-sm btn-secondary">Data/Page: {{ $daftaratlit->count() }} / {{ $daftaratlit->currentPage() }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('templates.footer')
@endsection
