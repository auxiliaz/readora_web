@extends('admin.layouts.app')

@section('title', 'Edit Penerbit')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="page-title">── Edit Penerbit</h1>
            <a href="{{ route('admin.publishers.index') }}" class="cta-button">
                Kembali <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Penerbit</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.publishers.update', $publisher) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Penerbit <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" 
                               name="nama" 
                               value="{{ old('nama', $publisher->nama) }}" 
                               required 
                               autofocus
                               placeholder="Masukkan nama penerbit">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Masukkan nama lengkap penerbit (contoh: Gramedia Pustaka Utama, Mizan, dll.)</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="cta-button">
                            <i class="bi bi-check-circle"></i> Perbarui Penerbit
                        </button>
                        <a href="{{ route('admin.publishers.index') }}" class="cta-button">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

<style>
    .page-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #710014;
        margin-bottom: 0;
    }
    
    .cta-button {
        background: var(--primary-color);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
    }

    .cta-button:hover {
        background: #5a0010;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        color: white;
    }
</style>
