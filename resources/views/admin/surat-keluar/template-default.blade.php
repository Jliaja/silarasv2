<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            margin: 40px;
            font-size: 12pt;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .kop {
            font-size: 16pt;
            font-weight: bold;
        }
        .alamat {
            font-size: 10pt;
        }
        .garis {
            border-bottom: 2px solid black;
            margin-top: 5px;
            margin-bottom: 20px;
        }
        .nomor {
            text-align: center;
            margin: 20px 0;
        }
        .isi {
            text-align: justify;
            line-height: 1.5;
        }
        .ttd {
            margin-top: 50px;
            text-align: right;
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

    
    <div class="nomor">
        <strong>SURAT KETERANGAN</strong><br>
        Nomor : {{ $surat->nomor_surat }}
    </div>
    
    <div class="isi">
        <p>Yang bertanda tangan di bawah ini, Kepala Desa Rambatan Wetan, Kecamatan Sindang, Kabupaten Indramayu, menerangkan dengan sebenarnya bahwa:</p>
        
        <table style="width:100%; margin: 20px 0;">
            <tr>
                <td style="width: 30%;">Nama Lengkap</td>
                <td>: {{ $surat->pengajuan->user->name }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $surat->pengajuan->user->nik }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>: {{ $surat->pengajuan->user->tempat_lahir ?? '-' }}, {{ $surat->pengajuan->user->tgl_lahir ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $surat->pengajuan->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $surat->pengajuan->user->alamat }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>: {{ $surat->pengajuan->user->pekerjaan ?? '-' }}</td>
            </tr>
        </table>
        
        <p>Keperluan : {{ $surat->pengajuan->keperluan }}</p>
        
        <p>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
    </div>
    
    <div class="ttd">
        <p>Desa Rambatan Wetan, {{ \Carbon\Carbon::parse($surat->tgl_surat)->translatedFormat('d F Y') }}</p>
        <p>Kepala Desa Rambatan Wetan</p>
        
        @if($surat->pejabat->tanda_tangan)
            <div style="margin-top: 20px;">
                <img src="{{ public_path('storage/' . $surat->pejabat->tanda_tangan) }}" style="max-width: 150px; height: auto;">
            </div>
        @endif
        
        <br>
        <p><u><strong>{{ $surat->pejabat->nama }}</strong></u><br>
        {{ $surat->pejabat->jabatan }}</p>
    </div>
    
    <div class="footer">
        <hr>
        <small>Dicetak pada : {{ $tanggal_cetak }}</small>
    </div>
</body>
</html>