@extends('templates.main')

@section('content')

    <div class="card shadow mt-3">
        <div class="card-header">
            Data Kode Acara
        </div>
        <div class="card-body">

            @can('is-admin')
                <div class="row mb-3">
                    <div class="col-md-3">
                        @can('is-admin')
                            <a class="btn btn-sm btn-primary mb-3" href="{{ route('kode-acara.create') }}" role="button">Create</a>
                        @endcan
                    </div>
                    <div class="col-md-6">
                       {{--  <div class="float-end">
                            <form action="{{ route('export-pdf') }}" method="get" target="_blank" style="display: inline-flex; align-items: center;">
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
                        </div> --}}
                    </div>

                    <div class="col-md-3">
                        <div class="float-end">
                            <form action="{{ route('kode-acara.index') }}" method="GET" style="display: inline-flex; align-items: center;">
                                <div class="form-group mr-2" style="margin-bottom: 0;">
                                    <select class="form-control form-control-sm" id="acara" name="selected_acara">
                                        <option value="">All/Semua</option>
                                        @foreach($acaraOptions as $acaraOption)
                                            <option value="{{ $acaraOption->id }}" {{ $selectedAcara == $acaraOption->id ? 'selected' : '' }}>{{ Illuminate\Support\Str::limit($acaraOption->nama_acara, 35) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary" style="margin-left: 5px;">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            @if (!$kode->isEmpty())
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nomor</th>
                            <th scope="col">Nama Acara</th>
                            <th scope="col">Kode Acara</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kode as $index => $k)
                            <tr>
                                <td>{{ $index + $kode->firstItem() }}</td>
                                <td>{{ Illuminate\Support\Str::limit($k->acara->nama_acara , 40) }}</td>
                                <td>{{ $k->code}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Peringatan</h4>
                <p>Tidak ada data kode acara</p>
            </div>
            @endif

            {{ $kode->links() }} <!-- Pagination Links -->

        </div>
    </div>

    @include('templates.footer')
@endsection


