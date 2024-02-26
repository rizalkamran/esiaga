<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kehadiran Data</title>
    <!--favicon icon-->
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
    @if ($kehadiran->isNotEmpty())
        <ul>
            @foreach ($kehadiran->unique('sesi_acara_id') as $k)
                <li>
                   <h3>{{ $k->sesiAcara->acara->nama_acara }} - {{ $k->sesiAcara->sesi }}</h3>
                </li>
            @endforeach
        </ul>

        <table>
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Cabor</th>
                    <th>NIK</th>
                    <th>NPWP</th>
                    <th>Kota Domisili</th>
                    <th>Telepon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kehadiran as $index => $k)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $k->user->nama_lengkap }}</td>
                        <td>{{ $k->user->jenis_kelamin === 'P' ? 'P' : 'L' }}</td>
                        <td>{{ $k->user->biodata->cabor->nama_cabor }}</td>
                        <td>{{ $k->user->nomor_ktp }}</td>
                        <td>{{ $k->user->biodata->npwp }}</td>
                        <td>{{ $k->user->biodata->kota->nama_kota }}</td>
                        <td>{{ $k->user->telepon }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h4>No Events Found</h4>
    @endif
</body>
</html>
