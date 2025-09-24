<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results: {{ $query }} - Readora</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    <style>
        :root {
            --primary-color: #710014;
            --secondary-color: #B38F6F;
            --background-color: #F2F1ED;
            --text-color: #000000;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
        }
        
        .search-header {
            background: linear-gradient(135deg, var(--primary-color), #8b0018);
            color: white;
            padding: 40px 0;
        }
        
        .search-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 2rem;
        }
        
        .search-results-section {
            padding: 60px 0;
        }
        
        .filters-sidebar {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            height: fit-content;
            position: sticky;
            top: 100px;
        }
        
        .filter-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .book-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            background: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }
        
        .book-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(135deg, #710014 0%, #8B1C33 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .book-card:hover::before {
            transform: scaleX(1);
        }
        
        .book-card:hover {
            transform: translateY(-1px) scale(1.01);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }
        
        .book-cover {
            width: 100%;
            height: 250px;
            object-fit: cover;
            padding: 15px;
            border-radius: 20px;
        }
        
        .book-info {
            padding: 1.5rem;
            flex-grow: 1;
        }
        
        .book-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: var(--text-color);
            min-height: 52px;
            max-height: 52px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.3;
            word-wrap: break-word;
            hyphens: auto;
        }
        
        .book-author {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .book-price {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.2rem;
        }
        
        .rating-stars {
            color: #ffc107;
            margin-bottom: 0.5rem;
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
        
        .book-card:hover .book-actions {
            opacity: 1;
        }
        
        .action-btn {
            background: linear-gradient(135deg, #710014 0%, #8B1C33 100%);
            color: white;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 18px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
        }
        
        .action-btn:hover {
            background: linear-gradient(135deg, #B38F6F 0%, #D4AF94 100%);
            color: white;
            transform: scale(1.1);
        }
        
        .results-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .results-info {
            flex: 1;
        }
        
        .sort-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 1rem 0;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #5a0010;
            border-color: #5a0010;
        }
        
        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .empty-results {
            text-align: center;
            padding: 4rem 0;
        }
        
        .empty-results i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 1rem;
        }
        
        .highlight {
            background-color: #fff3cd;
            padding: 0.1rem 0.2rem;
            border-radius: 3px;
        }
        
        @media (max-width: 768px) {
            .filters-sidebar {
                position: static;
                margin-bottom: 2rem;
            }
            
            .results-header {
                flex-direction: column;
                align-items: stretch;
            }
            
            .sort-controls {
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>
    @include('components.navbar')

    <!-- Breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/categories">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search Results</li>
            </ol>
        </nav>
    </div>

    <!-- Search Header -->
    <section class="search-header">
        <div class="container">
            <h1 class="search-title">Search Results</h1>
            <p class="lead">Results for "{{ $query }}"</p>
        </div>
    </section>

    <!-- Search Results Section -->
    <section class="search-results-section">
        <div class="container">
            <div class="row">
                <!-- Filters Sidebar -->
                <div class="col-lg-3 mb-4">
                    <div class="filters-sidebar">
                        <h5 class="filter-title">Refine Search</h5>
                        
                        <form method="GET" action="/search" id="filterForm">
                            <input type="hidden" name="q" value="{{ $query }}">
                            
                            <!-- Category Filter -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Category</label>
                                <select class="form-select" name="category" onchange="submitFilter()">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Sort Filter -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Sort By</label>
                                <select class="form-select" name="sort" onchange="submitFilter()">
                                    <option value="relevance" {{ $sortBy == 'relevance' ? 'selected' : '' }}>Relevance</option>
                                    <option value="title" {{ $sortBy == 'title' ? 'selected' : '' }}>Title A-Z</option>
                                    <option value="price_low" {{ $sortBy == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ $sortBy == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="newest" {{ $sortBy == 'newest' ? 'selected' : '' }}>Newest</option>
                                    <option value="popular" {{ $sortBy == 'popular' ? 'selected' : '' }}>Most Popular</option>
                                    <option value="rating" {{ $sortBy == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                                </select>
                            </div>
                            
                            <button type="button" class="btn btn-outline-primary w-100" onclick="clearFilters()">
                                <i class="fas fa-times me-2"></i>Clear Filters
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Results Content -->
                <div class="col-lg-9">
                    <!-- Results Header -->
                    <div class="results-header">
                        <div class="results-info">
                            <h4>{{ $totalResults }} {{ Str::plural('result', $totalResults) }} found</h4>
                            @if($categoryId)
                                <p class="text-muted">in {{ $categories->find($categoryId)->name ?? 'Unknown Category' }}</p>
                            @endif
                        </div>
                    </div>
                    
                    @if($books->count() > 0)
                        <!-- Books Grid -->
                        <div class="row">
                            @foreach($books as $book)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="book-card">
                                        <div class="book-actions">
                                            @auth
                                                <button class="action-btn" onclick="toggleWishlist({{ $book->id }})" title="Add to Wishlist">
                                                    <i class="fas fa-heart"></i>
                                                </button>
                                                @if(!Auth::user()->hasBookInLibrary($book->id))
                                                    <button class="action-btn" onclick="addToCart({{ $book->id }})" title="Add to Cart">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </button>
                                                @endif
                                            @endauth
                                        </div>
                                        
                                        <img src="{{ $book->cover_image_url }}" 
                                             alt="{{ $book->title }}" class="book-cover">
                                        
                                        <div class="book-info">
                                            <h6 class="book-title">
                                                <a href="{{ route('books.show', $book->id) }}" class="text-decoration-none">
                                                    {!! str_ireplace($query, '<span class="highlight">'.$query.'</span>', $book->title) !!}
                                                </a>
                                            </h6>
                                            <p class="book-author">
                                                by {!! str_ireplace($query, '<span class="highlight">'.$query.'</span>', $book->author ? $book->author->nama : 'Unknown Author') !!}
                                            </p>
                                            <p class="text-muted small">{{ $book->category->name }}</p>
                                            
                                            @if($book->reviews_count > 0)
                                                <div class="rating-stars">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star{{ $i <= round($book->average_rating) ? '' : '-o' }}"></i>
                                                    @endfor
                                                    <small class="text-muted">({{ $book->reviews_count }})</small>
                                                </div>
                                            @endif
                                            
                                            <div class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</div>
                                            <small class="text-muted">{{ $book->sales_count }} sold</small>
                                            
                                            <div class="d-grid gap-2 mt-3">
                                                @auth
                                                    @if(Auth::user()->hasBookInLibrary($book->id))
                                                        <a href="/reader/{{ $book->id }}" class="btn btn-success btn-sm">
                                                            <i class="fas fa-book-open me-2"></i>Read Now
                                                        </a>
                                                    @else
                                                        <button class="btn btn-primary btn-sm" onclick="addToCart({{ $book->id }})">
                                                            <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                                        </button>
                                                    @endif
                                                @else
                                                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-shopping-cart me-2"></i>Login to Purchase
                                                    </a>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $books->appends(request()->query())->links() }}
                        </div>
                    @else
                        <!-- Empty Results -->
                        <div class="empty-results">
                            <i class="fas fa-search"></i>
                            <h3>No results found</h3>
                            <p class="text-muted">We couldn't find any books matching "{{ $query }}"</p>
                            <div class="mt-4">
                                <p class="mb-3">Try:</p>
                                <ul class="list-unstyled">
                                    <li>• Checking your spelling</li>
                                    <li>• Using different keywords</li>
                                    <li>• Searching for author names</li>
                                    <li>• Browsing our categories</li>
                                </ul>
                            </div>
                            <a href="/categories" class="btn btn-primary btn-lg mt-3">
                                <i class="fas fa-th-large me-2"></i>Browse All Categories
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/notifications.js') }}"></script>
    <script>
        function submitFilter() {
            document.getElementById('filterForm').submit();
        }
        
        function clearFilters() {
            const form = document.getElementById('filterForm');
            form.querySelector('select[name="category"]').value = '';
            form.querySelector('select[name="sort"]').value = 'relevance';
            form.submit();
        }
        
        function addToCart(bookId) {
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    book_id: bookId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    updateCartCount();
                } else {
                    showNotification(data.message || 'Error adding to cart', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error adding to cart. Please try again.', 'error');
            });
        }
        
        function toggleWishlist(bookId) {
            fetch('/wishlist/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    book_id: bookId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    updateWishlistCount();
                } else {
                    showNotification(data.message || 'Error updating wishlist', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating wishlist. Please try again.', 'error');
            });
        }
        
        // Notification functions are now loaded from notifications.js
    </script>
</body>
</html>
