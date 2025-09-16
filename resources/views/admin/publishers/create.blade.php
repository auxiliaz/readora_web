@extends('admin.layouts.app')

@section('title', 'Tambah Penerbit')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Tambah Penerbit</h1>
            <a href="{{ route('admin.publishers.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Penerbit
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Penerbit</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.publishers.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Penerbit <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" 
                               name="nama" 
                               value="{{ old('nama') }}" 
                               required 
                               autofocus
                               placeholder="Masukkan nama penerbit">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Masukkan nama lengkap penerbit (contoh: Gramedia Pustaka Utama, Mizan, dll.)</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Tambah Penerbit
                        </button>
                        <a href="{{ route('admin.publishers.index') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="bi bi-lightbulb text-warning"></i>
                        Gunakan nama resmi penerbit
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-lightbulb text-warning"></i>
                        Nama penerbit harus unik
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-lightbulb text-warning"></i>
                        Pastikan ejaan nama sudah benar
                    </li>
                    <li>
                        <i class="bi bi-lightbulb text-warning"></i>
                        Gunakan nama yang dikenal pembaca
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
