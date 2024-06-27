<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Data - {{ $anggota->user->nama_lengkap }}</title>
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
        h5 {
            margin: 5px 0;
        }
        /* Style for larger image */
        .large-image {
            max-width: 600px; /* Adjust the maximum width as needed */
            margin: 20px auto; /* Center the image horizontally */
            display: block; /* Ensure the image is displayed as a block element */
        }
    </style>
</head>
<body>
    @if ($anggota)
    <div style="text-align:center">
        <h5>
            REGISTRASI PESERTA ONLINE
        </h5>
        <h5>
            BERDASARKAN DATA PADA APLIKASI E-SIAGA
        </h5>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>L/P</th>
                <th>Afiliasi</th>
                <th>NIK</th>
                <th>Kota Domisili</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $anggota->user->nama_lengkap }}</td>
                <td>{{ $anggota->user->jenis_kelamin === 'P' ? 'P' : 'L' }}</td>
                <td>{{ $anggota->user->biodata?->cabor?->nama_cabor ?? 'Data belum diisi' }}</td>
                <td>{{ $anggota->user->nomor_ktp }}</td>
                <td>{{ $anggota->user->biodata?->kota?->nama_kota ?? 'Data belum diisi'}}</td>
            </tr>
        </tbody>
    </table>

     <!-- Mandat -->
     <div style="text-align: center;">
        <p>Mandat</p>
        <img src="{{ asset('mandat/' . $anggota->mandat) }}" class="large-image" alt="Mandat">
    </div>

    <!-- QR Code Image -->
    <div style="text-align: center; margin-top: 20px;">
        <p>QR Code</p>
        <img src="{{ asset('qrcodes/registrasi/' . $anggota->qrcode_registrasi) }}" class="img-fluid" style="max-width: 300px;">
    </div>

    @else
    <h4>No Registrasi Data Found</h4>
    @endif
</body>
</html>
