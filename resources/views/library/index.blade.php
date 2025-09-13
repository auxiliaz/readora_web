<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Library - Readora</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
            --card-shadow: 0 4px 8px rgba(0,0,0,0.08);
            --card-hover-shadow: 0 8px 16px rgba(0,0,0,0.12);
            --border-radius: 12px;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background-color: #f9f9f9;
        }
        
        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
        
        .page-header {
            background-color: white;
            padding: 40px 0 30px;
            margin-bottom: 40px;
            border-bottom: 1px solid var(--medium-gray);
        }
        
        .page-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 2.5rem;
            color: var(--primary-color);
        }
        
        .library-section {
            padding: 30px 0 60px;
        }
        
        .book-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: var(--card-shadow);
            position: relative;
        }
        
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-hover-shadow);
        }
        
        .book-cover {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-top-left-radius: var(--border-radius);
        border-top-right-radius: var(--border-radius);
        transition: transform 0.5s ease;
    }
    
    .book-card:hover .book-cover {
        transform: scale(1.05);
    }
    
    .book-info {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .book-title {
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 1.1rem;
        line-height: 1.4;
        color: var(--text-color);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .book-author {
        color: var(--dark-gray);
        font-size: 0.9rem;
        margin-bottom: 12px;
        font-weight: 500;
    }
    
    .book-price {
        font-weight: 600;
        color: var(--primary-color);
        font-size: 1.1rem;
    }
    
    .rating-stars {
        color: #FFC107;
        margin-bottom: 15px;
        font-size: 0.9rem;
    }
        
        .book-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .book-card:hover .book-actions {
            opacity: 1;
        }
        
        .action-btn {
            background: rgba(255,255,255,0.9);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-left: 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .action-btn:hover {
            background: var(--primary-color);
            color: white;
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
        
        .breadcrumb {
            background: transparent;
            padding: 1rem 0;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .breadcrumb-item a:hover {
            color: var(--secondary-color);
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
    </style>
</head>
<body>
    <!-- Navigation -->
   @include('components.navbar')

    <!-- Breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Library</li>
            </ol>
        </nav>
    </div>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">My Library</h1>
            <p class="lead">Your personal collection of purchased books</p>
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
                                <div class="stat-label">{{ Str::plural('Category', $libraryBooks->unique('category_id')->count()) }}</div>
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
                                <div class="stat-number">Rp {{ number_format($libraryBooks->sum('price'), 0, ',', '.') }}</div>
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
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 book-item" 
                             data-title="{{ $book->title }}" 
                             data-author="{{ $book->author }}" 
                             data-category="{{ $book->category->name }}"
                             data-added="{{ $book->pivot->created_at }}">
                            <div class="book-card">
                                <div class="book-actions">
                                    <a href="/reader/{{ $book->id }}" class="action-btn" title="Read Book">
                                        <i class="fas fa-book-open"></i>
                                    </a>
                                    <a href="/library/{{ $book->id }}" class="action-btn" title="View Details & Notes">
                                        <i class="fas fa-sticky-note"></i>
                                    </a>
                                    <a href="{{ route('books.show', $book->id) }}" class="action-btn" title="Book Details">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                </div>
                                
                                <img src="{{ $book->cover_image ?? 'https://via.placeholder.com/300x400?text=Book+Cover' }}" 
                                     alt="{{ $book->title }}" class="book-cover">
                                
                                <div class="book-info">
                                    <h6 class="book-title">{{ $book->title }}</h6>
                                    <p class="book-author">by {{ $book->author }}</p>
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
                                        Purchased {{ $book->pivot->created_at->format('M d, Y') }}
                                    </div>
                                    
                                    <div class="d-grid gap-2 mt-3">
                                        <a href="/reader/{{ $book->id }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-book-open me-2"></i>Read Now
                                        </a>
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
                switch(sortBy) {
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
