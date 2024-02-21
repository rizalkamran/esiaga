<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Data</title>
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
    @if ($anggota->isNotEmpty())
        <ul>
            @foreach ($anggota->unique('acara_id') as $ag)
                <li>{{ $ag->acara->nama_acara }}</li>
            @endforeach
        </ul>

        <table>
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>NIK</th>
                    <th>Waktu Daftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggota as $index => $ag)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $ag->user->nama_lengkap }}</td>
                        <td>{{ $ag->user->jenis_kelamin === 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
                        <td>{{ $ag->user->nomor_ktp }}</td>
                        <td>{{ $ag->created_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h4>No Events Found</h4>
    @endif
</body>
</html>
