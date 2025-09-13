<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $book->title }} - Readora</title>
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
        
        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: #5a0010;
            border-color: #5a0010;
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .book-detail-section {
            padding: 60px 0;
            background: white;
        }
        
        .book-cover-large {
            width: 100%;
            max-width: 400px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .book-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .book-author {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 1rem;
        }
        
        .book-price {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .rating-section {
            margin-bottom: 2rem;
        }
        
        .rating-stars {
            color: #ffc107;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        
        .book-actions {
            margin-bottom: 2rem;
        }
        
        .action-button {
            margin-right: 1rem;
            margin-bottom: 1rem;
        }
        
        .book-description {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 3rem;
        }
        
        .reviews-section {
            margin-top: 3rem;
        }
        
        .review-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }
        
        .reviewer-info {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .reviewer-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 1rem;
        }
        
        .related-books {
            background: var(--background-color);
            padding: 60px 0;
        }
        
        .book-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            overflow: hidden;
            height: 100%;
        }
        
        .book-card:hover {
            transform: translateY(-5px);
        }
        
        .book-cover {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .book-info {
            padding: 1rem;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 1rem 0;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
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
                <li class="breadcrumb-item"><a href="/categories">Books</a></li>
                <li class="breadcrumb-item"><a href="/categories?category={{ $book->category->id }}">{{ $book->category->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $book->title }}</li>
            </ol>
        </nav>
    </div>

    <!-- Book Detail Section -->
    <section class="book-detail-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <img src="{{ $book->cover_image ?? 'https://via.placeholder.com/400x600?text=Book+Cover' }}" 
                         alt="{{ $book->title }}" class="book-cover-large">
                </div>
                
                <div class="col-lg-8">
                    <h1 class="book-title">{{ $book->title }}</h1>
                    <p class="book-author">by {{ $book->author }}</p>
                    <p class="text-muted">Category: {{ $book->category->name }}</p>
                    
                    @if($book->reviews_count > 0)
                        <div class="rating-summary mb-3">
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= round($book->average_rating) ? '' : '-o' }}"></i>
                                @endfor
                            </div>
                            <span class="rating-text">{{ number_format($book->average_rating, 1) }} out of 5 ({{ $book->reviews_count }} reviews)</span>
                        </div>
                    @endif
                    
                    <div class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</div>
                    <p class="text-muted mb-3">{{ $book->sales_count }} copies sold</p>
                    
                    @auth
                        <div class="book-actions">
                            @if(Auth::user()->hasBookInLibrary($book->id))
                                <a href="/reader/{{ $book->id }}" class="btn btn-success action-button">
                                    <i class="fas fa-book-open me-2"></i>Read Now
                                </a>
                            @else
                                <button class="btn btn-primary action-button" onclick="addToCart({{ $book->id }})">
                                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                </button>
                            @endif
                            
                            <button class="btn btn-outline-primary action-button" onclick="toggleWishlist({{ $book->id }})">
                                <i class="fas fa-heart me-2"></i>
                                {{ Auth::user()->hasBookInWishlist($book->id) ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                            </button>
                        </div>
                    @else
                        <div class="book-actions">
                            <a href="{{ route('login') }}" class="btn btn-primary action-button">
                                <i class="fas fa-shopping-cart me-2"></i>Login to Purchase
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
            
            <!-- Book Description -->
            <div class="book-description">
                <h3 class="mb-3">About This Book</h3>
                <p>{{ $book->description }}</p>
            </div>
        </div>
    </section>


    <!-- Related Books Section -->
    @if($relatedBooks->count() > 0)
        <section class="related-books-section">
            <div class="container">
                <h3 class="text-center mb-5">Related Books</h3>
                <div class="row">
                    @foreach($relatedBooks as $relatedBook)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="book-card">
                                <img src="{{ $relatedBook->cover_image ?? 'https://via.placeholder.com/300x400?text=Book+Cover' }}" 
                                     alt="{{ $relatedBook->title }}" class="book-cover">
                                <div class="book-info">
                                    <h6 class="mb-2">{{ Str::limit($relatedBook->title, 30) }}</h6>
                                    <p class="text-muted small mb-2">by {{ $relatedBook->author }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-primary fw-bold">Rp {{ number_format($relatedBook->price, 0, ',', '.') }}</span>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('books.show', $relatedBook->id) }}" class="btn btn-sm btn-outline-primary" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @auth
                                                <button class="btn btn-sm btn-outline-primary" onclick="addToWishlist({{ $relatedBook->id }})" title="Add to Wishlist">
                                                    <i class="fas fa-heart"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary" onclick="addToCart({{ $relatedBook->id }})" title="Add to Cart">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Include Review Form -->
    @include('reviews.form')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('resources/js/book-actions.js') }}"></script>
</body>
</html>