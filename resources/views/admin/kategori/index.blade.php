@extends('layouts.admin')

@section('title', 'Kategori Surat')

@section('content')
<div class="card" style="margin-bottom: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0;">Data Kategori Surat</h3>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
            + Tambah Kategori
        </a>
    </div>

    @if($kategori->isEmpty())
        <p style="color: #64748b;">Belum ada data kategori surat.</p>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; border: 1px solid #e2e8f0;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 14px; text-align: left; border-right: 1px solid #e2e8f0;">ID</th>
                        <th style="padding: 14px; text-align: left; border-right: 1px solid #e2e8f0;">Nama Kategori</th>
                        <th style="padding: 14px; text-align: left; border-right: 1px solid #e2e8f0;">Kode Surat</th>
                        <th style="padding: 14px; text-align: left;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori as $item)
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <td style="padding: 12px; border-right: 1px solid #e2e8f0;">{{ $item->id }}</td>
                        <td style="padding: 12px; border-right: 1px solid #e2e8f0;">{{ $item->nama_kategori }}</td>
                        <td style="padding: 12px; border-right: 1px solid #e2e8f0;">{{ $item->kode_surat }}</td>
                        <td style="padding: 12px;">
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('admin.kategori.edit', $item->id) }}" class="btn btn-sm btn-primary" style="background: #f59e0b; text-decoration: none;">
                                    Edit
                                </a>
                                <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus kategori {{ $item->nama_kategori }}?')">
                                        Hapus
                                    </button>
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
@endsection