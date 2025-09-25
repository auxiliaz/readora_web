@extends('admin.layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="page-title">── {{ $category->name }}</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.categories.edit', $category) }}" class="cta-button">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('admin.categories.index') }}" class="cta-button">
                    Kembali <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Kategori</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Nama:</strong></td>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Buku:</strong></td>
                        <td><span class="badge" style="background-color: var(--primary-color); color: white;">{{ $category->books->count() }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Dibuat:</strong></td>
                        <td>{{ $category->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Diperbarui:</strong></td>
                        <td>{{ $category->updated_at->format('M d, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Buku dalam Kategori Ini</h5>
                <a href="{{ route('admin.books.create') }}?category={{ $category->id }}" class="cta-button btn-sm">
                    <i class="bi bi-plus"></i> Tambah Buku
                </a>
            </div>
            <div class="card-body">
                @if($category->books->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Harga</th>
                                    <th>Penjualan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->books as $book)
                                    <tr>
                                        <td>
                                            <strong>{{ $book->title }}</strong>
                                        </td>
                                        <td>{{ $book->author ? $book->author->nama : 'Unknown Author' }}</td>
                                        <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge" style="background-color: #710014">{{ $book->sales_count ?? 0 }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.books.show', $book) }}" 
                                                   class="btn btn-outline" style="border-color: #710014; color: #710014;">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.books.edit', $book) }}" 
                                                   class="btn btn-outline" style="border-color: #710014; color: #710014;">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-book fs-1 d-block mb-3"></i>
                        <h5>Belum ada buku dalam kategori ini</h5>
                        <p>Mulai dengan menambahkan beberapa buku ke kategori ini.</p>
                        <a href="{{ route('admin.books.create') }}?category={{ $category->id }}" class="cta-button">
                            <i class="bi bi-plus-circle"></i> Tambah Buku Pertama
                        </a>
                    </div>
                @endif
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

    .cta-button.btn-sm {
        padding: 8px 16px;
        font-size: 0.875rem;
    }
</style>
