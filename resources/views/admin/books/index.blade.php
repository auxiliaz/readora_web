@extends('admin.layouts.app')

@section('title', 'Books')

@section('content')
<style>
     .pagination {
            margin-top: -10px;
        }
        
        .pagination .page-item {
            margin: 0 3px;
        }
        
        .pagination .page-link {
            color: var(--primary-color);
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 0.5rem 0.9rem;
            font-size: 0.9rem;
            min-width: 38px;
            text-align: center;
            transition: all 0.2s ease;
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .pagination .page-link:hover {
            background-color: #f8f9fa;
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            border-color: #ddd;
        }
        
        /* Responsive pagination */
        @media (max-width: 576px) {
            .pagination .page-link {
                padding: 0.4rem 0.7rem;
                font-size: 0.85rem;
                min-width: 34px;
            }
            
            .pagination .page-item {
                margin: 0 2px;
            }
        }

        /* Modern Card Styles */
        .modern-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .modern-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #710014;
            margin-bottom: 0;
        }

        /* Modern Table Styles */
        .modern-table {
            border: none;
        }
        .modern-table tbody tr {
            border-bottom: 1px solid #f1f3f4;
            transition: all 0.2s ease;
        }

        .modern-table tbody tr:hover {
            background-color: #f8f9ff;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .modern-table tbody td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
            border: none;
        }

        /* Book Cover Styles */
        .book-cover-container {
            position: relative;
            width: 55px;
            height: 75px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .book-cover-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .book-cover-container:hover .book-cover-img {
            transform: scale(1.05);
        }

        .book-cover-placeholder {
            width: 55px;
            height: 75px;
            background: linear-gradient(135deg, #710014 0%, #8b1538 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(113, 0, 20, 0.3);
        }

        /* Book Info Styles */
        .book-info {
            max-width: 250px;
        }

        .book-title {
            font-weight: 500;
            color: #000;
            font-size: 1rem;
            line-height: 1.3;
        }

        .book-description {
            color: #718096;
            font-size: 0.85rem;
            line-height: 1.4;
        }

        .author-name {
            color: #000;
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* Badge Styles */
        .category-badge {
            background: linear-gradient(135deg, #710014 0%, #710014 100%);
            color: white;
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .sales-badge {
            background: linear-gradient(135deg, #710014 0%, #710014 100%);
            color: white;
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .price-text {
            font-weight: 400;
            color: #000;
            font-size: 0.95rem;
        }

        .date-text {
            color: #000;
            font-size: 0.9rem;
        }

        /* Action Buttons */
        .categories-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .categories-btn {
            border: none;
            border-radius: 8px;
            padding: 0.4rem 0.6rem;
            transition: all 0.2s ease;
            font-size: 0.85rem;
        }

        .categories-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 2px solid #710014;
        }

        .btn-categories {
            background: #F2F1ED;
            border: 2px solid #710014;
            color: #710014;
        }

        /* Empty State */
        .empty-state {
            padding: 3rem 2rem;
        }

        .empty-state i {
            display: block;
            margin-bottom: 1rem;
        }

        /* Filter Dropdown */
        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            border-radius: 12px;
            padding: 0.5rem 0;
        }

        .dropdown-item {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9ff;
            color: #710014;
        }

        .dropdown-item i {
            width: 16px;
        }
</style>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="page-title"><i class="bi bi-book-fill me-2"></i>Books Management</h1>
            <div class="d-flex gap-2 align-items-center">
                <!-- Filter Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-funnel"></i> Sort By
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                        <li><a class="dropdown-item" href="?sort=title"><i class="bi bi-sort-alpha-down me-2"></i>Title A-Z</a></li>
                        <li><a class="dropdown-item" href="?sort=title_desc"><i class="bi bi-sort-alpha-up me-2"></i>Title Z-A</a></li>
                        <li><a class="dropdown-item" href="?sort=price"><i class="bi bi-sort-numeric-down me-2"></i>Price Low-High</a></li>
                        <li><a class="dropdown-item" href="?sort=price_desc"><i class="bi bi-sort-numeric-up me-2"></i>Price High-Low</a></li>
                        <li><a class="dropdown-item" href="?sort=created_at"><i class="bi bi-calendar me-2"></i>Newest First</a></li>
                        <li><a class="dropdown-item" href="?sort=created_at_desc"><i class="bi bi-calendar2 me-2"></i>Oldest First</a></li>
                        <li><a class="dropdown-item" href="?sort=sales"><i class="bi bi-graph-up me-2"></i>Best Selling</a></li>
                    </ul>
                </div>
                
                <!-- Export Button -->
                <button class="btn btn-primary" onclick="exportBooks()">
                    <i class="bi bi-download"></i> Export
                </button>
                
                <!-- Add Book Button -->
                <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Buku
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card modern-card">
            <div class="card-body pt-3">
                <div class="table-responsive">
                    <table class="table table-hover modern-table">
                        <thead style="border-bottom: 2px solid #710014; font-family: 'Playfair Display', serif; font-weight: 800;">
                            <tr>
                                <th class="border-0">Cover</th>
                                <th class="border-0">Title</th>
                                <th class="border-0">Author</th>
                                <th class="border-0">Category</th>
                                <th class="border-0">Price</th>
                                <th class="border-0">Sales</th>
                                <th class="border-0">Created</th>
                                <th class="border-0 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $book)
                                <tr>
                                    <td>
                                        @if($book->cover_image)
                                            <div class="book-cover-container">
                                                <img src="{{ $book->cover_image }}" 
                                                     alt="{{ $book->title }}" 
                                                     class="book-cover-img">
                                            </div>
                                        @else
                                            <div class="book-cover-placeholder">
                                                <i class="bi bi-book"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="book-info">
                                            <h6 class="book-title mb-1">{{ $book->title }}</h6>
                                            <p class="book-description mb-0">{{ Str::limit($book->description, 50) }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="author-name">{{ $book->author }}</span>
                                    </td>
                                    <td>
                                        <span class="badge category-badge">{{ $book->category->name }}</span>
                                    </td>
                                    <td>
                                        <span class="price-text">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <span class="badge sales-badge">{{ $book->sales_count ?? 0 }} sold</span>
                                    </td>
                                    <td>
                                        <span class="date-text">{{ $book->created_at->format('M d, Y') }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="categories-buttons">
                                            <a href="{{ route('admin.books.show', $book) }}" 
                                               class="btn-categories btn-sm categories-btn" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.books.edit', $book) }}" 
                                               class="btn-categories btn-sm categories-btn" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form method="POST" 
                                                  action="{{ route('admin.books.destroy', $book) }}" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this book?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-categories btn-sm categories-btn" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="bi bi-book fs-1 text-muted mb-3"></i>
                                            <h5 class="text-muted">No books found</h5>
                                            <p class="text-muted mb-3">Start building your library by adding your first book</p>
                                            <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                                                <i class="bi bi-plus-circle me-1"></i>Add your first book
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination yang diperbaiki -->
                    @if($books->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($books->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $books->previousPageUrl() }}" rel="prev">&laquo;</a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                                        @if ($page == $books->currentPage())
                                            <li class="page-item active" aria-current="page">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($books->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $books->nextPageUrl() }}" rel="next">&raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function exportBooks() {
    // Simple CSV export functionality
    const table = document.querySelector('.modern-table');
    const rows = table.querySelectorAll('tr');
    let csvContent = '';
    
    // Add headers
    const headers = ['Title', 'Author', 'Category', 'Price', 'Sales', 'Created'];
    csvContent += headers.join(',') + '\n';
    
    // Add data rows (skip header row and empty state row)
    rows.forEach((row, index) => {
        if (index === 0 || row.querySelector('.empty-state')) return;
        
        const cells = row.querySelectorAll('td');
        if (cells.length < 8) return;
        
        const title = cells[1].querySelector('.book-title')?.textContent.trim() || '';
        const author = cells[2].querySelector('.author-name')?.textContent.trim() || '';
        const category = cells[3].querySelector('.category-badge')?.textContent.trim() || '';
        const price = cells[4].querySelector('.price-text')?.textContent.trim() || '';
        const sales = cells[5].querySelector('.sales-badge')?.textContent.trim() || '';
        const created = cells[6].querySelector('.date-text')?.textContent.trim() || '';
        
        const rowData = [title, author, category, price, sales, created];
        csvContent += rowData.map(field => `"${field}"`).join(',') + '\n';
    });
    
    // Create and download file
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', `books_export_${new Date().toISOString().split('T')[0]}.csv`);
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    // Show success message
    const toast = document.createElement('div');
    toast.className = 'alert alert-success position-fixed';
    toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    toast.innerHTML = '<i class="bi bi-check-circle me-2"></i>Books exported successfully!';
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}
</script>
@endpush
