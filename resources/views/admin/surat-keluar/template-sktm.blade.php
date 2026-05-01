<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan Tidak Mampu</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px 50px;
            font-size: 12pt;
            line-height: 1.15;
        }
        .kop {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
        }
        .kop-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }
        .logo-cell {
            width: 90px;
            text-align: center;
        }
        .logo-cell img {
            width: 70px;
            height: auto;
        }
        .text-cell {
            text-align: center;
        }
        .kop h2 {
            font-size: 16pt;
            margin: 0;
            text-transform: uppercase;
        }
        .kop h3 {
            font-size: 14pt;
            margin: 5px 0;
            text-transform: uppercase;
        }
        .kop p {
            font-size: 10pt;
            margin: 0;
        }
        .garis {
            border-bottom: 2px solid black;
            margin: 5px 0;
        }
        .garis-tebal {
            border-bottom: 3px double black;
            margin: 5px 0 15px 0;
        }
        .judul {
            text-align: center;
            margin: 20px 0;
        }
        .judul h4 {
            font-size: 14pt;
            text-decoration: underline;
            margin: 0;
        }
        .nomor {
            text-align: center;
            margin: 10px 0 25px 0;
        }
        .isi {
            text-align: justify;
            margin: 15px 0;
        }
        table {
            width: 100%;
            margin: 15px 0;
            border-collapse: collapse;
        }
        td {
            padding: 5px;
            vertical-align: top;
        }
        .td-label {
            width: 35%;
            font-weight: bold;
        }
        .ttd {
            margin-top: 40px;
            text-align: right;
        }
        .ttd p {
            margin: 5px 0;
        }
        .ttd img {
            max-width: 150px;
            height: auto;
            margin: 5px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 10pt;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="kop">
        <table class="kop-table">
            <tr>
                <td class="logo-cell">
                    <img src="C:/xampp/htdocs/silaras/public/images/logo-indramayu.png" alt="Logo Indramayu">
                </td>
                <td class="text-cell">
                    <h3>PEMERINTAH KABUPATEN INDRAMAYU</h3>
                    <h3>KECAMATAN SINDANG</h3>
                    <h2>DESA RAMBATAN WETAN</h2>
                    <p>Jalan Pintu Air No.97 Km 5 Rambatan Wetan Kec. Sindang Kab. Indramayu Kode Pos 45221</p>
                </td>
            </tr>
        </table>

        <div class="garis-tebal"></div>
    </div>

    <div class="judul">
        <h4>SURAT KETERANGAN TIDAK MAMPU (SKTM)</h4>
    </div>

    <div class="nomor">
        Nomor : {{ $surat->nomor_surat }}
    </div>

    <div class="isi">
        <p>Yang bertanda tangan di bawah ini :</p>

        <table>
            <tr><td class="td-label">Nama</td><td>: {{ $surat->pejabat->nama }}</td>
            <tr><td class="td-label">Jabatan</td><td>: {{ $surat->pejabat->jabatan }}</td>
        </table>

        <p>Dengan ini menerangkan bahwa :</p>

        <table>
            <tr><td class="td-label">Nama</td><td>: {{ $surat->pengajuan->user->name }}</td>
            <tr><td class="td-label">NIK</td><td>: {{ $surat->pengajuan->user->nik }}</td>
            <tr><td class="td-label">No. KK</td><td>: {{ $surat->pengajuan->user->no_kk ?? '-' }}</td>
            <tr><td class="td-label">Tempat/Tanggal Lahir</td><td>: {{ $surat->pengajuan->user->tempat_lahir ?? '-' }}, {{ \Carbon\Carbon::parse($surat->pengajuan->user->tgl_lahir)->translatedFormat('d F Y') ?? '-' }}</td>
            <tr><td class="td-label">Pekerjaan</td><td>: {{ $surat->pengajuan->user->pekerjaan ?? '-' }}</td>
            <tr><td class="td-label">Alamat</td><td>: {{ $surat->pengajuan->user->alamat }}</td>
        </table>

        <p>Berdasarkan hasil pendataan dan keterangan yang ada, yang bersangkutan <strong>tergolong keluarga kurang mampu secara ekonomi</strong>.</p>

        <p>Surat Keterangan Tidak Mampu ini dibuat untuk keperluan :<br>
        {{ $surat->pengajuan->keperluan }}</p>

        <p>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>
    </div>

    <div class="ttd">
        <p>Desa Rambatan Wetan, {{ \Carbon\Carbon::parse($surat->tgl_surat)->translatedFormat('d F Y') }}</p>
        <p>Kepala Desa Rambatan Wetan</p>
        @if($surat->pejabat->tanda_tangan)
            <img src="C:/xampp/htdocs/silaras/storage/app/public/{{ $surat->pejabat->tanda_tangan }}">
        @endif
        <p><strong>{{ $surat->pejabat->nama }}</strong></p>
    </div>

    <div class="footer">
        <hr>
        <small>Dicetak pada : {{ $tanggal_cetak }}</small>
    </div>
</body>
</html>