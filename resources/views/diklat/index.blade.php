@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Profil
        </div>
        <div class="card-body">

            @if (!$diklat->isEmpty())
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Tingkat</th>
                            <th>Nama diklat</th>
                            <th>Penyelenggara</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($diklat as $d)
                            <tr>
                                <td>{{ $d->user->nama_lengkap }}</td>
                                <td>
                                    @if ($d->user->jenis_kelamin == 'L')
                                        Laki-laki
                                    @else
                                        Perempuan
                                    @endif
                                </td>
                                <td>{{ $d->tingkat }}</td>
                                <td>{{ $d->nama_diklat }}</td>
                                <td>{{ $d->penyelenggara }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#imagesModal{{ $d->id }}">
                                        Images
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Peringatan</h4>
                    <p>Harap isi diklat terlebih dahulu, kemudian jika ada salah data harap menghubungi pihak terkait</p>
                </div>
            @endif


            {{ $diklat->links() }}
        </div>
    </div>

    <!-- Images Modals -->
    @foreach ($diklat as $d)
        <div class="modal fade" id="imagesModal{{ $d->id }}" tabindex="-1"
            aria-labelledby="imagesModalLabel{{ $d->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imagesModalLabel{{ $d->id }}">Images</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <div class="col">
                                <img src="{{ asset('storage/foto_ijazah/' . $d->foto_ijazah) }}" alt="Foto Diri" class="img-fluid mb-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    @include('templates.footer')
@endsection
