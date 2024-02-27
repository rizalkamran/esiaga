<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Data</title>
    <!--fivicon icon-->
    <link href="{{ asset('image/mobile/favicon-esiaga.png') }}" rel="icon" type="image/png">

    <style>
        /* Custom CSS for making the table smaller */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px; /* Adjust the font size to make the table smaller */
        }
        th, td {
            border: 1px solid #000;
            padding: 6px; /* Adjust the padding to make the cells smaller */
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    @if ($anggota->isNotEmpty())
        <ul>
            @foreach ($anggota->unique('acara_id') as $ag)
                <li>
                    <h3>{{ $ag->acara->nama_acara }}</h3>
                </li>
            @endforeach
        </ul>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>L/P</th>
                    <th>Afiliasi</th>
                    <th>NIK</th>
                    <th>NPWP</th>
                    <th>Kota Domisili</th>
                    <th>Telepon</th>
                    {{-- <th>Waktu Daftar</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($anggota as $index => $ag)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $ag->user->nama_lengkap }}</td>
                        <td>{{ $ag->user->jenis_kelamin === 'P' ? 'P' : 'L' }}</td>
                        <td>{{ $ag->user->biodata->cabor->nama_cabor }}</td>
                        <td>{{ $ag->user->nomor_ktp }}</td>
                        <td>{{ $ag->user->biodata->npwp }}</td>
                        <td>{{ $ag->user->biodata->kota->nama_kota }}</td>
                        <td>{{ $ag->user->telepon }}</td>
                        {{-- <td>{{ $ag->created_at->format('d-m-Y H:i:s') }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h4>No Events Found</h4>
    @endif
</body>
</html>
