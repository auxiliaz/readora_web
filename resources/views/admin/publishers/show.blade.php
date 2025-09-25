@extends('admin.layouts.app')

@section('title', 'Detail Penerbit')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="page-title">── {{ $publisher->nama }}</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.publishers.edit', $publisher) }}" class="cta-button">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('admin.publishers.index') }}" class="cta-button">
                    Kembali <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi Penerbit</h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center text-white" 
                         style="width: 80px; height: 80px; font-size: 2rem; background-color: var(--primary-color);">
                        <i class="bi bi-building"></i>
                    </div>
                    <h4 class="mt-3 mb-1">{{ $publisher->nama }}</h4>
                    <p class="text-muted">Penerbit</p>
                </div>

                <hr>

                <ul class="list-unstyled mb-0">
                    <li class="mb-3">
                        <strong>ID:</strong> #{{ $publisher->id }}
                    </li>
                    <li class="mb-3">
                        <strong>Nama:</strong> {{ $publisher->nama }}
                    </li>
                    <li class="mb-3">
                        <strong>Jumlah Buku:</strong> 
                        <span class="badge" style="background-color: var(--primary-color); color: white;">{{ $publisher->books->count() }} buku</span>
                    </li>
                    <li class="mb-3">
                        <strong>Bergabung:</strong> {{ $publisher->created_at->format('d M Y') }}
                    </li>
                    <li>
                        <strong>Terakhir Diperbarui:</strong> {{ $publisher->updated_at->format('d M Y H:i') }}
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Buku</h5>
                <span class="badge bg-secondary">{{ $publisher->books->count() }} buku</span>
            </div>
            <div class="card-body">
                @if($publisher->books->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Penjualan</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($publisher->books as $book)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($book->cover_image && file_exists(storage_path('app/public/' . $book->cover_image)))
                                                    <img src="{{ asset('storage/' . $book->cover_image) }}" 
                                                         alt="{{ $book->title }}" 
                                                         class="me-3 rounded" 
                                                         style="width: 60px; height: 90px; object-fit: cover; margin-bottom: 15px;"
                                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                    </div>
                                                @else
                                                    <div class="bg-light border rounded me-3 d-flex align-items-center justify-content-center" 
                                                         style="width: 40px; height: 50px;">
                                                        <i class="bi bi-book text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $book->title ?? 'Unknown Title' }}</h6>
                                                    <small class="text-muted">{{ $book->description ? Str::limit($book->description, 50) : 'No description available' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($book->category)
                                                <span class="badge" style="background-color: var(--primary-color); color: white;">{{ $book->category->name }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($book->price ?? 0, 0, ',', '.') }}</td>
                                        <td>{{ $book->sales_count ?? 0 }}</td>
                                        <td>{{ $book->created_at ? $book->created_at->format('d M Y') : '-' }}</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('admin.books.show', $book) }}" 
                                                   class="btn btn-sm btn-outline" style="border-color: #710014; color: #710014; title="Lihat">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.books.edit', $book) }}" 
                                                   class="btn btn-sm btn-outline" style="border-color: #710014; color: #710014; title="Edit">
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
                    <div class="text-center py-5">
                        <i class="bi bi-book fs-1 text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Buku</h5>
                        <p class="text-muted mb-3">Penerbit ini belum memiliki buku yang terdaftar</p>
                        <a href="{{ route('admin.books.create') }}" class="cta-button">
                            <i class="bi bi-plus-circle me-1"></i>Tambah Buku
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
</style>
