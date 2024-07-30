<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemenang</title>
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
            DAFTAR PEMENANG
        </h5>
        <h5>
            BERDASARKAN DATA PADA APLIKASI E-SIAGA
        </h5>
    </div>

    @foreach ($anggota->unique('kategori.acara.id') as $ag)
    <p style="font-size: 14px;"> <!-- Adjust font size as needed -->
        <span style="display: inline-block; width: 120px; overflow: hidden; text-overflow: ellipsis;">Acara</span> : {{ $ag->kategori->acara ? $ag->kategori->acara->nama_acara : 'N/A' }} <br>
        <!-- Adjust width and add ellipsis for long text -->
        <span style="display: inline-block; width: 120px; overflow: hidden; text-overflow: ellipsis;">Lokasi/Tingkat</span> : {{ $ag->kategori->acara ? $ag->kategori->acara->lokasi_acara : 'N/A' }} - {{ $ag->kategori->acara ? $ag->kategori->acara->tingkat_wilayah_acara : 'N/A' }} <br>
        <!-- Adjust width and add ellipsis for long text -->
        <span style="display: inline-block; width: 120px; overflow: hidden; text-overflow: ellipsis;">Tanggal Acara</span> :
        @if ($ag->kategori->acara)
            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $ag->kategori->acara->tanggal_awal_acara)->locale('id_ID')->isoFormat('D MMMM YYYY') }} - {{ \Carbon\Carbon::createFromFormat('Y-m-d', $ag->kategori->acara->tanggal_akhir_acara)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
        @else
            N/A
        @endif
        <br>
    </p>
    @endforeach


        <table>
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">L/P</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggota as $index => $ag)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $ag->user->nama_lengkap }}</td>
                        <td>{{ $ag->user->jenis_kelamin}}</td>
                        <td>{{ $ag->kategori ? $ag->kategori->nama_kategori : 'N/A' }} {{ $ag->kategori ? $ag->kategori->desk_tambahan : '' }}</td>
                        <td>{{ $ag->status_juara }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="font-size: 16px; margin-top: 20px;">
            Total Pemenang Atlit Laki-laki: {{ $totalL }} <br>
            Total Pemenang Atlit Perempuan: {{ $totalP }} <br>
            Total Seluruh Pemenang: {{ $total }}
        </p>

        {{-- <p>
            Print Details <br>
            User: {{ Auth::check() ? Auth::user()->nama_lengkap : 'Guest' }} <br>
            Date/Time: {{ \Carbon\Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM YYYY, HH:mm:ss') }} <br>
        </p>
        <a href="{{ route('export.pdf.public', ['acara' => $selectedAcara]) }}">Link PDF</a> --}}
    @else
        <h4>No Events Found</h4>
    @endif

</body>
</html>
