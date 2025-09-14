<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $book->title }} - Readora</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            padding: 20px 0;
            background-color: var(--background-color);
        }

        .book-cover-large {
            width: 100%;
            max-width: 400px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
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

        .related-books {
            background: var(--background-color);
            padding: 60px 0;
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

        /* Gaya Book Card yang Diperbarui (diambil dari kode pertama) */
        .book-card {
            margin-top: 15px;
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 2px solid #710014;
            border-radius: 15px;
            background-color: #f5f5f5;
            height: 97%;
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

        .book-title-card {
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

        .book-author-card {
            color: #B38F6F;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .book-price-card {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.2rem;
            font-family: 'Playfair Display', serif;
        }

        .rating-stars {
            color: #ffc107;
            margin-bottom: 0.5rem;
            font-size: 14px;
        }

        .book-icons {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            gap: 10px;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .book-icons a, .book-icons button {
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
            border: none;
            cursor: pointer;
        }

        .book-icons a:hover, .book-icons button:hover {
            background: #B38F6F;
        }

        .book-card:hover .book-icons {
            opacity: 1;
        }

        .sold-badge {
            position: absolute;
            bottom: 30px;
            right: 15px;
            background-color: #710014;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('components.navbar')

    <!-- Breadcrumb -->
    <div class="container">
        <h1 class="fw-bold mt-5" style="color: #710014">Detail Buku</h1>
        <p class="text" style="color: #000000">Lihat detail dan tentukan apakah kamu cocok dengan buku ini.</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/categories">Kategori</a></li>
                <li class="breadcrumb-item"><a
                        href="/categories?category={{ $book->category->id }}">{{ $book->category->name }}</a></li>
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
                            <span class="rating-text">{{ number_format($book->average_rating, 1) }} out of 5
                                ({{ $book->reviews_count }} reviews)</span>
                        </div>
                    @endif

                    <div class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</div>
                    <p class="text-muted mb-3">{{ $book->sales_count }} copies sold</p>

                    @auth
                        <div class="book-actions">
                            @if(Auth::user()->hasBookInLibrary($book->id))
                                <a href="/reader/{{ $book->id }}" class="btn btn-success action-button">
                                    <i class="fas fa-book-open me-2"></i>Baca sekarang
                                </a>
                            @else
                                <button class="btn btn-primary action-button" onclick="addToCart({{ $book->id }})">
                                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                    <button class="btn btn-outline-primary action-button"
                                        onclick="toggleWishlist({{ $book->id }})">
                                        <i class="fas fa-heart me-2"></i>
                                        {{ Auth::user()->hasBookInWishlist($book->id) ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                                    </button>
                                </button>
                            @endif
                        </div>
                    @else
                        <div class="book-actions">
                            <a href="{{ route('login') }}" class="btn btn-primary action-button">
                                <i class="fas fa-shopping-cart me-2"></i>Login untuk beli
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
                            <div class="card book-card shadow-sm">
                                <img src="{{ $relatedBook->cover_image ?? 'https://via.placeholder.com/300x400?text=Book+Cover' }}"
                                    alt="{{ $relatedBook->title }}" class="book-cover">

                                <!-- Badge untuk jumlah buku terjual -->
                                <div class="sold-badge">
                                    <i class="fas fa-shopping-cart me-1"></i> {{ $relatedBook->sales_count }} terjual
                                </div>

                                <div class="book-icons">
                                    <a href="{{ route('books.show', $relatedBook->id) }}" title="View Details">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @auth
                                        <button onclick="addToWishlist({{ $relatedBook->id }})" title="Add to Wishlist">
                                            <i class="fa-solid fa-heart"></i>
                                        </button>
                                        <button onclick="addToCart({{ $relatedBook->id }})" title="Add to Cart">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" title="Login to add to Wishlist">
                                            <i class="fa-solid fa-heart"></i>
                                        </a>
                                        <a href="{{ route('login') }}" title="Login to add to Cart">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </a>
                                    @endauth
                                </div>

                                <div class="book-info">
                                    <p class="book-author-card">{{ $relatedBook->author }}</p>
                                    <h6 class="book-title-card">{{ $relatedBook->title }}</h6>
                                    <p class="book-price-card">Rp {{ number_format($relatedBook->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('resources/js/book-actions.js') }}"></script>
</body>

</html>