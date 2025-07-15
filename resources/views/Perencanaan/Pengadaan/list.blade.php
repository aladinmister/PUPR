@extends('layouts.app')

@section('content')

{{-- SweetAlert & jQuery --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    .blink-highlight {
        animation: blink 1s ease-in-out infinite alternate;
        background-color: #ffef96 !important;
    }

    @keyframes blink {
        from { background-color: #fff6b0; }
        to { background-color: #ffef96; }
    }

    .judul-tabel {
        color: #000000;
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 15px;
    }

    th {
        color: #000 !important;
        font-weight: bold !important;
        background-color: #eaeaea !important;
    }
</style>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Daftar Surat - Jenis: {{ strtoupper($jenis) }}</h4>
            <button class="btn btn-light text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahSurat">
                <i class="fas fa-plus-circle"></i> Tambah Surat
            </button>
        </div>
        <div class="card-body">

            {{-- Judul Tabel --}}
            <div class="judul-tabel">Tabel Daftar Surat - {{ strtoupper($jenis) }}</div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable">
                    <thead class="table-light">
                        <tr>
                            <th class="text-dark fw-bold">#</th>
                            <th class="text-dark fw-bold">Judul Surat</th>
                            <th class="text-dark fw-bold">Tanggal Dibuat</th>
                            <th class="text-dark fw-bold">Export</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($listSurat->sortByDesc('created_at') as $index => $surat)
                            <tr id="row-{{ $surat->id }}" class="{{ session('highlight_id') == $surat->id ? 'blink-highlight' : '' }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $surat->judul_surat }}</td>
                                <td>{{ $surat->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('surat.export', $surat->id) }}" class="btn btn-success btn-sm" target="_blank">
                                        Export Excel
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada surat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('surat.index') }}" class="btn btn-secondary mt-4">Kembali</a>
        </div>
    </div>
</div>

{{-- Modal Tambah Surat --}}
<div class="modal fade" id="modalTambahSurat" tabindex="-1" aria-labelledby="modalTambahSuratLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <form action="{{ route('surat.store') }}" method="POST">
                @csrf
                <input type="hidden" name="jenis_surat" value="{{ $jenis }}">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Surat</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul_surat">Judul Surat</label>
                        <input type="text" name="judul_surat" id="judul_surat" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SweetAlert --}}
@if (session('success') || session('error') || session('warning'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                title: @json(session('success') ? 'Berhasil!' : (session('error') ? 'Gagal!' : 'Peringatan')),
                text: @json(session('success') ?? session('error') ?? session('warning')),
                icon: @json(session('success') ? 'success' : (session('error') ? 'error' : 'warning')),
                confirmButtonText: 'Tutup'
            });
        });
    </script>
@endif

{{-- Scroll & Highlight --}}
@if(session('highlight_id'))
    @push('scripts')
    <script>
        $(document).ready(function () {
            const highlightId = '{{ session('highlight_id') }}';
            const row = document.getElementById('row-' + highlightId);
            if (row) {
                $('#dataTable').DataTable().rows().every(function () {
                    if ($(this.node()).attr('id') === 'row-' + highlightId) {
                        row.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                });
            }
        });
    </script>
    @endpush
@endif

{{-- DataTables --}}
@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            responsive: true,
            autoWidth: false,
            ordering: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            }
        });
    });
</script>
@endpush

@endsection
