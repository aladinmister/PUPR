@extends('layouts.app')
@section('content')

<div class="container">
    <h4 class="mb-3">Buat Surat - Jenis: {{ strtoupper($jenis) }}</h4>

    <form method="POST" action="{{ route('surat.store') }}">
        @csrf

        <input type="hidden" name="jenis_surat" value="{{ $jenis }}">

        <div class="form-group">
            <label for="judul_surat">Judul Surat</label>
            <input type="text" name="judul_surat" id="judul_surat" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan & Export</button>
    </form>
</div>

@endsection
