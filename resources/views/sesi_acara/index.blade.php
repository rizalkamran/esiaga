@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Sesi Acara
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    @can('is-admin')
                        <a class="btn btn-sm btn-primary mb-3" href="{{ route('sesi_acara.create') }}" role="button">Create</a>
                    @endcan
                    {{-- <form action="#" method="GET"> <!-- Form for reset filter -->
                        <button type="submit" class="btn btn-sm btn-secondary">Reset</button>
                    </form> --}}
                </div>
                <div class="col-md-6">
                    <div class="float-end">
                        <form action="#" method="GET" class="flex-grow-1"> <!-- flex-grow-1 to expand the form -->
                            <div class="input-group">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by Acara" value="{{ request()->query('search') }}">
                                <button type="submit" class="btn btn-sm btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nomor</th>
                            <th scope="col">Nama Acara</th>
                            <th scope="col">Nama Sesi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sesi as $index => $s)
                            <tr>
                                <td>{{ $index + $sesi->firstItem() }}</td>
                                <td>{{ $s->acara->nama_acara }}</td>
                                <td>{{ $s->sesi }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $sesi->links() }}
        </div>
    </div>

    @include('templates.footer')
@endsection
