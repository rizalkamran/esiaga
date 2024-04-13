@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Sertifikat/Lisensi
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        {{-- <a class="btn btn-primary" href="{{ route('lisensi.create') }}">Buat</a> --}}
                        <a class="btn btn-primary" href="{{ route('lisensi.create', ['user_id' => request()->query('user_id')]) }}">Buat</a>
                        <a class="btn btn-secondary" href="{{ route('lisensi.index') }}">Reset</a>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="float-end">
                        <form action="{{ route('lisensi.index') }}" method="get" style="display: inline-flex; align-items: center;">
                            <div class="form-group mr-2" style="margin-bottom: 0;">
                                <input type="text" class="form-control form-control-sm" name="search" placeholder="Cari ...">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary ms-2">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @if (!$lisensi->isEmpty())
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Cabor/Afiliasi</th>
                            <th>L/P</th>
                            <th>Profesi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lisensi as $index => $lis)
                            <tr>
                                <td>{{ $index + $lisensi->firstItem() }}</td>
                                <td>{{ $lis->user->nama_lengkap }}</td>
                                <td>{{ $lis->cabor->nama_cabor }}</td>
                                <td>
                                    @if ($lis->user->jenis_kelamin == 'L')
                                        L
                                    @else
                                        P
                                    @endif
                                </td>
                                <td>{{ $lis->profesi }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#imagesModal{{ $lis->id }}">
                                        Detail
                                    </button>
                                    <a href="{{ route('lisensi.edit', $lis->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $lis->id }}">
                                        Delete
                                    </button>
                                    <form id="delete-user-form-{{ $lis->id }}" action="{{ route('lisensi.destroy', $lis->id) }}" method="POST" style="display: none">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $lis->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $lis->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $lis->id }}">Hapus data lisensi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <strong>Apakah anda ingin menghapus lisensi ini?</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="document.getElementById('delete-user-form-{{ $lis->id }}').submit()">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Peringatan</h4>
                    <p>Harap isi data lisensi terlebih dahulu, kemudian jika ada salah data harap menghubungi pihak terkait</p>
                </div>
            @endif


            {{ $lisensi->appends(['search' => $searchQuery])->links() }}
        </div>
    </div>

    <!-- Images Modals -->
    @foreach ($lisensi as $lis)
        <div class="modal fade" id="imagesModal{{ $lis->id }}" tabindex="-1"
            aria-labelledby="imagesModalLabel{{ $lis->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imagesModalLabel{{ $lis->id }}">Detail Sertifikat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <div class="row mb-3">
                                <div class="col">
                                    <p class="fw-bold">Nama Lisensi:</p>
                                    <p>{{ $lis->nama_lisensi }}</p>
                                </div>
                                <div class="col">
                                    <p class="fw-bold">Nomor Lisensi:</p>
                                    <p>{{ $lis->nomor_lisensi }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <p class="fw-bold">Tingkat:</p>
                                    <p>{{ $lis->tingkat }}</p>
                                </div>
                                <div class="col">
                                    <p class="fw-bold">Penyelenggara:</p>
                                    <p>{{ $lis->penyelenggara }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <p class="fw-bold">Tanggal Berakhir:</p>
                                    <p>{{ \Carbon\Carbon::parse($lis->tgl_mulai)->format('d-m-Y') }}</p>
                                </div>
                                <div class="col">
                                    <p class="fw-bold">Tanggal Berakhir:</p>
                                    <p>{{ \Carbon\Carbon::parse($lis->tgl_selesai)->format('d-m-Y') }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <p class="fw-bold">Foto Sertifikat:</p>
                                    <img src="{{ asset('foto_lisensi/' . $lis->foto_lisensi) }}" alt="Foto Lisensi" class="img-fluid mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @include('templates.footer')

    <!-- JavaScript Section -->
    @section('scripts')
    <script>
        // Initialize Bootstrap modal
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

        // Show modal on delete button click
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Extract ID from button data-id attribute
            var lisId = button.data('id');
            modal.find('.modal-footer #lisId').val(lisId);
        });

        // Handle form submission when modal delete button is clicked
        $('#deleteModal .btn-danger').on('click', function () {
            var lisId = $('#lisId').val();
            $('#delete-user-form-' + lisId).submit();
        });
    </script>
    @endsection
@endsection
