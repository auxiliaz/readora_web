@extends('admin.layouts.app')

@section('title', 'Book Details')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="page-title">── {{ $book->title }}</h1>
                <div class="d-flex">
                    <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-primary me-2">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    @if($book->cover_image)
                        <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" class="img-fluid mb-3 rounded"
                            style="max-height: 300px;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center mb-3 rounded"
                            style="height: 300px;">
                            <i class="bi bi-book fs-1 text-muted"></i>
                        </div>
                    @endif

                    <h5>{{ $book->title }}</h5>
                    <p class="text-muted">by {{ $book->author ?? ($book->authorRelation ? $book->authorRelation->nama : 'Unknown Author') }}</p>
                    @if($book->publisher)
                        <p class="text-muted">Penerbit: {{ $book->publisher->nama }}</p>
                    @endif
                    <h4 class="text-primary">Rp {{ number_format((float)$book->price, 0, ',', '.') }}</h4>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">Book Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        @if($book->isbn)
                        <tr>
                            <td><strong>ISBN:</strong></td>
                            <td>{{ $book->isbn }}</td>
                        </tr>
                        @endif
                        @if($book->authorRelation)
                        <tr>
                            <td><strong>Penulis:</strong></td>
                            <td><span class="badge bg-info">{{ $book->authorRelation->nama }}</span></td>
                        </tr>
                        @endif
                        @if($book->publisher)
                        <tr>
                            <td><strong>Penerbit:</strong></td>
                            <td><span class="badge bg-warning">{{ $book->publisher->nama }}</span></td>
                        </tr>
                        @endif
                        <tr>
                            <td><strong>Kategori:</strong></td>
                            <td><span class="badge bg-secondary">{{ $book->category->name }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Sales Count:</strong></td>
                            <td><span class="badge bg-success">{{ $book->sales_count ?? 0 }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>File:</strong></td>
                            <td>
                                @if($book->file_path)
                                    <a href="{{ Storage::url($book->file_path) }}" class="btn btn-sm btn-outline-primary"
                                        target="_blank">
                                        <i class="bi bi-download"></i> Download PDF
                                    </a>
                                @else
                                    <span class="text-muted">No file</span>
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

        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Description</h5>
                </div>
                <div class="card-body">
                    <p>{{ $book->description }}</p>
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
</style>