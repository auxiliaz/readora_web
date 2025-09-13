@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Edit Category</h1>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Category Information</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $category->name) }}" 
                               required 
                               autofocus
                               placeholder="Enter category name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Choose a descriptive name for the category</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Category
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Category Details</h6>
            </div>
            <div class="card-body">
                <p><strong>Created:</strong> {{ $category->created_at->format('M d, Y H:i') }}</p>
                <p><strong>Last Updated:</strong> {{ $category->updated_at->format('M d, Y H:i') }}</p>
                <p><strong>Books in Category:</strong> {{ $category->books()->count() }}</p>
            </div>
        </div>

        @if($category->books()->count() > 0)
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Warning</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-warning mb-0">
                    <i class="bi bi-exclamation-triangle"></i>
                    This category has {{ $category->books()->count() }} book(s) assigned to it. 
                    Changing the name will affect all associated books.
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
