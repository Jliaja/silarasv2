<!-- resources/views/admin/surat-keluar/sktm.blade.php -->

<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">

<style>

body{
    font-family:"Times New Roman", serif;
    font-size:12pt;
    margin:25px 35px;
    color:#000;
    line-height:1.5;
}

table{
    width:100%;
    border-collapse:collapse;
}

.kop{
    border-bottom:4px double #000;
    padding-bottom:8px;
    margin-bottom:20px;
}

.logo{
    width:75px;
}

.logo img{
    width:60px;
}

.text-kop{
    text-align:center;
}

.text-kop h1{
    margin:0;
    font-size:16pt;
    font-weight:bold;
}

.text-kop h2{
    margin:0;
    font-size:14pt;
    font-weight:bold;
}

.text-kop h3{
    margin:2px 0;
    font-size:18pt;
    font-weight:bold;
}

.text-kop p{
    margin-top:4px;
    font-size:10pt;
}

.judul{
    text-align:center;
    margin-top:20px;
}

.judul h4{
    margin:0;
    font-size:15pt;
    text-decoration:underline;
    font-weight:bold;
}

.nomor{
    text-align:center;
    margin-top:5px;
    margin-bottom:25px;
}

.isi{
    text-align:justify;
}

.data{
    margin:15px 0;
}

.data td{
    padding:3px 0;
    vertical-align:top;
}

.label{
    width:190px;
}

.ttd{
    width:240px;
    margin-left:auto;
    margin-top:25px;
    text-align:center;
    page-break-inside:avoid;
}

.ttd img{
    max-height:55px;
    margin:4px 0;
}

.nama{
    font-weight:bold;
    text-decoration:underline;
    margin-top:4px;
}

</style>

</head>

<body>

<div class="kop">

<table>

<tr>

<td class="logo">
<img src="{{ public_path('images/logo-indramayu.png') }}">
</td>

<td class="text-kop">

<h1>PEMERINTAH KABUPATEN INDRAMAYU</h1>
<h2>KECAMATAN SINDANG</h2>
<h3>DESA RAMBATAN WETAN</h3>

<p>
Jl. Pintu Air No.97 KM 5 Rambatan Wetan
</p>

</td>

</tr>

</table>

</div>

<div class="judul">
<h4>SURAT KETERANGAN TIDAK MAMPU</h4>
</div>

<div class="nomor">
Nomor : {{ $surat->nomor_surat }}
</div>

<div class="isi">

<p>
Yang bertanda tangan di bawah ini:
</p>

<table class="data">

<tr>
<td class="label">Nama</td>
<td>: {{ $surat->pejabat->nama }}</td>
</tr>

<tr>
<td class="label">Jabatan</td>
<td>: {{ $surat->pejabat->jabatan }}</td>
</tr>

</table>

<p>
Dengan ini menerangkan bahwa:
</p>

<table class="data">

<tr>
<td class="label">Nama</td>
<td>: {{ $surat->pengajuan->user->name }}</td>
</tr>

<tr>
<td class="label">NIK</td>
<td>: {{ $surat->pengajuan->user->nik }}</td>
</tr>

<tr>
<td class="label">Pekerjaan</td>
<td>: {{ $surat->pengajuan->user->pekerjaan ?? '-' }}</td>
</tr>

<tr>
<td class="label">Alamat</td>
<td>: {{ $surat->pengajuan->user->alamat ?? '-' }}</td>
</tr>

</table>

<p>
Berdasarkan data yang ada, benar bahwa yang bersangkutan termasuk masyarakat kurang mampu.
</p>

<p>
Surat ini dibuat untuk keperluan:
<strong>
{{ $surat->pengajuan->keperluan }}
</strong>
</p>

<p>
Demikian surat ini dibuat agar dapat dipergunakan sebagaimana mestinya.
</p>

</div>

<div class="ttd">

<p>
Rambatan Wetan,
{{ \Carbon\Carbon::parse($surat->tgl_surat)->translatedFormat('d F Y') }}
</p>

<p>
{{ $surat->pejabat->jabatan }}
</p>

@if($surat->pejabat->tanda_tangan)

<img src="{{ public_path('storage/'.$surat->pejabat->tanda_tangan) }}">

@endif

<div class="nama">
{{ $surat->pejabat->nama }}
</div>

</div>

</body>
</html>