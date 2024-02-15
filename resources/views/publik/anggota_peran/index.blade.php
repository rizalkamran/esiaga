@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Peran Anggota
        </div>
        <div class="card-body">
            @can('is-publik')
                <a class="btn btn-sm btn-primary mb-3" href="{{ route('publik.anggota_peran.create') }}" role="button">Create</a>
            @endcan

            <div class="row">
                @foreach ($anggotaPerans as $anggotaPeran)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header text-bg-info">Anggota Peran</div>
                            <div class="card-body border border-info-subtle">
                                <h5 class="card-title text-center">{{ $anggotaPeran->user->nama_lengkap }}</h5>
                                <p class="card-text">
                                    <strong class="text-danger">{{ $anggotaPeran->peran->nama_peran }} -
                                        {{ $anggotaPeran->cabor->nama_cabor }}</strong> <br>
                                    <strong class="text-success">Jabatan: {{ $anggotaPeran->jabatan }}</strong> <br>
                                <div class="d-flex justify-content-between">
                                    <strong class="text-secondary">Status Aktif:</strong>
                                    <div class="text-end">
                                        <span
                                            class="badge {{ $anggotaPeran->status_aktif_peran ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $anggotaPeran->status_aktif_peran ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <div class="d-flex justify-content-between">
                                    <strong class="text-secondary">Status Verifikasi:</strong>
                                    <div class="text-end">
                                        <span
                                            class="badge {{ $anggotaPeran->status_verifikasi_peran ? 'bg-success' : 'bg-danger' }}">
                                            {{ $anggotaPeran->status_verifikasi_peran ? 'Verified' : 'Not Verified' }}
                                        </span>
                                    </div>
                                </div>
                                <br>


                                <!-- Trigger Button -->
                                <button type="button" class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $anggotaPeran->id }}">
                                    Detail data
                                </button>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $anggotaPerans->links() }}
        </div>
    </div>

    <!-- Modals -->
    @foreach ($anggotaPerans as $anggotaPeran)
        <div class="modal fade" id="exampleModal{{ $anggotaPeran->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel{{ $anggotaPeran->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel{{ $anggotaPeran->id }}">Anggota Peran
                            Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nama Lembaga:</strong> {{ $anggotaPeran->nama_lembaga }}</p>
                        <p><strong>Provinsi Lembaga:</strong> {{ $anggotaPeran->provinsi_lembaga }}</p>
                        <p><strong>Kota Lembaga:</strong> {{ $anggotaPeran->kota_lembaga }}</p>
                        <p><strong>Kecamatan Lembaga:</strong> {{ $anggotaPeran->kecamatan_lembaga }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
