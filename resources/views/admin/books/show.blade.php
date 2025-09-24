@extends('admin.layouts.app')

@section('title', 'Book Details')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="page-title">── {{ $book->title }}</h1>
                <div class="d-flex">
                    <a href="{{ route('admin.books.edit', $book) }}" class="cta-button me-2">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('admin.books.index') }}" class="cta-button">
                        Back <i class="bi bi-arrow-right"></i> 
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Row pertama: Cover buku dan informasi buku dengan tinggi sama -->
    <div class="row mb-4">
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex">
                    <!-- Cover Image Section -->
                    <div class="cover-section me-3">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" 
                                 alt="{{ $book->title }}"
                                 class="cover-image rounded"> 
                        @else
                            <div class="cover-placeholder bg-light d-flex align-items-center justify-content-center rounded">
                                <i class="bi bi-book fs-1 text-muted"></i>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Book Details Section -->
                    <div class="book-details-section d-flex flex-column justify-content-center flex-grow-1">
                        <h5 class="mb-3">{{ $book->title }}</h5>
                        <p class="text-muted mb-2">by {{ $book->author ? $book->author->nama : 'Unknown Author' }}</p>
                        @if($book->publisher)
                            <p class="text-muted mb-3">Penerbit: {{ $book->publisher->nama }}</p>
                        @endif
                        <h4 class="mb-0" style="color: #710014">Rp {{ number_format((float) $book->price, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Buku</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        @if($book->isbn)
                            <tr>
                                <td><strong>ISBN:</strong></td>
                                <td>{{ $book->isbn }}</td>
                            </tr>
                        @endif
                        @if($book->author)
                            <tr>
                                <td><strong>Penulis:</strong></td>
                                <td><span class="badge" style="background-color: var(--primary-color); color: white;">{{ $book->author->nama }}</span></td>
                            </tr>
                        @endif
                        @if($book->publisher)
                            <tr>
                                <td><strong>Penerbit:</strong></td>
                                <td><span class="badge" style="background-color: var(--primary-color); color: white;">{{ $book->publisher->nama }}</span></td>
                            </tr>
                        @endif
                        <tr>
                            <td><strong>Kategori:</strong></td>
                            <td><span class="badge" style="background-color: var(--primary-color); color: white;">{{ $book->category->name }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Penjualan:</strong></td>
                            <td><span class="badge" style="background-color: var(--primary-color); color: white;">{{ $book->sales_count ?? 0 }} terjual</span></td>
                        </tr>
                        <tr>
                            <td><strong>File:</strong></td>
                            <td>
                                @if($book->file_path)
                                    <span class="badge" style="background-color: var(--primary-color); color: white;">
                                        <i class="bi bi-file-earmark-pdf me-1"></i>
                                        <a href="{{ Storage::url($book->file_path) }}" 
                                           style="color: white; text-decoration: none;" 
                                           target="_blank">PDF Tersedia</a>
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-file-earmark-x me-1"></i>Tidak ada file
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Created:</strong></td>
                            <td>{{ $book->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated:</strong></td>
                            <td>{{ $book->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Deskripsi Buku</h5>
                </div>
                <div class="card-body">
                    <p style="text-align: justify; line-height: 1.6;">{{ $book->description }}</p>
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
        }

    .cover-section {
        flex-shrink: 0;
        width: 120px;
    }

    .cover-image {
        margin-top: 60px;
        width: 120px;
        height: 180px;
        object-fit: cover;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .cover-placeholder {
        width: 120px;
        height: 180px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .book-details-section h5 {
        font-weight: 600;
        color: #333;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
    }

    .badge a {
        color: inherit !important;
        text-decoration: none !important;
    }

    .badge a:hover {
        text-decoration: underline !important;
    }
</style>