<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Library - Readora</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #710014;
            --secondary-color: #B38F6F;
            --background-color: #F2F1ED;
            --text-color: #333;
            --light-gray: #f5f5f5;
            --medium-gray: #e0e0e0;
            --dark-gray: #9e9e9e;
            --card-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            --card-hover-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
            --border-radius: 12px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background-color: var(--background-color);
        }

        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.8rem;
        }

        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 6px;
            padding: 8px 16px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #5a0010;
            border-color: #5a0010;
            transform: translateY(-2px);
        }

        .library-section {
            padding: 30px 0 60px;
        }

        /* Gaya Book Card yang Diperbarui (seperti kode pertama) */
        .book-card {
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 2px solid #710014;
            border-radius: 15px;
            background-color: #f5f5f5;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-cover {
            padding: 10px;
            object-fit: cover;
            height: 350px;
            width: 100%;
            border-radius: 10px;
        }

        .book-info {
            padding: 1rem;
        }

        .book-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: var(--text-color);
            min-height: 52px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .book-author {
            color: #B38F6F;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .book-price {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.2rem;
            font-family: 'Playfair Display', serif;
        }

        .book-actions {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            gap: 10px;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .action-btn {
            background: #710014;
            color: white;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 20px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: #B38F6F;
            color: white;
        }

        .book-card:hover .book-actions {
            opacity: 1;
        }

        .sold-badge {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background-color: #710014;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .empty-library {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-top: 20px;
        }

        .empty-library i {
            font-size: 5rem;
            color: var(--primary-color);
            margin-bottom: 25px;
            opacity: 0.8;
        }

        .empty-library h3 {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--text-color);
        }

        .empty-library p {
            margin-bottom: 25px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .library-stats {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            margin-bottom: 40px;
            box-shadow: var(--card-shadow);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .stat-item {
            text-align: center;
            padding: 10px;
            flex: 1;
            min-width: 120px;
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 8px;
            line-height: 1;
        }

        .stat-label {
            color: var(--dark-gray);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .purchased-date {
            font-size: 0.85rem;
            color: var(--dark-gray);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .purchased-date i {
            color: var(--primary-color);
            font-size: 0.8rem;
        }

        .btn-success {
            background-color: #10B981;
            border-color: #10B981;
        }

        .btn-success:hover {
            background-color: #059669;
            border-color: #059669;
        }

        .breadcrumb {
            background: transparent;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
        }

        h1,
        h5 {
            font-family: 'Playfair Display', serif;
        }

        p,
        .text {
            font-family: 'Poppins', sans-serif;
        }

        .page-header {
            background: var(--background-color);
            color: white;
            padding: 40px 0;
        }

        .rating-stars {
            margin-bottom: 10px;
        }

        .rating-stars i {
            color: #FFD700;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('components.navbar')

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="fw-bold" style="color: #710014">Perpustakaan</h1>
            <p class="text" style="color: #000000">Buku yang telah kamu beli akan muncul disini untuk dibaca. Selamat membaca!
            </p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Perpustakaan</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Library Section -->
    <section class="library-section">
        <div class="container">
            @if($libraryBooks->count() > 0)
                <!-- Library Stats -->
                <div class="library-stats">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="stat-item">
                                <div class="stat-number">{{ $libraryBooks->count() }}</div>
                                <div class="stat-label">{{ Str::plural('Book', $libraryBooks->count()) }} Owned</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-item">
                                <div class="stat-number">{{ $libraryBooks->unique('category_id')->count() }}</div>
                                <div class="stat-label">
                                    {{ Str::plural('Category', $libraryBooks->unique('category_id')->count()) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-item">
                                <div class="stat-number">{{ $libraryBooks->sum('reviews_count') }}</div>
                                <div class="stat-label">Total Reviews</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-item">
                                <div class="stat-number">Rp {{ number_format($libraryBooks->sum('price'), 0, ',', '.') }}
                                </div>
                                <div class="stat-label">Total Value</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Your Books ({{ $libraryBooks->count() }})</h4>
                    <div>
                        <select class="form-select" id="sortBooks" onchange="sortBooks()">
                            <option value="recent">Recently Added</option>
                            <option value="title">Title A-Z</option>
                            <option value="author">Author A-Z</option>
                            <option value="category">Category</option>
                        </select>
                    </div>
                </div>

                <div class="row" id="booksContainer">
                    @foreach($libraryBooks as $book)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 book-item" data-title="{{ $book->title }}"
                            data-author="{{ $book->author }}" data-category="{{ $book->category->name }}"
                            data-added="{{ $book->pivot->created_at }}">
                            <div class="book-card">
                                <img src="{{ $book->cover_image ?? 'https://via.placeholder.com/300x400?text=Book+Cover' }}"
                                    alt="{{ $book->title }}" class="book-cover">

                                <div class="book-actions">
                                    <a href="/reader/{{ $book->id }}" class="action-btn" title="Read Book">
                                        <i class="fas fa-book-open"></i>
                                    </a>
                                    <a href="{{ route('books.show', $book->id) }}" class="action-btn" title="View Details">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>

                                <div class="book-info">
                                    <p class="book-author"> {{ $book->author }}</p>
                                    <h6 class="book-title">{{ $book->title }}</h6>
                                    <p class="text-muted small">{{ $book->category->name }}</p>
                                    
                                    @if($book->reviews_count > 0)
                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= round($book->average_rating) ? '' : '-o' }}"></i>
                                            @endfor
                                            <small class="text-muted">({{ $book->reviews_count }})</small>
                                        </div>
                                    @endif

                                    <div class="purchased-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        Dibeli pada {{ $book->pivot->created_at->format('M d, Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-library">
                    <i class="fas fa-book"></i>
                    <h3>Your library is empty</h3>
                    <p class="text-muted">You haven't purchased any books yet. Start building your digital library!</p>
                    <a href="/categories" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i>Browse Books
                    </a>
                </div>
            @endif
        </div>
    </section>

    @include('components.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Load cart count on page load
        fetch('/cart/count')
            .then(response => response.json())
            .then(data => {
                document.getElementById('cart-count').textContent = data.count;
            });

        function sortBooks() {
            const sortBy = document.getElementById('sortBooks').value;
            const container = document.getElementById('booksContainer');
            const books = Array.from(container.children);

            books.sort((a, b) => {
                switch (sortBy) {
                    case 'title':
                        return a.dataset.title.localeCompare(b.dataset.title);
                    case 'author':
                        return a.dataset.author.localeCompare(b.dataset.author);
                    case 'category':
                        return a.dataset.category.localeCompare(b.dataset.category);
                    case 'recent':
                    default:
                        return new Date(b.dataset.added) - new Date(a.dataset.added);
                }
            });

            books.forEach(book => container.appendChild(book));
        }
    </script>
</body>

</html>