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
        h5 {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    @if ($anggota->isNotEmpty())

    <div style="text-align:center">
        <h5>
            REGISTRASI PESERTA ONLINE
        </h5>
        <h5>
            BERDASARKAN DATA PADA APLIKASI E-SIAGA
        </h5>
    </div>

    @foreach ($anggota->unique('acara_id') as $ag)
    <p style="font-size: 14px;"> <!-- Adjust font size as needed -->
        <span style="display: inline-block; width: 120px; overflow: hidden; text-overflow: ellipsis;">Acara</span> : {{ $ag->acara->nama_acara }} <br>
        <!-- Adjust width and add ellipsis for long text -->
        <span style="display: inline-block; width: 120px; overflow: hidden; text-overflow: ellipsis;">Lokasi/Tingkat</span> : {{ $ag->acara->lokasi_acara }} - {{ $ag->acara->tingkat_wilayah_acara }} <br>
        <!-- Adjust width and add ellipsis for long text -->
        <span style="display: inline-block; width: 120px; overflow: hidden; text-overflow: ellipsis;">Tanggal Acara</span> : {{ \Carbon\Carbon::createFromFormat('Y-m-d', $ag->acara->tanggal_awal_acara)->locale('id_ID')->isoFormat('D MMMM YYYY') }} - {{ \Carbon\Carbon::createFromFormat('Y-m-d', $ag->acara->tanggal_akhir_acara)->locale('id_ID')->isoFormat('D MMMM YYYY') }} <br>
    </p>
    @endforeach


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
                    <th>Waktu Daftar</th>
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
                        <td>{{ \Carbon\Carbon::parse($ag->created_at)->locale('id_ID')->isoFormat('D MMMM YYYY H:m:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h4>No Events Found</h4>
    @endif
</body>
</html>
