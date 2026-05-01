@extends('layouts.warga')

@section('content')
<div class="card">
    <h3 style="margin-bottom: 20px;">Form Pengajuan Surat</h3>

    <form method="POST" action="{{ route('warga.pengajuan.store') }}" enctype="multipart/form-data" id="formPengajuan">
        @csrf

        <div class="form-group">
            <label class="form-label">Jenis Surat</label>
            <select name="id_kategori" id="jenisSurat" class="form-control" required>
                <option value="">Pilih Jenis Surat</option>
                @foreach($kategori as $item)
                    <option value="{{ $item->id }}" data-kode="{{ $item->kode_surat }}">{{ $item->nama_kategori }} ({{ $item->kode_surat }})</option>
                @endforeach
            </select>
        </div>

        <!-- FORM SKTM -->
        <div id="form-sktm" class="dynamic-form" style="display: none;">
            <h4>Data Diri (SKTM)</h4>
            <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" value="{{ Auth::user()->nik }}" readonly>
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="form-group">
                <label>No. KK</label>
                <input type="text" name="no_kk" class="form-control" placeholder="Masukkan Nomor KK">
            </div>
            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="{{ Auth::user()->tempat_lahir }}">
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="{{ Auth::user()->tgl_lahir }}">
            </div>
            <div class="form-group">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control" value="{{ Auth::user()->pekerjaan }}">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="2">{{ Auth::user()->alamat }}</textarea>
            </div>
            <h4>Upload Dokumen</h4>
            <div class="form-group">
                <label>Upload KK</label>
                <input type="file" name="file_kk" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
            </div>
            <div class="form-group">
                <label>Upload Surat Pengantar RT</label>
                <input type="file" name="file_pengantar" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
            </div>
        </div>

        <!-- FORM SKU -->
        <div id="form-sku" class="dynamic-form" style="display: none;">
            <h4>Data Diri (SKU)</h4>
            <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" value="{{ Auth::user()->nik }}" readonly>
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="{{ Auth::user()->tempat_lahir }}">
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="{{ Auth::user()->tgl_lahir }}">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="2">{{ Auth::user()->alamat }}</textarea>
            </div>
            <h4>Data Usaha</h4>
            <div class="form-group">
                <label>Nama Usaha</label>
                <input type="text" name="nama_usaha" class="form-control" placeholder="Nama usaha">
            </div>
            <div class="form-group">
                <label>Jenis Usaha</label>
                <input type="text" name="jenis_usaha" class="form-control" placeholder="Jenis usaha">
            </div>
            <div class="form-group">
                <label>Alamat Usaha</label>
                <textarea name="alamat_usaha" class="form-control" rows="2" placeholder="Alamat usaha"></textarea>
            </div>
            <div class="form-group">
                <label>Tahun Berdiri</label>
                <input type="text" name="tahun_berdiri" class="form-control" placeholder="Tahun">
            </div>
            <h4>Upload Dokumen</h4>
            <div class="form-group">
                <label>Foto Depan Usaha</label>
                <input type="file" name="file_foto_depan" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
            </div>
            <div class="form-group">
                <label>Foto Dalam Usaha</label>
                <input type="file" name="file_foto_dalam" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
            </div>
            <div class="form-group">
                <label>Surat Pengantar RT</label>
                <input type="file" name="file_pengantar" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
            </div>
        </div>

        <!-- FORM DOMISILI -->
        <div id="form-domisili" class="dynamic-form" style="display: none;">
            <h4>Data Diri (Domisili)</h4>
            <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" value="{{ Auth::user()->nik }}" readonly>
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="{{ Auth::user()->tempat_lahir }}">
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="{{ Auth::user()->tgl_lahir }}">
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option value="">Pilih</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Agama</label>
                <select name="agama" class="form-control">
                    <option value="">Pilih</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                </select>
            </div>
            <div class="form-group">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control" value="{{ Auth::user()->pekerjaan }}">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="2">{{ Auth::user()->alamat }}</textarea>
            </div>
            <h4>Upload Dokumen</h4>
            <div class="form-group">
                <label>Upload KK</label>
                <input type="file" name="file_kk" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
            </div>
            <div class="form-group">
                <label>Upload Surat Pengantar RT</label>
                <input type="file" name="file_pengantar" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
            </div>
        </div>

        <!-- KEPERLUAN -->
        <div class="form-group">
            <label class="form-label">Keperluan</label>
            <textarea name="keperluan" class="form-control" rows="3" placeholder="Contoh: Pengajuan Bantuan Sosial / Kredit Bank / Pindah penduduk" required></textarea>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
            <a href="{{ route('warga.dashboard') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>

<script>
    document.getElementById('jenisSurat').addEventListener('change', function() {
        // Sembunyikan semua form
        document.getElementById('form-sktm').style.display = 'none';
        document.getElementById('form-sku').style.display = 'none';
        document.getElementById('form-domisili').style.display = 'none';
        
        var kode = this.options[this.selectedIndex]?.getAttribute('data-kode');
        
        if (kode === 'SKTM') {
            document.getElementById('form-sktm').style.display = 'block';
        } else if (kode === 'SKU') {
            document.getElementById('form-sku').style.display = 'block';
        } else if (kode === 'Domisili') {
            document.getElementById('form-domisili').style.display = 'block';
        }
    });
</script>

<style>
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; margin-bottom: 8px; font-weight: 600; color: #1e3a5f; }
    .form-control { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 12px; }
    .btn-primary { background: #2c7cb6; color: white; padding: 12px 24px; border: none; border-radius: 40px; cursor: pointer; }
    .btn-outline { background: #f1f5f9; padding: 12px 24px; border-radius: 40px; text-decoration: none; color: #1e293b; margin-left: 10px; display: inline-block; }
    h4 { color: #1e3a5f; border-left: 4px solid #2c7cb6; padding-left: 12px; margin: 15px 0 10px; }
</style>
@endsection