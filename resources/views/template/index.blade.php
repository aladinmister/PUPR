@extends('layouts.app')
@section('content')

{{-- SweetAlert & jQuery --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Manajemen Template Surat</h4>
            <button class="btn btn-light text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modalUploadTemplate">
                <i class="fas fa-upload"></i> Upload Template
            </button>
        </div>
        <div class="card-body">

            <h5 class="mt-2 mb-3">Daftar Template</h5>
            <div class="table-responsive">
                <table id="templateTable" class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama File</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($templates as $i => $t)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $t->original_name ?? basename($t->file_path) }}</td>
                                <td>
                                    @if($t->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-{{ $t->is_active ? 'danger' : 'primary' }}" onclick="confirmActivate({{ $t->id }}, {{ $t->is_active ? 'true' : 'false' }})">
                                        {{ $t->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>

                                 
                                    <a href="{{ asset('storage/' . $t->file_path) }}" class="btn btn-sm btn-info mt-1" download>Download</a>
                                    <button class="btn btn-sm btn-danger mt-1" onclick="confirmDelete({{ $t->id }})">Delete</button>

                                    <form id="delete-form-{{ $t->id }}" action="{{ route('template.delete', $t->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <form id="activate-form-{{ $t->id }}" action="{{ route('template.activate', $t->id) }}" method="GET" class="d-none">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- Modal Upload Template --}}
<div class="modal fade" id="modalUploadTemplate" tabindex="-1" aria-labelledby="modalUploadTemplateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <form method="POST" action="{{ route('template.upload') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalUploadTemplateLabel">Upload Template Baru</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file" class="form-label">Pilih File Template (.xlsx)</label>
                        <input type="file" name="file" class="form-control" required accept=".xlsx">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SweetAlert Notifikasi --}}
@if (session('success') || session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                title: @json(session('success') ? 'Berhasil!' : 'Gagal!'),
                text: @json(session('success') ?? session('error')),
                icon: @json(session('success') ? 'success' : 'error'),
                confirmButtonText: 'Tutup'
            });
        });
    </script>
@endif

{{-- SweetAlert Konfirmasi Delete dan Aktivasi --}}
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Template?',
            text: 'Template akan dihapus permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    function confirmActivate(id, isActive) {
        if (!isActive) {
            Swal.fire({
                title: 'Aktifkan Template?',
                text: 'Template yang lain akan dinonaktifkan.',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya, Aktifkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('activate-form-' + id).submit();
                }
            });
        } else {
            Swal.fire({
                title: 'Nonaktifkan Template?',
                text: 'Anda yakin ingin menonaktifkan template ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Nonaktifkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('activate-form-' + id).submit();
                }
            });
        }
    }
</script>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#templateTable').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
            }
        });
    });
</script>
@endpush
