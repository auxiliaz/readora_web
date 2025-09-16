@extends('admin.layouts.app')

@section('title', 'Create Book')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="page-title">── Tambah Buku</h1>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                Back to Books <i class="bi bi-arrow-right"></i> 
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Book Information</h5>
            </div>
            <div class="card-body">
                <form id="bookForm" method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data" data-form-type="create">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   required 
                                   autofocus
                                   placeholder="Masukkan judul buku">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" 
                                   class="form-control @error('isbn') is-invalid @enderror" 
                                   id="isbn" 
                                   name="isbn" 
                                   value="{{ old('isbn') }}" 
                                   placeholder="Masukkan ISBN (opsional)">
                            @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Contoh: 978-602-03-1234-5</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="author_id" class="form-label">Penulis</label>
                        <select class="form-select @error('author_id') is-invalid @enderror" 
                                id="author_id" 
                                name="author_id">
                            <option value="">Pilih penulis</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" 
                                        {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                    {{ $author->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Pilih penulis dari daftar atau <a href="{{ route('admin.authors.create') }}" target="_blank">tambah penulis baru</a></div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  required
                                  placeholder="Enter book description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="publisher_id" class="form-label">Penerbit</label>
                        <select class="form-select @error('publisher_id') is-invalid @enderror" 
                                id="publisher_id" 
                                name="publisher_id">
                            <option value="">Pilih penerbit</option>
                            @foreach($publishers as $publisher)
                                <option value="{{ $publisher->id }}" 
                                        {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                                    {{ $publisher->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('publisher_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Pilih penerbit dari daftar atau <a href="{{ route('admin.publishers.create') }}" target="_blank">tambah penerbit baru</a></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Harga (IDR) <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   id="price" 
                                   name="price" 
                                   value="{{ old('price') }}" 
                                   required
                                   min="0"
                                   step="1000"
                                   placeholder="0">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    id="category_id" 
                                    name="category_id" 
                                    required>
                                <option value="">Pilih kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ old('category_id', request('category')) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Cover Image</label>
                        <input type="file" 
                               class="form-control @error('cover_image') is-invalid @enderror" 
                               id="cover_image" 
                               name="cover_image" 
                               accept="image/*">
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Upload an image file for the book cover (JPG, PNG, etc.)</div>
                    </div>

                    <div class="mb-3">
                        <label for="file_path" class="form-label">PDF File <span class="text-danger">*</span></label>
                        <input type="file" 
                               class="form-control @error('file_path') is-invalid @enderror" 
                               id="file_path" 
                               name="file_path" 
                               accept=".pdf"
                               required>
                        @error('file_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Upload the PDF file for this book (Max: 10MB)</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Create Book
                        </button>
                        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
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
                <h6 class="mb-0">Guidelines</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="bi bi-info-circle text-info"></i>
                        All fields marked with * are required
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-info-circle text-info"></i>
                        PDF file must be less than 10MB
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-info-circle text-info"></i>
                        Use descriptive titles and descriptions
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-info-circle text-info"></i>
                        Price should be in Indonesian Rupiah
                    </li>
                    <li>
                        <i class="bi bi-info-circle text-info"></i>
                        Cover image URL is optional but recommended
                    </li>
                </ul>
            </div>
        </div>

        @if($categories->isEmpty())
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0 text-warning">Notice</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-warning mb-0">
                    <i class="bi bi-exclamation-triangle"></i>
                    No categories available. 
                    <a href="{{ route('admin.categories.create') }}">Create a category first</a>.
                </div>
            </div>
        </div>
        @endif
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