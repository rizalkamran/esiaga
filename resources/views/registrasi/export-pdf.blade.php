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
    <h1>Registrasi Data</h1>
    <table>
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>NIK</th>
                <th>Acara</th>
                <th>Waktu Daftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggota as $index => $ag)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ag->user->nama_lengkap }}</td>
                    <td>{{ $ag->user->jenis_kelamin === 'p' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ $ag->user->nomor_ktp }}</td>
                    <td>{{ $ag->acara->nama_acara }}</td>
                    <td>{{ $ag->created_at->format('d-m-Y H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
