@extends('admin.layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="page-title">── Edit Kategori</h1>
            <a href="{{ route('admin.categories.index') }}" class="cta-button">
                Kembali <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Kategori</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $category->name) }}" 
                               required 
                               autofocus
                               placeholder="Masukkan nama kategori">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Pilih nama yang deskriptif untuk kategori</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="cta-button">
                            <i class="bi bi-check-circle"></i> Perbarui Kategori
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="cta-button">
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
