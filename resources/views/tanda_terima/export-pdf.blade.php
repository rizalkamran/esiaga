<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Terima</title>
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
    @if ($tandaterima->isNotEmpty())

    <div style="text-align:center">
        <h5>
            TANDA TERIMA
        </h5>
        <h5>
            BERDASARKAN DATA PADA APLIKASI E-SIAGA
        </h5>
    </div>

    @foreach ($tandaterima->unique('acara_id') as $ag)
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
                    <th style="text-align: center;">L/P</th>
                    <th style="text-align: center;">Baju</th>
                    <th style="text-align: center;">Sertifikat</th>
                    <th style="text-align: center;">ID Card</th>
                    <th style="text-align: center;">Tanggal Terima</th>
                    <th style="text-align: center;">Bukti</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tandaterima as $index => $tanda)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $tanda->user->nama_lengkap }}</td>
                        <td style="text-align: center;">{{ $tanda->user->jenis_kelamin === 'P' ? 'P' : 'L' }}</td>
                        <td style="text-align: center;">
                            @if($tanda->status_baju == 1)
                                Ya
                            @else
                                Tidak
                            @endif
                        </td>
                        <td style="text-align: center;">
                            @if($tanda->status_sertifikat == 1)
                                Ya
                            @else
                                Tidak
                            @endif
                        </td>
                        <td style="text-align: center;">
                            @if($tanda->status_idcard == 1)
                                Ya
                            @else
                                Tidak
                            @endif
                        </td>
                        <td style="text-align: center;">{{ \Carbon\Carbon::parse($tanda->tgl_terima)->locale('id_ID')->isoFormat('D MMMM YYYY') }}</td>
                        <td>
                            <!-- QR Code Image -->
                            <div style="text-align: center;">
                                <img src="{{ asset('qrcodes/tanda_terima/' . $tanda->bukti) }}" class="img-fluid" style="max-width: 90px;">
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p>
            Print Details <br>
            User: {{ Auth::check() ? Auth::user()->nama_lengkap : 'Guest' }} <br>
            Date/Time: {{ \Carbon\Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM YYYY, HH:mm:ss') }} <br>
        </p>
    @else
        <h4>No Events Found</h4>
    @endif

</body>
</html>
