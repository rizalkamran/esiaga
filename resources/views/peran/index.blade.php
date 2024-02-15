@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Peran
        </div>
        <div class="card-body">
            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Peran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reffPerans as $reffPeran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $reffPeran->nama_peran }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $reffPerans->links() }}
        </div>
    </div>

    @include('templates.footer')
@endsection
