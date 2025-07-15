@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <!-- Header Section -->
        <div class="col-12">
            <div class="box no-shadow mb-0 bg-transparent">
                <div class="box-header no-border px-0">
                    <h4 class="section-title">Perencanaan - Dokumen Pengadaan</h4>
                </div>
            </div>
        </div>
    </div>

    <hr />

    <div class="row">
        @php
            $jenisSurat = [
                ['label' => 'Pengadaan Langsung', 'slug' => 'spbj', 'deskripsi' => 'Menampilkan diagram struktur organisasi perusahaan.', 'img' => 'Pipe9.svg'],
                ['label' => 'Penunjukan Langsung', 'slug' => 'sppbj', 'deskripsi' => 'Menampilkan data pekerja.', 'img' => 'Pipe10.svg'],
                ['label' => 'Tender', 'slug' => 'spmk', 'deskripsi' => 'Memantau status kontrak perusahaan.', 'img' => 'Pipe11.svg'],
                ['label' => 'Seleksi', 'slug' => 'seleksi', 'deskripsi' => 'Menampilkan kalender acara penting organisasi.', 'img' => 'Pipe12.svg'],
                ['label' => 'Barang', 'slug' => 'barang', 'deskripsi' => 'Informasi isu utama yang perlu perhatian.', 'img' => 'Pipe13.svg'],
            ];
        @endphp

        @foreach($jenisSurat as $jenis)
        <div class="col-xl-4 col-md-6 col-12">
            <a href="{{ route('surat.byJenis', $jenis['slug']) }}">
                <div class="box bg-white pull-up animate__animated animate__fadeInUp" style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">(MDP) – {{ $jenis['label'] }}</h6>
                            <p class="text-fade mb-0 fs-12">{{ $jenis['deskripsi'] }}</p>
                        </div>
                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="/images/svg-icon/color-svg/{{ $jenis['img'] }}" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

  
</div>

@endsection
