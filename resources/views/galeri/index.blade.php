@extends('templates.main')

@section('content')
<div class="card shadow mt-3">
    <div class="card-header">
        Galeri/Dokumentasi Acara
    </div>
    <div class="card-body">
        @can('is-admin')
            <div class="row">
                <div class="col">
                    <a class="btn btn-sm btn-primary mb-3" href="{{ route('galeri.create') }}" role="button">Create</a>
                    <a class="btn btn-sm btn-secondary mb-3" href="{{ route('galeri.index') }}">Reset</a>
                </div>
                <div class="col">
                    <form action="{{ route('galeri.index') }}" method="GET">
                        <div class="input-group mb-3">
                            <select class="form-select form-select-sm" name="acara_id">
                                <option value="">Semua Acara</option>
                                @foreach($acara as $a)
                                    <option value="{{ $a->id }}" {{ request('acara_id', $activeAcara->id ?? '') == $a->id ? 'selected' : '' }}>
                                        {{ $a->nama_acara }}
                                    </option>
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

        @if (!$galeri->isEmpty())
        <!-- Gallery Display -->
        <div class="container">
            @foreach($galeri->chunk(4) as $chunk) <!-- Chunk the collection into groups of 4 -->
                <div class="row g-4 mt-2">
                    @foreach($chunk as $item)
                        <div class="col-md-3"> <!-- 4 columns of equal width (3 out of 12 in Bootstrap grid) -->
                            <div class="card h-100 border border-primary">
                                <!-- Image that triggers the modal -->
                                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $item->id }}">
                                    <img src="{{ asset('dokumentasi/' . $item->dokumentasi) }}" class="card-img-top" alt="Image" style="height: 200px; width: 100%; object-fit: cover;">
                                </a>
                                <div class="card-body">
                                    <h6 class="card-title text-center">
                                        {{ Illuminate\Support\Str::limit($item->acara->nama_acara, 40) }}
                                    </h6>
                                    <p class="card-text text-center fw-semibold text-primary">{{ $item->deskripsi }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for the image -->
                        <div class="modal fade" id="imageModal{{ $item->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="imageModalLabel{{ $item->id }}">{{ $item->acara->nama_acara }}</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ asset('dokumentasi/' . $item->dokumentasi) }}" class="img-fluid mx-auto d-block" alt="Image">
                                    </div>
                                    <div class="modal-footer">
                                        <p class="text-primary fw-semibold">{{ $item->deskripsi }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        @else
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Peringatan</h4>
                <p>Tidak ada data registrasi peserta</p>
            </div>
        @endif

        <!-- Pagination Links -->
        <div class="mt-3">
            {{ $galeri->appends(request()->query())->links() }}
        </div>

        <div>
            <div class="row">
                <div class="col">
                    <div class="float-start">
                        <p class="btn btn-sm btn-secondary">Data/Page: {{ $galeri->count() }} / {{ $galeri->currentPage() }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('templates.footer')
@endsection
