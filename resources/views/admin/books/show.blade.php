@extends('admin.layouts.app')

@section('title', 'Book Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ $book->title }}</h1>
            <div class="btn-group">
                <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-warning">
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
                    <img src="{{ $book->cover_image }}" 
                         alt="{{ $book->title }}" 
                         class="img-fluid mb-3 rounded"
                         style="max-height: 300px;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center mb-3 rounded" 
                         style="height: 300px;">
                        <i class="bi bi-book fs-1 text-muted"></i>
                    </div>
                @endif
                
                <h5>{{ $book->title }}</h5>
                <p class="text-muted">by {{ $book->author }}</p>
                <h4 class="text-primary">Rp {{ number_format($book->price, 0, ',', '.') }}</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Book Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td><strong>Category:</strong></td>
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
                                <a href="{{ Storage::url($book->file_path) }}" 
                                   class="btn btn-sm btn-outline-primary" 
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

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Reviews ({{ $book->reviews->count() }})</h5>
                @if($book->reviews->count() > 0)
                    <div class="d-flex align-items-center">
                        <span class="me-2">Average Rating:</span>
                        <div class="me-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= round($book->average_rating) ? '-fill' : '' }} text-warning"></i>
                            @endfor
                        </div>
                        <span class="badge bg-info">{{ number_format($book->average_rating, 1) }}</span>
                    </div>
                @endif
            </div>
            <div class="card-body">
                @if($book->reviews->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Rating</th>
                                    <th>Review</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($book->reviews as $review)
                                    <tr>
                                        <td>{{ $review->user->name }}</td>
                                        <td>
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }} text-warning"></i>
                                            @endfor
                                        </td>
                                        <td>{{ Str::limit($review->review_text, 100) }}</td>
                                        <td>{{ $review->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <form method="POST" 
                                                  action="{{ route('admin.reviews.destroy', $review) }}" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this review?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-star fs-1 d-block mb-2"></i>
                        <p>No reviews yet for this book.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
