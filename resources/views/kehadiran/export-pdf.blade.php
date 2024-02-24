<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kehadiran Data</title>
    <!--fivicon icon-->
    <link href="{{ asset('image/mobile/favicon-esiaga.png') }}" rel="icon" type="image/png">

    <style>
        /* Add your CSS styles here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
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
            @foreach ($kehadiran->unique('acara_id') as $k)
                <li>{{ $k->acara->nama_acara }}</li>
            @endforeach
        </ul>

        <table>
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>NIK</th>
                    <th>Waktu Absen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kehadiran as $index => $k)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $k->user->nama_lengkap }}</td>
                        <td>{{ $k->user->jenis_kelamin === 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
                        <td>{{ $k->user->nomor_ktp }}</td>
                        <td>{{ $k->created_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h4>No Events Found</h4>
    @endif
</body>
</html>
