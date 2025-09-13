@extends('admin.layouts.app')

@section('title', 'Category Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ $category->name }}</h1>
            <div class="btn-group">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Category Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Books:</strong></td>
                        <td><span class="badge bg-info">{{ $category->books->count() }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Created:</strong></td>
                        <td>{{ $category->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Updated:</strong></td>
                        <td>{{ $category->updated_at->format('M d, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Books in this Category</h5>
                <a href="{{ route('admin.books.create') }}?category={{ $category->id }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> Add Book
                </a>
            </div>
            <div class="card-body">
                @if($category->books->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Price</th>
                                    <th>Sales</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->books as $book)
                                    <tr>
                                        <td>
                                            <strong>{{ $book->title }}</strong>
                                        </td>
                                        <td>{{ $book->author }}</td>
                                        <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ $book->sales_count ?? 0 }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.books.show', $book) }}" 
                                                   class="btn btn-outline-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.books.edit', $book) }}" 
                                                   class="btn btn-outline-warning">
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
                        <h5>No books in this category yet</h5>
                        <p>Start by adding some books to this category.</p>
                        <a href="{{ route('admin.books.create') }}?category={{ $category->id }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add First Book
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
