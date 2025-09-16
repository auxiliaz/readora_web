@extends('admin.layouts.app')

@section('title', 'Penerbit')

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

        /* Publisher Specific Styles */
        .publisher-id {
            font-weight: 500;
            color: #000;
            font-size: 0.9rem;
        }

        .publisher-info {
            max-width: 200px;
        }

        .publisher-name {
            font-weight: 500;
            color: #000;
            font-size: 1rem;
            line-height: 1.3;
        }

        .books-count-badge {
            background: linear-gradient(135deg, #710014 0%, #710014 100%);
            color: white;
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .date-text {
            color: #000;
            font-size: 0.9rem;
        }

        /* Action Buttons */
        .publishers-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .publishers-btn {
            border: none;
            border-radius: 8px;
            padding: 0.4rem 0.6rem;
            transition: all 0.2s ease;
            font-size: 0.85rem;
        }

        .publishers-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 2px solid #710014;
        }

        .btn-publishers {
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
            <h1 class="page-title"><i class="bi bi-building me-2"></i>Manajemen Penerbit</h1>
            <div class="d-flex gap-2 align-items-center">
                <!-- Filter Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-funnel"></i> Urutkan
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                        <li><a class="dropdown-item" href="?sort=nama"><i class="bi bi-sort-alpha-down me-2"></i>Nama A-Z</a></li>
                        <li><a class="dropdown-item" href="?sort=nama_desc"><i class="bi bi-sort-alpha-up me-2"></i>Nama Z-A</a></li>
                        <li><a class="dropdown-item" href="?sort=books_count"><i class="bi bi-sort-numeric-down me-2"></i>Terbanyak Buku</a></li>
                        <li><a class="dropdown-item" href="?sort=books_count_desc"><i class="bi bi-sort-numeric-up me-2"></i>Tersedikit Buku</a></li>
                        <li><a class="dropdown-item" href="?sort=created_at"><i class="bi bi-calendar me-2"></i>Terbaru</a></li>
                        <li><a class="dropdown-item" href="?sort=created_at_desc"><i class="bi bi-calendar2 me-2"></i>Terlama</a></li>
                    </ul>
                </div>
                
                <!-- Export Button -->
                <button class="btn btn-primary" onclick="exportPublishers()">
                    <i class="bi bi-download"></i> Ekspor
                </button>
                
                <!-- Add Publisher Button -->
                <a href="{{ route('admin.publishers.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Penerbit
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
                                <th class="border-0">ID</th>
                                <th class="border-0">Nama</th>
                                <th class="border-0">Jumlah Buku</th>
                                <th class="border-0">Dibuat</th>
                                <th class="border-0 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($publishers as $publisher)
                                <tr>
                                    <td>
                                        <span class="publisher-id">#{{ $publisher->id }}</span>
                                    </td>
                                    <td>
                                        <div class="publisher-info">
                                            <h6 class="publisher-name mb-0">{{ $publisher->nama }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge books-count-badge">{{ $publisher->books_count }} buku</span>
                                    </td>
                                    <td>
                                        <span class="date-text">{{ $publisher->created_at->format('d M Y') }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="publishers-buttons">
                                            <a href="{{ route('admin.publishers.show', $publisher) }}" 
                                               class="btn-publishers btn-sm publishers-btn" title="Lihat">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.publishers.edit', $publisher) }}" 
                                               class="btn-publishers btn-sm publishers-btn" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form method="POST" 
                                                  action="{{ route('admin.publishers.destroy', $publisher) }}" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus penerbit ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-publishers btn-sm publishers-btn" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="bi bi-building fs-1 text-muted mb-3"></i>
                                            <h5 class="text-muted">Tidak ada penerbit ditemukan</h5>
                                            <p class="text-muted mb-3">Mulai dengan menambahkan penerbit pertama Anda</p>
                                            <a href="{{ route('admin.publishers.create') }}" class="btn btn-primary">
                                                <i class="bi bi-plus-circle me-1"></i>Tambah penerbit pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                    @if($publishers->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($publishers->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $publishers->previousPageUrl() }}" rel="prev">&laquo;</a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($publishers->getUrlRange(1, $publishers->lastPage()) as $page => $url)
                                        @if ($page == $publishers->currentPage())
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
                                    @if ($publishers->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $publishers->nextPageUrl() }}" rel="next">&raquo;</a>
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
function exportPublishers() {
    // Simple CSV export functionality
    const table = document.querySelector('.modern-table');
    const rows = table.querySelectorAll('tr');
    let csvContent = '';
    
    // Add headers
    const headers = ['ID', 'Nama', 'Jumlah Buku', 'Dibuat'];
    csvContent += headers.join(',') + '\n';
    
    // Add data rows (skip header row and empty state row)
    rows.forEach((row, index) => {
        if (index === 0 || row.querySelector('.empty-state')) return;
        
        const cells = row.querySelectorAll('td');
        if (cells.length < 5) return;
        
        const id = cells[0].querySelector('.publisher-id')?.textContent.trim() || '';
        const name = cells[1].querySelector('.publisher-name')?.textContent.trim() || '';
        const booksCount = cells[2].querySelector('.books-count-badge')?.textContent.trim() || '';
        const created = cells[3].querySelector('.date-text')?.textContent.trim() || '';
        
        const rowData = [id, name, booksCount, created];
        csvContent += rowData.map(field => `"${field}"`).join(',') + '\n';
    });
    
    // Create and download file
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', `publishers_export_${new Date().toISOString().split('T')[0]}.csv`);
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    // Show success message
    const toast = document.createElement('div');
    toast.className = 'alert alert-success position-fixed';
    toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    toast.innerHTML = '<i class="bi bi-check-circle me-2"></i>Data penerbit berhasil diekspor!';
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}
</script>
@endpush
