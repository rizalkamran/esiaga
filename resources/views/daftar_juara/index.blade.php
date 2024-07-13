@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Daftar Pemenang
    </div>
    <div class="card-body">
        @can('is-admin')
            <div class="row">
                <div class="col">
                    <a class="btn btn-sm btn-primary mb-3" href="{{ route('daftar_juara.create') }}" role="button">Create</a>
                    <a class="btn btn-sm btn-secondary mb-3" href="{{ route('daftar_juara.index') }}">Reset</a>
                </div>
                <div class="col">
                    <form action="{{ route('daftar_juara.index') }}" method="GET">
                        <div class="input-group mb-3">
                            <select class="form-select form-select-sm" name="acara_id">
                                <option value="">Pilih Acara</option>
                                @foreach($acara as $a)
                                    <option value="{{ $a->id }}" {{ request('acara_id') == $a->id ? 'selected' : '' }}>{{ $a->nama_acara }}</option>
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
                        <th scope="col">Acara</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Status</th>
                        @can('is-admin')
                            <th scope="col">Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarjuara as $index => $daftar)
                        <tr>
                            <td>{{ $index + $daftarjuara->firstItem() }}</td>
                            <td>{{ $daftar->user->nama_lengkap }}</td>
                            <td>{{ Illuminate\Support\Str::limit($daftar->kategori->acara->nama_acara, 40) }}</td>
                            <td>{{ $daftar->kategori->nama_kategori }} {{ $daftar->kategori->desk_tambahan }}</td>
                            <td>{{ $daftar->status_juara }}</td>
                            @can('is-admin')
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" disabled onclick="event.preventDefault(); document.getElementById('delete-user-form-{{ $daftar->id }}').submit()">Delete</button>
                                    <form id="delete-user-form-{{ $daftar->id }}" action="{{ route('daftar_juara.destroy', $daftar->id) }}" method="POST" style="display: none">
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

        {{ $daftarjuara->appends(request()->query())->links() }}

        <div>
            <div class="row">
                <div class="col">
                    <div class="float-start">
                        <p class="btn btn-sm btn-secondary">Data/Page: {{ $daftarjuara->count() }} / {{ $daftarjuara->currentPage() }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('templates.footer')
@endsection
