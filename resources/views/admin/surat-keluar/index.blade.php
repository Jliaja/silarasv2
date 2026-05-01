@extends('layouts.admin')

@section('title', 'Surat Keluar')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3 style="margin: 0; font-size: 20px;">Daftar Surat Keluar</h3>
    </div>

    @if($suratKeluar->isEmpty())
        <p style="color: #64748b;">Belum ada surat keluar.</p>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 14px; text-align: left;">No</th>
                        <th style="padding: 14px; text-align: left;">Nomor Surat</th>
                        <th style="padding: 14px; text-align: left;">Pemohon</th>
                        <th style="padding: 14px; text-align: left;">Jenis Surat</th>
                        <th style="padding: 14px; text-align: left;">Tgl Surat</th>
                        <th style="padding: 14px; text-align: left;">Pejabat</th>
                        <th style="padding: 14px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suratKeluar as $index => $item)
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 12px;">{{ $index + 1 }}</td>
                        <td style="padding: 12px;"><code>{{ $item->nomor_surat }}</code></td>
                        <td style="padding: 12px;">
                            <strong>{{ $item->pengajuan->user->name ?? '-' }}</strong><br>
                         </td>
                        <td style="padding: 12px;">{{ $item->pengajuan->kategori->nama_kategori ?? '-' }}<br>
                        <td style="padding: 12px;">{{ \Carbon\Carbon::parse($item->tgl_surat)->translatedFormat('d M Y') }}</td>
                        <td style="padding: 12px;">{{ $item->pejabat->nama ?? '-' }}<br>
                        <td style="padding: 12px; text-align: center;">
                            <div style="display: flex; gap: 8px; justify-content: center;">
                                <a href="{{ route('admin.surat-keluar.preview', $item->id) }}" target="_blank" class="btn-preview">Preview</a>
                                <a href="{{ route('admin.surat-keluar.download', $item->id) }}" class="btn-download">Download</a>
                                <form action="{{ route('admin.surat-keluar.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-hapus" onclick="return confirm('Yakin hapus surat ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<style>
    .btn-preview {
        background: #2c7cb6;
        color: white;
        padding: 5px 12px;
        border-radius: 30px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 500;
        transition: 0.2s;
        display: inline-block;
    }
    .btn-preview:hover {
        background: #1e5a8a;
    }
    .btn-download {
        background: #10b981;
        color: white;
        padding: 5px 12px;
        border-radius: 30px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 500;
        transition: 0.2s;
        display: inline-block;
    }
    .btn-download:hover {
        background: #059669;
    }
    .btn-hapus {
        background: #ef4444;
        color: white;
        padding: 5px 12px;
        border-radius: 30px;
        border: none;
        cursor: pointer;
        font-size: 12px;
        font-weight: 500;
        transition: 0.2s;
    }
    .btn-hapus:hover {
        background: #dc2626;
    }
    code {
        background: #f1f5f9;
        padding: 4px 8px;
        border-radius: 8px;
        font-size: 12px;
    }
</style>
@endsection