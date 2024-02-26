@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data Acara
        </div>
        <div class="card-body">
            @can('is-admin')
                <a class="btn btn-sm btn-primary mb-3" href="{{ route('acara.create') }}" role="button">Create</a>
            @endcan

            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Nama Acara</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Tingkat</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Security Pass</th> <!-- This column will be hidden -->
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
                                <td>{{ Illuminate\Support\Str::limit($acara->nama_acara, 30) }}</td>
                                <td>{{ $acara->lokasi_acara }}</td>
                                <td>{{ $acara->tingkat_wilayah_acara }}</td>
                                <td>{{ \Carbon\Carbon::parse($acara->tanggal_awal_acara)->format('d-m-Y') }} //
                                    {{ \Carbon\Carbon::parse($acara->tanggal_akhir_acara)->format('d-m-Y') }}</td>
                                <td class="security-pass-cell">
                                    <span class="security-pass-value"
                                        style="display: none;">{{ $acara->security_pass }}</span>
                                    <!-- Actual text, initially hidden -->
                                    <span class="security-pass-hidden">********</span> <!-- Hidden, asterisks or dots -->
                                </td>
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
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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

    <script>
        // Script to show actual text on hover
        document.querySelectorAll('.security-pass-cell').forEach(function(cell) {
            var actualText = cell.querySelector('.security-pass-value');
            var hiddenText = cell.querySelector('.security-pass-hidden');

            // Initially hide the actual text
            actualText.style.display = 'none';

            // Add event listener to show the actual text on hover
            cell.addEventListener('mouseenter', function() {
                actualText.style.display = 'inline';
                hiddenText.style.display = 'none';
            });

            // Add event listener to hide the actual text when mouse leaves
            cell.addEventListener('mouseleave', function() {
                actualText.style.display = 'none';
                hiddenText.style.display = 'inline';
            });
        });
    </script>
@endsection
