@extends('layouts.admin')

@section('title', 'Permohonan Surat')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3 style="margin: 0; font-size: 20px;">Daftar Permohonan Surat</h3>
    </div>

    @if($pengajuan->isEmpty())
        <p style="color: #64748b;">Belum ada permohonan surat dari warga.</p>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 14px; text-align: left;">No</th>
                        <th style="padding: 14px; text-align: left;">Tanggal</th>
                        <th style="padding: 14px; text-align: left;">Pemohon</th>
                        <th style="padding: 14px; text-align: left;">Jenis Surat</th>
                        <th style="padding: 14px; text-align: left;">Keperluan</th>
                        <th style="padding: 14px; text-align: center;">Status</th>
                        <th style="padding: 14px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajuan as $index => $item)
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 12px;">{{ $index + 1 }}</td>
                        <td style="padding: 12px;">{{ \Carbon\Carbon::parse($item->tgl_pengajuan)->translatedFormat('d M Y') }}</td>
                        <td style="padding: 12px;">
                            <strong>{{ $item->user->name ?? '-' }}</strong><br>
                        </td>
                        <td style="padding: 12px;">{{ $item->kategori->nama_kategori ?? '-' }}<br>
                        <td style="padding: 12px;">{{ Str::limit($item->keperluan, 40) }}</td>
                        <td style="padding: 12px; text-align: center;">
                            @if($item->status_terkini == 'menunggu')
                                <span class="badge badge-warning">Menunggu</span>
                            @elseif($item->status_terkini == 'diverifikasi')
                                <span class="badge badge-info">Diverifikasi</span>
                            @elseif($item->status_terkini == 'selesai')
                                <span class="badge badge-success">Selesai</span>
                            @elseif($item->status_terkini == 'ditolak')
                                <span class="badge badge-danger">Ditolak</span>
                            @else
                                <span class="badge">{{ $item->status_terkini }}</span>
                            @endif
                        </td>
                        <td style="padding: 12px; text-align: center;">
                            <div style="display: flex; gap: 8px; justify-content: center;">
                                <a href="{{ route('admin.pengajuan.show', $item->id) }}" class="btn-primary-small">Tinjau</a>
                                <form action="{{ route('admin.pengajuan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-hapus-small" onclick="return confirm('Yakin hapus permohonan dari {{ $item->user->name ?? 'warga' }}?')">Hapus</button>
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
    .badge {
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
    }
    .badge-warning {
        background: #fef3c7;
        color: #92400e;
    }
    .badge-info {
        background: #dbeafe;
        color: #1e40af;
    }
    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }
    .badge-danger {
        background: #fee2e2;
        color: #991b1b;
    }
    .btn-primary-small {
        background: #2c7cb6;
        color: white;
        padding: 5px 12px;
        border-radius: 30px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 500;
        transition: 0.2s;
        display: inline-block;
    }
    .btn-primary-small:hover {
        background: #1e5a8a;
    }
    .btn-hapus-small {
        background: #ef4444;
        color: white;
        padding: 5px 12px;
        border-radius: 30px;
        border: none;
        cursor: pointer;
        font-size: 11px;
        font-weight: 500;
        transition: 0.2s;
    }
    .btn-hapus-small:hover {
        background: #dc2626;
    }
</style>
@endsection