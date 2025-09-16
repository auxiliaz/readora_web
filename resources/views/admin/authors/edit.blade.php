@extends('admin.layouts.app')

@section('title', 'Edit Penulis')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Edit Penulis</h1>
            <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Penulis
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Penulis</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.authors.update', $author) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Penulis <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" 
                               name="nama" 
                               value="{{ old('nama', $author->nama) }}" 
                               required 
                               autofocus
                               placeholder="Masukkan nama penulis">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Masukkan nama lengkap penulis (contoh: Tere Liye, Andrea Hirata, dll.)</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Perbarui Penulis
                        </button>
                        <a href="{{ route('admin.authors.index') }}" class="btn btn-outline-secondary">
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
                <h6 class="mb-0">Informasi</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <strong>ID:</strong> #{{ $author->id }}
                    </li>
                    <li class="mb-2">
                        <strong>Jumlah Buku:</strong> {{ $author->books()->count() }} buku
                    </li>
                    <li class="mb-2">
                        <strong>Dibuat:</strong> {{ $author->created_at->format('d M Y H:i') }}
                    </li>
                    <li>
                        <strong>Diperbarui:</strong> {{ $author->updated_at->format('d M Y H:i') }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="bi bi-lightbulb text-warning"></i>
                        Gunakan nama lengkap penulis
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-lightbulb text-warning"></i>
                        Nama penulis harus unik
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
