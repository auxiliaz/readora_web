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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    <style>
        :root {
            --primary-color: #710014;
            --secondary-color: #B38F6F;
            --background-color: #f8f9fa;
            --text-color: #333333;
            --light-gray: #f5f5f5;
            --border-color: #e0e0e0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .page-header {
            background: var(--background-color);
            color: white;
            padding: 40px 0;
        }


        .content-wrapper {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 40px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .book-detail-main {
            padding: 40px;
        }

        .book-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .book-cover-container {
            position: sticky;
            top: 20px;
        }

        .book-cover-large {
            width: 100%;
            height: 360px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        }

        .book-info {
            min-height: 360px;
        }

        .book-category {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .book-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 32px;
            color: var(--text-color);
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .book-subtitle {
            font-size: 18px;
            color: #666;
            margin-bottom: 20px;
            line-height: 1.4;
        }

        .book-author {
            font-size: 16px;
            color: var(--primary-color);
            margin-bottom: 20px;
            font-weight: 500;
        }

        .book-meta {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
        }

        .meta-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .meta-value {
            font-size: 14px;
            color: var(--text-color);
            font-weight: 500;
        }


        .book-price {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .sales-info {
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }

        .book-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-primary-custom {
            background: var(--primary-color);
            border: none;
            color: white;
            padding: 14px 24px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary-custom:hover {
            background: #8b0019;
            transform: translateY(-1px);
        }

        .btn-secondary-custom {
            background: transparent;
            border: 2px solid var(--border-color);
            color: var(--text-color);
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-secondary-custom:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .book-description {
            margin-top: 40px;
            padding-top: 40px;
            border-top: 1px solid var(--border-color);
        }

        .description-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--text-color);
        }

        .description-text {
            font-size: 16px;
            line-height: 1.7;
            color: #555;
        }
        .sidebar {
            background: var(--light-gray);
            padding: 30px 25px;
        }

        .sidebar-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-color);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 25px;
            text-align: center;
        }

        .related-book-item {
            display: block;
            text-decoration: none;
            color: inherit;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            border-radius: 8px;
            overflow: hidden;
        }

        .related-book-item:hover {
            transform: translateY(-2px);
            text-decoration: none;
            color: inherit;
        }

        .related-book-cover {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 12px;
        }

        .related-book-info {
            padding: 0 5px;
        }

        .related-book-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 6px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .related-book-author {
            font-size: 12px;
            color: #666;
            margin-bottom: 8px;
        }

        .related-book-price {
            font-size: 14px;
            font-weight: 600;
            color: var(--primary-color);
        }

        .btn:disabled {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            opacity: 0.7;
        }

        .fa-spinner {
            color: #ffffff !important;
        }

        @media (max-width: 1200px) {
            .content-wrapper {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                background: white;
                border-top: 1px solid var(--border-color);
            }
            
            .sidebar-title {
                text-align: left;
            }
            
            .related-books-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .main-container {
                padding: 0 15px;
            }
            
            .book-layout {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .book-cover-container {
                position: relative;
                text-align: center;
            }
            
            .book-cover-large {
                max-width: 250px;
            }
            
            .book-detail-main {
                padding: 30px 20px;
            }
            
            .book-title {
                font-size: 24px;
            }
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
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('components.navbar')

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="fw-bold" style="color: #710014">{{ $book->title }}</h1>
                    <p class="text" style="color: #000000">Detail informasi buku dan deskripsi lengkap.
                    </p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('categories') }}">Kategori</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $book->title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="main-container">
        <div class="content-wrapper">
            <div class="book-detail-main">
                <div class="book-layout">
                    <div class="book-cover-container">
                        <img src="{{ $book->cover_image ?? 'https://via.placeholder.com/280x360?text=Book+Cover' }}"
                            alt="{{ $book->title }}" class="book-cover-large">
                    </div>

                    <div class="book-info">
                        <div class="book-category">{{ $book->category->name }}</div>
                        <h1 class="book-title">{{ $book->title }}</h1>
                        <div class="book-subtitle">{{ $book->subtitle ?? '' }}</div>
                        <div class="book-author">by {{ $book->author ? $book->author->nama : 'Unknown Author' }}</div>
                        
                        <div class="book-meta">
                            <div class="meta-item">
                                <div class="meta-label">ISBN</div>
                                <div class="meta-value">{{ $book->isbn ?? 'Not Available' }}</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Release Date</div>
                                <div class="meta-value">{{ $book->created_at ? $book->created_at->format('M d, Y') : 'Unknown' }}</div>
                            </div>
                            @if($book->publisher)
                            <div class="meta-item">
                                <div class="meta-label">Publisher</div>
                                <div class="meta-value">{{ $book->publisher->nama }}</div>
                            </div>
                            @endif
                            @if($book->isbn)
                            <div class="meta-item">
                                <div class="meta-label">Format</div>
                                <div class="meta-value">Digital</div>
                            </div>
                            @endif
                        </div>

                        @if($book->reviews_count > 0)
                        <div class="rating-section">
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= round($book->average_rating) ? '' : '-o' }}"></i>
                                @endfor
                            </div>
                            <div class="rating-text">{{ number_format($book->average_rating, 1) }} out of 5 ({{ $book->reviews_count }} reviews)</div>
                        </div>
                        @endif

                        <div class="book-price">Rp {{ number_format((float)$book->price, 0, ',', '.') }}</div>
                        <div class="sales-info">{{ $book->sales_count }} copies sold</div>

                        @auth
                        <div class="book-actions">
                            @if(Auth::user()->hasBookInLibrary($book->id))
                                <a href="/reader/{{ $book->id }}" class="btn btn-primary-custom">
                                    <i class="fas fa-book-open"></i>Baca sekarang
                                </a>
                            @else
                                <button class="btn btn-primary-custom" onclick="addToCart({{ $book->id }})">
                                    <i class="fas fa-shopping-cart"></i>Add to Cart
                                </button>
                                <button class="btn btn-secondary-custom" onclick="toggleWishlist({{ $book->id }})">
                                    <i class="fas fa-heart"></i>
                                    {{ Auth::user()->hasBookInWishlist($book->id) ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                                </button>
                            @endif
                        </div>
                        @else
                        <div class="book-actions">
                            <a href="{{ route('login') }}" class="btn btn-primary-custom">
                                <i class="fas fa-shopping-cart"></i>Login untuk beli
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <h3 class="sidebar-title">About This Book</h3>
                <div class="book-description">
                    <p class="description-text">{{ $book->description }}</p>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/book-actions.js') }}"></script>
    <script>
        function toggleWishlist(bookId) {
            if (!document.querySelector('meta[name="csrf-token"]')) {
                showNotification('Please login to manage wishlist', 'error');
                return;
            }

            const button = document.querySelector(`[onclick="toggleWishlist(${bookId})"]`);
            const originalText = button.innerHTML;
            
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>Loading...';

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
                    
                    // Update button text and icon
                    if (data.in_wishlist) {
                        button.innerHTML = '<i class="fas fa-heart"></i>Remove from Wishlist';
                    } else {
                        button.innerHTML = '<i class="fas fa-heart"></i>Add to Wishlist';
                    }
                } else {
                    showNotification(data.message || 'Error updating wishlist', 'error');
                    button.innerHTML = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating wishlist. Please try again.', 'error');
                button.innerHTML = originalText;
            })
            .finally(() => {
                button.disabled = false;
            });
        }

        function addToCart(bookId) {
            if (!document.querySelector('meta[name="csrf-token"]')) {
                showNotification('Please login to add items to cart', 'error');
                return;
            }

            const button = document.querySelector(`[onclick="addToCart(${bookId})"]`);
            const originalText = button.innerHTML;
            
            // Show loading state
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>Adding...';

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
            })
            .finally(() => {
                button.disabled = false;
                button.innerHTML = originalText;
            });
        }
    </script>
</body>

</html>