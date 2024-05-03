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
        /* Custom CSS to reduce margin between h5 headers */
        h5 {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div style="text-align:center">
        <h5>
            ABSENSI PESERTA ONLINE
        </h5>
        <h5>
            BERDASARKAN DATA PADA APLIKASI E-SIAGA
        </h5>
    </div>

    @if ($kehadiran->isNotEmpty())
        @foreach ($kehadiran->unique('sesi_acara_id') as $k)
            <p style="font-size: 14px;"> <!-- Adjust font size as needed -->
                <span style="display: inline-block; width: 100px;">Acara</span> : {{ $k->sesiAcara->acara->nama_acara }} <br>
                <span style="display: inline-block; width: 100px;">Lokasi</span> : {{ $k->sesiAcara->acara->lokasi_acara }} <br>
                <span style="display: inline-block; width: 100px;">Sesi</span> : {{ $k->sesiAcara->sesi }}
            </p>
        @endforeach

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>L/P</th>
                    <th>Afiliasi</th>
                    <th>Telepon</th>
                    <th>Waktu Hadir</th>
                    {{-- <th>NIK</th>
                    <th>NPWP</th>
                    <th>Kota Domisili</th> --}}

                </tr>
            </thead>
            <tbody>
                @foreach ($kehadiran as $index => $k)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $k->user->nama_lengkap }}</td>
                        <td>{{ $k->user->jenis_kelamin === 'P' ? 'P' : 'L' }}</td>
                        <td>{{ $k->user->biodata->cabor->nama_cabor }}</td>
                        <td>{{ $k->user->telepon }}</td>
                        <td>{{ \Carbon\Carbon::parse($k->created_at)->locale('id_ID')->format('H:i:s') }}</td>
                        {{--
                        <td>{{ $k->user->biodata->npwp }}</td>
                        <td>{{ $k->user->biodata->kota->nama_kota }}</td> --}}

                    </tr>
                @endforeach
            </tbody>
        </table>

        <p>
            Print Details <br>
            User: {{ Auth::user()->nama_lengkap }} <br>
            Date/Time: {{ \Carbon\Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM YYYY, HH:mm:ss') }}
        </p>
    @else
        <h4>No Events Found</h4>
    @endif
</body>
</html>
