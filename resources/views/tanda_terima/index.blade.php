@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Tanda Terima
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-5">
                    @can('is-admin')
                        <a class="btn btn-sm btn-primary mb-3" href="{{ route('tanda_terima.create') }}" role="button">Create</a>
                    @endcan
                    {{-- <form action="#" method="GET"> <!-- Form for reset filter -->
                        <button type="submit" class="btn btn-sm btn-secondary">Reset</button>
                    </form> --}}
                </div>
                <div class="col-md-7">
                    <div class="float-end">
                        <form action="{{ route('tandaterima.export-pdf') }}" method="get" target="_blank" style="display: inline-flex; align-items: center;">
                                <div class="form-group mr-2" style="margin-bottom: 0;">
                                    <select class="form-control form-control-sm" id="acara" name="acara">
                                        <option value="">All/Semua</option>
                                        @foreach($acaraOptions as $acaraOption)
                                            <option value="{{ $acaraOption->id }}" {{ $selectedAcara == $acaraOption->id ? 'selected' : '' }}>{{ Illuminate\Support\Str::limit($acaraOption->nama_acara, 35) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-danger" style="margin-left: 5px;">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </button>
                            </form>
                    </div>
                </div>
            </div>


            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nomor</th>
                            <th scope="col">Data Peserta</th>
                            <th scope="col">Tanda Terima</th>
                            <th scope="col">Tanggal Terima</th>
                            <th scope="col">Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tandaterima as $index => $tanda)
                            <tr>
                                <td class="align-middle">{{ $index + $tandaterima->firstItem() }}</td>
                                <td class="align-middle"> <!-- Add class align-middle for vertical alignment -->
                                    <div>{{ $tanda->user->nama_lengkap }} // {{ $tanda->user->biodata?->cabor?->nama_cabor ?? 'Data belum diisi' }}</div>
                                    <div>{{ $tanda->user->nomor_ktp }} </div>
                                    <div>{{ Illuminate\Support\Str::limit($tanda->acara->nama_acara, 40) }}</div>
                                </td>
                                <td class="align-middle"> <!-- Add class align-middle for vertical alignment -->
                                    <div>
                                        <span class="badge {{ $tanda->status_baju == 1 ? 'bg-success' : 'bg-danger' }}">
                                            @if($tanda->status_baju == 1)
                                                <i class="fas fa-check me-1"></i> Baju
                                            @else
                                                <i class="fas fa-times me-1"></i> Baju
                                            @endif
                                        </span>
                                    </div>
                                    <div>
                                        <span class="badge {{ $tanda->status_sertifikat == 1 ? 'bg-success' : 'bg-danger' }}">
                                            @if($tanda->status_sertifikat == 1)
                                                <i class="fas fa-check me-1"></i> Sertifikat
                                            @else
                                                <i class="fas fa-times me-1"></i> Sertifikat
                                            @endif
                                        </span>
                                    </div>
                                    <div>
                                        <span class="badge {{ $tanda->status_idcard == 1 ? 'bg-success' : 'bg-danger' }}">
                                            @if($tanda->status_idcard == 1)
                                                <i class="fas fa-check me-1"></i> ID Card
                                            @else
                                                <i class="fas fa-times me-1"></i> ID Card
                                            @endif
                                        </span>
                                    </div>
                                </td>
                                <td class="align-middle"> <!-- Add class align-middle for vertical alignment -->
                                    {{ \Carbon\Carbon::parse($tanda->tgl_terima)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                </td>
                                <td class="align-middle"> <!-- Add class align-middle for vertical alignment -->
                                    <!-- Display the QR code image -->
                                    <img src="{{ asset('qrcodes/tanda_terima/' . $tanda->bukti) }}" alt="QR Code" style="height:auto;width:30%;">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $tandaterima->links() }}
        </div>
    </div>

    @include('templates.footer')
@endsection
