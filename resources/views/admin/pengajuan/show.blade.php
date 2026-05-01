@extends('layouts.admin')

@section('title', 'Detail Permohonan Surat')

@section('content')
<div class="card" style="max-width: 900px; margin: 0 auto;">
    <h3 style="margin-bottom: 20px; font-size: 22px;">Detail Permohonan Surat</h3>

    <!-- Status Banner -->
    <div style="margin-bottom: 25px; padding: 12px 20px; border-radius: 12px; background: 
        @if($pengajuan->status_terkini == 'menunggu') #fef3c7
        @elseif($pengajuan->status_terkini == 'diverifikasi') #dbeafe
        @elseif($pengajuan->status_terkini == 'selesai') #d1fae5
        @elseif($pengajuan->status_terkini == 'ditolak') #fee2e2
        @endif;
        border-left: 4px solid 
        @if($pengajuan->status_terkini == 'menunggu') #f59e0b
        @elseif($pengajuan->status_terkini == 'diverifikasi') #2c7cb6
        @elseif($pengajuan->status_terkini == 'selesai') #10b981
        @elseif($pengajuan->status_terkini == 'ditolak') #ef4444
        @endif;">
        <strong>Status:</strong>
        @if($pengajuan->status_terkini == 'menunggu') ⏳ Menunggu Verifikasi
        @elseif($pengajuan->status_terkini == 'diverifikasi') ✅ Telah Diverifikasi
        @elseif($pengajuan->status_terkini == 'selesai') 📑 Selesai - Surat Sudah Jadi
        @elseif($pengajuan->status_terkini == 'ditolak') ❌ Ditolak
        @endif
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
        <!-- KOLOM KIRI: Data Pemohon -->
        <div>
            <div style="background: #f8fafc; padding: 20px; border-radius: 16px;">
                <h4 style="margin-bottom: 18px; font-size: 16px;">Data Pemohon</h4>
                <p><strong>Nama :</strong> {{ $pengajuan->user->name ?? '-' }}</p>
                <p><strong>NIK :</strong> {{ $pengajuan->user->nik ?? '-' }}</p>
                <p><strong>No HP :</strong> {{ $pengajuan->user->no_hp ?? '-' }}</p>
                <p><strong>Tempat, Tanggal Lahir :</strong> {{ $pengajuan->user->tempat_lahir ?? '-' }}, {{ $pengajuan->user->tgl_lahir ?? '-' }}</p>
                <p><strong>Jenis Kelamin :</strong> {{ $pengajuan->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                <p><strong>Pekerjaan :</strong> {{ $pengajuan->user->pekerjaan ?? '-' }}</p>
                <p><strong>Alamat :</strong> {{ $pengajuan->user->alamat ?? '-' }}</p>
            </div>
        </div>

        <!-- KOLOM KANAN: Data Pengajuan -->
        <div>
            <div style="background: #f8fafc; padding: 20px; border-radius: 16px; margin-bottom: 20px;">
                <h4 style="margin-bottom: 18px; font-size: 16px;">Data Pengajuan</h4>
                <p><strong>Jenis Surat :</strong> {{ $pengajuan->kategori->nama_kategori ?? '-' }} ({{ $pengajuan->kategori->kode_surat ?? '-' }})</p>
                <p><strong>Tanggal Pengajuan :</strong> {{ \Carbon\Carbon::parse($pengajuan->tgl_pengajuan)->translatedFormat('d F Y') }}</p>
                <p><strong>Keperluan :</strong> {{ $pengajuan->keperluan }}</p>

                @php $dataTambahan = is_array($pengajuan->data_pengajuan) ? $pengajuan->data_pengajuan : json_decode($pengajuan->data_pengajuan, true); @endphp

                @if(!empty($dataTambahan['no_kk']))
                    <p><strong>No. KK :</strong> {{ $dataTambahan['no_kk'] }}</p>
                @endif

                @if(!empty($dataTambahan['nama_usaha']))
                    <hr>
                    <p><strong>Nama Usaha:</strong> {{ $dataTambahan['nama_usaha'] }}</p>
                    <p><strong>Jenis Usaha :</strong> {{ $dataTambahan['jenis_usaha'] ?? '-' }}</p>
                    <p><strong>Alamat Usaha :</strong> {{ $dataTambahan['alamat_usaha'] ?? '-' }}</p>
                    <p><strong>Tahun Berdiri :</strong> {{ $dataTambahan['tahun_berdiri'] ?? '-' }}</p>
                @endif

                @if($pengajuan->alasan_penolakan)
                    <div style="margin-top: 15px; background: #fee2e2; padding: 12px; border-radius: 10px;">
                        <strong>Alasan Penolakan:</strong><br>
                        {{ $pengajuan->alasan_penolakan }}
                    </div>
                @endif
            </div>

            <!-- FILE UPLOAD WAJIB DITAMPILKAN -->
            <div style="background: #f8fafc; padding: 20px; border-radius: 16px;">
                <h4 style="margin-bottom: 15px;">Dokumen Pendukung</h4>
                
                @if($pengajuan->file_kk)
                    <p><strong>Kartu Keluarga (KK) :</strong> <a href="{{ asset('storage/' . $pengajuan->file_kk) }}" target="_blank" style="color: #2c7cb6;">Lihat File</a></p>
                @else
                    <p>Kartu Keluarga (KK) : <span style="color: #999;">Tidak ada</span></p>
                @endif

                @if($pengajuan->file_pengantar)
                    <p> <strong>Surat Pengantar RT :</strong> <a href="{{ asset('storage/' . $pengajuan->file_pengantar) }}" target="_blank" style="color: #2c7cb6;">Lihat File</a></p>
                @else
                    <p> Surat Pengantar RT : <span style="color: #999;">Tidak ada</span></p>
                @endif

                @if($pengajuan->file_foto_depan)
                    <p> <strong>Foto Depan Usaha :</strong> <a href="{{ asset('storage/' . $pengajuan->file_foto_depan) }}" target="_blank" style="color: #2c7cb6;">Lihat File</a></p>
                @endif

                @if($pengajuan->file_foto_dalam)
                    <p> <strong>Foto Dalam Usaha:</strong> <a href="{{ asset('storage/' . $pengajuan->file_foto_dalam) }}" target="_blank" style="color: #2c7cb6;">Lihat File</a></p>
                @endif
            </div>

            <!-- Aksi Verifikasi -->
            @if($pengajuan->status_terkini == 'menunggu' || $pengajuan->status_terkini == 'ditolak')
            <div style="background: #f8fafc; padding: 20px; border-radius: 16px; margin-top: 20px;">
                <h4 style="margin-bottom: 15px;">Verifikasi</h4>
                <form method="POST" action="{{ route('admin.pengajuan.verify', $pengajuan->id) }}">
                    @csrf
                    <input type="hidden" name="action" value="approve">
                    <button type="submit" style="background: #10b981; color: white; padding: 10px 20px; border: none; border-radius: 30px; margin-right: 10px; cursor: pointer;">✓ Setujui</button>
                </form>
                <form method="POST" action="{{ route('admin.pengajuan.verify', $pengajuan->id) }}" style="margin-top: 10px;">
                    @csrf
                    <input type="hidden" name="action" value="reject">
                    <textarea name="alasan_penolakan" class="form-control" rows="2" placeholder="Alasan penolakan..." style="width: 100%; margin-bottom: 10px;"></textarea>
                    <button type="submit" style="background: #ef4444; color: white; padding: 10px 20px; border: none; border-radius: 30px; cursor: pointer;">✗ Tolak</button>
                </form>
            </div>
            @endif

            @if($pengajuan->status_terkini == 'diverifikasi' && !$pengajuan->suratKeluar)
                <div style="margin-top: 20px;">
                    <a href="{{ route('admin.surat-keluar.create', $pengajuan->id) }}" style="display: block; text-align: center; background: #2c7cb6; color: white; padding: 12px; border-radius: 30px; text-decoration: none;">📑 Buat Surat</a>
                </div>
            @endif

            @if($pengajuan->suratKeluar)
                <div style="margin-top: 20px;">
                    <a href="{{ route('admin.surat-keluar.preview', $pengajuan->suratKeluar->id) }}" target="_blank" style="display: block; text-align: center; background: #2c7cb6; color: white; padding: 12px; border-radius: 30px; text-decoration: none;">📄 Preview Surat</a>
                </div>
            @endif
        </div>
    </div>

    <div style="margin-top: 30px; text-align: center;">
        <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-outline">← Kembali ke Daftar</a>
    </div>
</div>

<style>
    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
    }
    .btn-outline {
        background: #f1f5f9;
        color: #1e293b;
        padding: 8px 20px;
        border-radius: 30px;
        text-decoration: none;
        display: inline-block;
    }
    h4 {
        color: #1e3a5f;
        border-left: 4px solid #2c7cb6;
        padding-left: 12px;
    }
    p {
        margin-bottom: 8px;
    }
</style>
@endsection