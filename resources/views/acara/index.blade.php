@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Pelatihan
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a class="btn btn-sm btn-primary" href="{{ route('acara.create') }}" role="button">Create</a>
                        <a class="btn btn-secondary" href="{{ route('acara.index') }}">Reset</a>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="float-end">
                        <form action="{{ route('acara.index') }}" method="GET" class="mb-3">
                            <div class="input-group">
                                <select name="year" class="form-select form-select-sm">
                                    <option value="">Pilih Tahun</option>
                                    @foreach(range(date('Y'), 2022) as $year)
                                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Nama Acara</th>
                            <th scope="col">tipe</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Tingkat</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status Acara</th>
                            @can('is-admin')
                                <th scope="col">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($acaras as $index => $acara)
                            <tr>
                                <td>{{ $index + $acaras->firstItem() }}</td>
                                <td>{{ Illuminate\Support\Str::limit($acara->nama_acara, 40) }}</td>
                                <td>
                                    @if ($acara->tipe === 1)
                                        <span class="badge bg-primary">Pelatihan</span>
                                    @elseif ($acara->tipe === 2)
                                        <span class="badge bg-primary">Kejuaraan</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ Illuminate\Support\Str::limit($acara->lokasi_acara, 30) }}</td>
                                <td>{{ $acara->tingkat_wilayah_acara }}</td>
                                <td>{{ \Carbon\Carbon::parse($acara->tanggal_awal_acara)->format('d-m-Y') }} //
                                    {{ \Carbon\Carbon::parse($acara->tanggal_akhir_acara)->format('d-m-Y') }}</td>
                                <td>
                                    @if ($acara->status_acara === 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Expired</span>
                                    @endif
                                </td>
                                @can('is-admin')
                                    <td>
                                        <a href="{{ route('acara.edit', $acara->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('acara.destroy', $acara->id) }}" method="POST"
                                            style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" disabled>Delete</button>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $acaras->links() }} <!-- Pagination Links -->

        </div>
    </div>

    @include('templates.footer')
@endsection
