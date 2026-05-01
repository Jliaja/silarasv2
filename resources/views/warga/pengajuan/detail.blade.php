@extends('layouts.warga')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <h3 style="margin-bottom: 20px;">Detail Pengajuan Surat</h3>

    <!-- Status Banner -->
    <div style="margin-bottom: 25px; padding: 15px 20px; border-radius: 16px; background: 
        @if($pengajuan->status_terkini == 'menunggu') #fef3c7
        @elseif($pengajuan->status_terkini == 'diverifikasi') #dbeafe
        @elseif($pengajuan->status_terkini == 'selesai') #d1fae5
        @elseif($pengajuan->status_terkini == 'ditolak') #fee2e2
        @endif;
        border-left: 5px solid 
        @if($pengajuan->status_terkini == 'menunggu') #f59e0b
        @elseif($pengajuan->status_terkini == 'diverifikasi') #2c7cb6
        @elseif($pengajuan->status_terkini == 'selesai') #10b981
        @elseif($pengajuan->status_terkini == 'ditolak') #ef4444
        @endif;">
        <strong>Status: 
            @if($pengajuan->status_terkini == 'menunggu') ⏳ Menunggu Verifikasi
            @elseif($pengajuan->status_terkini == 'diverifikasi') ✅ Telah Diverifikasi
            @elseif($pengajuan->status_terkini == 'selesai') 📑 Selesai - Surat Sudah Jadi
            @elseif($pengajuan->status_terkini == 'ditolak') ❌ Ditolak
            @endif
        </strong>
        @if($pengajuan->alasan_penolakan)
            <br><small style="color: #991b1b;">Alasan : {{ $pengajuan->alasan_penolakan }}</small>
        @endif
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
        <!-- KOLOM KIRI: Data Pemohon -->
        <div style="background: #f8fafc; padding: 20px; border-radius: 16px;">
            <h4 style="margin-bottom: 15px;">Data Pemohon</h4>
            <p><strong>Nama :</strong> {{ $pengajuan->user->name }}</p>
            <p><strong>NIK :</strong> {{ $pengajuan->user->nik }}</p>
            <p><strong>Tempat, Tanggal Lahir :</strong> {{ $pengajuan->user->tempat_lahir ?? '-' }}, {{ $pengajuan->user->tgl_lahir ?? '-' }}</p>
            <p><strong>Jenis Kelamin :</strong> {{ $pengajuan->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
            <p><strong>Pekerjaan :</strong> {{ $pengajuan->user->pekerjaan ?? '-' }}</p>
            <p><strong>Alamat :</strong> {{ $pengajuan->user->alamat ?? '-' }}</p>
        </div>

        <!-- KOLOM KANAN: Data Pengajuan -->
        <div>
            <div style="background: #f8fafc; padding: 20px; border-radius: 16px; margin-bottom: 20px;">
                <h4 style="margin-bottom: 15px;">Data Pengajuan</h4>
                <p><strong>Jenis Surat :</strong> {{ $pengajuan->kategori->nama_kategori }} ({{ $pengajuan->kategori->kode_surat }})</p>
                <p><strong>Tanggal Pengajuan :</strong> {{ \Carbon\Carbon::parse($pengajuan->tgl_pengajuan)->translatedFormat('d F Y') }}</p>
                <p><strong>Keperluan :</strong> {{ $pengajuan->keperluan }}</p>

                @php
                    $dataTambahan = is_array($pengajuan->data_pengajuan) ? $pengajuan->data_pengajuan : json_decode($pengajuan->data_pengajuan, true);
                @endphp

                @if(!empty($dataTambahan['no_kk']))
                    <p><strong>No. KK :</strong> {{ $dataTambahan['no_kk'] }}</p>
                @endif

                @if(!empty($dataTambahan['nama_usaha']))
                    <hr>
                    <p><strong>Nama Usaha :</strong> {{ $dataTambahan['nama_usaha'] }}</p>
                    <p><strong>Jenis Usaha :</strong> {{ $dataTambahan['jenis_usaha'] ?? '-' }}</p>
                    <p><strong>Alamat Usaha :</strong> {{ $dataTambahan['alamat_usaha'] ?? '-' }}</p>
                    <p><strong>Tahun Berdiri :</strong> {{ $dataTambahan['tahun_berdiri'] ?? '-' }}</p>
                @endif
            </div>

            <!-- DOKUMEN UPLOAD -->
            <div style="background: #f8fafc; padding: 20px; border-radius: 16px;">
                <h4 style="margin-bottom: 15px;">Dokumen Upload</h4>
                
                @if($pengajuan->file_kk)
                    <p><strong>Kartu Keluarga (KK):</strong> <a href="{{ asset('storage/' . $pengajuan->file_kk) }}" target="_blank" style="color: #2c7cb6;">Lihat File</a></p>
                @else
                    <p>Kartu Keluarga (KK) : <span style="color: red;">Belum diupload</span></p>
                @endif

                @if($pengajuan->file_pengantar)
                    <p><strong>Surat Pengantar RT :</strong> <a href="{{ asset('storage/' . $pengajuan->file_pengantar) }}" target="_blank" style="color: #2c7cb6;">Lihat File</a></p>
                @else
                    <p>Surat Pengantar RT : <span style="color: red;">Belum diupload</span></p>
                @endif

                @if($pengajuan->file_foto_depan)
                    <p><strong>Foto Depan Usaha :</strong> <a href="{{ asset('storage/' . $pengajuan->file_foto_depan) }}" target="_blank" style="color: #2c7cb6;">Lihat Foto</a></p>
                @endif

                @if($pengajuan->file_foto_dalam)
                    <p><strong>Foto Dalam Usaha:</strong> <a href="{{ asset('storage/' . $pengajuan->file_foto_dalam) }}" target="_blank" style="color: #2c7cb6;">Lihat Foto</a></p>
                @endif
            </div>

            @if($pengajuan->status_terkini == 'selesai' && $pengajuan->suratKeluar)
                <div style="margin-top: 20px; text-align: center;">
                    <a href="{{ route('warga.pengajuan.download', $pengajuan->id) }}" class="btn-download">Download Surat (PDF)</a>
                </div>
            @endif
        </div>
    </div>

    <div style="margin-top: 30px; text-align: center;">
        <a href="{{ route('warga.riwayat') }}" class="btn-outline">← Kembali ke Riwayat</a>
    </div>
</div>

<style>
    .btn-download {
        background: #10b981;
        color: white;
        padding: 10px 20px;
        border-radius: 40px;
        text-decoration: none;
        display: inline-block;
    }
    .btn-outline {
        background: #f1f5f9;
        padding: 10px 20px;
        border-radius: 40px;
        text-decoration: none;
        color: #1e293b;
        display: inline-block;
    }
    h4 {
        color: #1e3a5f;
        margin-bottom: 15px;
    }
    p {
        margin-bottom: 8px;
    }
</style>
@endsection