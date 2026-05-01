@extends('layouts.admin')

@section('title', 'Data Pejabat')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h3 style="margin: 0; font-size: 20px;">Data Pejabat Desa</h3>
        <a href="{{ route('admin.pejabat.create') }}" class="btn btn-primary">+ Tambah Pejabat</a>
    </div>

    @if($pejabat->isEmpty())
        <p style="color: #64748b;">Belum ada data pejabat.</p>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 14px; text-align: left;">No</th>
                        <th style="padding: 14px; text-align: left;">Nama Pejabat</th>
                        <th style="padding: 14px; text-align: left;">Jabatan</th>
                        <th style="padding: 14px; text-align: left;">NIP</th>
                        <th style="padding: 14px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pejabat as $index => $item)
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 12px;">{{ $index + 1 }}</td>
                        <td style="padding: 12px; font-weight: 500;">{{ $item->nama }}</td>
                        <td style="padding: 12px;">{{ $item->jabatan }}</td>
                        <td style="padding: 12px;">{{ $item->nip ?? '-' }}</td>
                        <td style="padding: 12px; text-align: center;">
                            <div style="display: flex; gap: 10px; justify-content: center;">
                                <a href="{{ route('admin.pejabat.edit', $item->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('admin.pejabat.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-hapus" onclick="return confirm('Yakin hapus pejabat {{ $item->nama }}?')">Hapus</button>
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
    .btn-edit {
        background: #f59e0b;
        color: white;
        padding: 6px 14px;
        border-radius: 30px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 500;
        transition: 0.2s;
        display: inline-block;
    }
    .btn-edit:hover {
        background: #d97706;
    }
    .btn-hapus {
        background: #ef4444;
        color: white;
        padding: 6px 14px;
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
</style>
@endsection