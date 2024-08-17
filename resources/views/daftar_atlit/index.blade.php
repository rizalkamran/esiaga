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
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="d-flex align-items-center">
                        <!-- Text for Filter Data -->
                        <span class="badge rounded-pill text-bg-info mr-3" style="min-width: 100px; text-align: center;">Filter Data</span>

                        <!-- Filter Data Form -->
                        <form action="{{ route('daftar_atlit.index') }}" method="GET" class="d-flex align-items-center mx-2">
                            <input type="text" class="form-control form-control-sm" name="nama_lengkap" placeholder="Cari ..." value="{{ request('nama_lengkap') }}">
                            <select class="form-select form-select-sm" name="acara_id" id="acara_id">
                                <option value="">Pilih Acara</option>
                                @foreach($acara as $a)
                                    <option value="{{ $a->id }}" {{ request('acara_id', $activeAcara->id ?? '') == $a->id ? 'selected' : '' }}>
                                        {{ $a->nama_acara }}
                                    </option>
                                @endforeach
                            </select>
                            <select class="form-select form-select-sm" name="kategori_id" id="kategori_id">
                                <option value="">Pilih Kategori</option>
                            </select>
                            <button class="btn btn-sm btn-primary" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var acaraID = $('#acara_id').val();
        var selectedKategoriID = "{{ request('kategori_id') }}";

        // Function to populate kategori dropdown
        function populateKategoriDropdown(acaraID, selectedKategoriID = null) {
            if (acaraID) {
                $.ajax({
                    url: '{{ url('/get-kategori') }}/' + acaraID,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#kategori_id').empty();
                        $('#kategori_id').append('<option value="">Pilih Kategori</option>');
                        $.each(data, function(key, value) {
                            var isSelected = selectedKategoriID == value.id ? 'selected' : '';
                            $('#kategori_id').append('<option value="' + value.id + '" ' + isSelected + '>' + value.nama_kategori + '</option>');
                        });
                    }
                });
            } else {
                $('#kategori_id').empty();
                $('#kategori_id').append('<option value="">Pilih Kategori</option>');
            }
        }

        // Populate Kategori dropdown on page load
        populateKategoriDropdown(acaraID, selectedKategoriID);

        // Populate Kategori dropdown on Acara change
        $('#acara_id').change(function() {
            var acaraID = $(this).val();
            populateKategoriDropdown(acaraID);
        });
    });
</script>


@endsection
