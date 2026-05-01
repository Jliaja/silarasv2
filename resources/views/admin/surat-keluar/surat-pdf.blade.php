@php
    $kodeSurat = $surat->pengajuan->kategori->kode_surat ?? '';
@endphp

@if($kodeSurat == 'SKTM')
    @include('admin.surat-keluar.template-sktm')
@elseif($kodeSurat == 'SKU')
    @include('admin.surat-keluar.template-sku')
@elseif($kodeSurat == 'Domisili')
    @include('admin.surat-keluar.template-domisili')
@else
    @include('admin.surat-keluar.template-default')
@endif