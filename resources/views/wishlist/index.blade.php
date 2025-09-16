<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist - Readora</title>
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

        .page-header {
            background: var(--background-color);
            color: white;
            padding: 40px 0;
        }

        .wishlist-section {
            margin-bottom: 25px;
        }

        .empty-wishlist {
            text-align: center;
            padding: 4rem 0;
        }

        .empty-wishlist i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 1rem;
        }

        .wishlist-actions {
            margin-bottom: 1.5rem;
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

        .book-card {
            margin-top: 15px;
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 10px;
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
            border-radius: 20px;
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

        .book-icons {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            gap: 10px;
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: 10;
        }

        .book-icons a,
        .book-icons button {
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

        .book-icons a:hover,
        .book-icons button:hover {
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
            z-index: 5;
        }

        .book-actions-top {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 5;
        }

        .action-btn {
            background: rgba(255, 255, 255, 0.9);
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

        .move-to-cart-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 8px 15px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .move-to-cart-btn:hover {
            background-color: #5a0010;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('components.navbar')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="fw-bold" style="color: #710014">Buku Favorit</h1>
            <p class="text" style="color: #000000">{{ $wishlistItems->count() }}
                {{ Str::after('buku', $wishlistItems->count()) }} di daftar buku favoritmu.
            </p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Buku Favorit</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Wishlist Section -->
    <section class="wishlist-section">
        <div class="container">
            @if($wishlistItems->count() > 0)
                <div class="wishlist-actions">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <button class="btn btn-primary" onclick="moveAllToCart()">
                                <i class="fas fa-shopping-cart me-2"></i>Pindah ke keranjang
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach($wishlistItems as $book)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" id="wishlist-item-{{ $book->id }}">
                            <div class="card book-card shadow-sm">
                                <img src="{{ $book->cover_image ?? 'https://via.placeholder.com/300x400?text=Book+Cover' }}"
                                    alt="{{ $book->title }}" class="book-cover">

                                <!-- Badge untuk jumlah buku terjual -->
                                <div class="sold-badge">
                                    <i class="fas fa-shopping-cart me-1"></i> {{ $book->sales_count }} terjual
                                </div>
                                <!-- Action icons di tengah saat hover -->
                                <div class="book-icons">
                                    <a href="{{ route('books.show', $book->id) }}" title="View Details">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button class="action-btn" onclick="removeFromWishlist({{ $book->id }})"
                                        title="Remove from Wishlist">
                                        <i class="fas fa-trash"></i>
                                        <button onclick="moveToCart({{ $book->id }})" title="Move to Cart">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </button>
                                    </button>
                                </div>

                                <div class="book-info">
                                    <p class="book-author-card">{{ $book->author }}</p>
                                    <h6 class="book-title-card">{{ $book->title }}</h6>

                                    @if($book->reviews_count > 0)
                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= round($book->average_rating) ? '' : '-o' }}"></i>
                                            @endfor
                                            <small class="text-muted">({{ $book->reviews_count }})</small>
                                        </div>
                                    @endif
                                    <p class="text-muted small mb-3">{{ $book->category->name }}</p>
                                    <p class="book-price-card">Rp {{ number_format($book->price, 0, ',', '.') }}</p>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-wishlist">
                    <i class="fas fa-heart"></i>
                    <h3>Daftar buku favoritmu kosong nih!</h3>
                    <p class="text-muted">Mulai eksplor buku dan tambahkan ke favorit yuk.</p>
                    <a href="/categories" class="btn btn-primary btn-lg">Cari Buku
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

        function moveToCart(bookId) {
            fetch('/wishlist/move-to-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ book_id: bookId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`wishlist-item-${bookId}`).remove();
                        document.getElementById('cart-count').textContent = data.cart_count;

                        // Show success message
                        showMessage(data.message, 'success');

                        // Check if wishlist is empty
                        if (document.querySelectorAll('[id^="wishlist-item-"]').length === 0) {
                            location.reload();
                        }
                    } else {
                        showMessage(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('An error occurred while moving the book to cart', 'error');
                });
        }

        function removeFromWishlist(bookId) {
            if (confirm('Are you sure you want to remove this book from your wishlist?')) {
                fetch('/wishlist/remove', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ book_id: bookId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`wishlist-item-${bookId}`).remove();
                            showMessage(data.message, 'success');

                            // Check if wishlist is empty
                            if (document.querySelectorAll('[id^="wishlist-item-"]').length === 0) {
                                location.reload();
                            }
                        } else {
                            showMessage(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showMessage('An error occurred while removing the book', 'error');
                    });
            }
        }

        function moveAllToCart() {
            if (confirm('Are you sure you want to move all books to your cart?')) {
                const bookIds = Array.from(document.querySelectorAll('[id^="wishlist-item-"]'))
                    .map(el => el.id.replace('wishlist-item-', ''));

                Promise.all(bookIds.map(bookId =>
                    fetch('/wishlist/move-to-cart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ book_id: bookId })
                    })
                ))
                    .then(() => {
                        showMessage('All books moved to cart successfully!', 'success');
                        setTimeout(() => location.reload(), 1000);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showMessage('An error occurred while moving books to cart', 'error');
                    });
            }
        }

        function showMessage(message, type) {
            // Remove existing notifications with fade out animation
            const existingNotifications = document.querySelectorAll('.toast-notification');
            existingNotifications.forEach(notification => {
                notification.classList.add('hide');
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 300);
            });

            // Create notification element
            const notification = document.createElement('div');
            notification.className = `toast-notification toast-${type === 'success' ? 'success' : 'error'}`;
            notification.innerHTML = `
                <div class="toast-content">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                    <span>${message}</span>
                </div>
                <button class="toast-close" onclick="hideNotification(this.parentElement)">
                    <i class="fas fa-times"></i>
                </button>
            `;

            // Add to page
            document.body.appendChild(notification);

            // Trigger fade in animation
            setTimeout(() => {
                notification.classList.add('show');
            }, 50);

            // Auto remove after 3 seconds with fade out animation
            setTimeout(() => {
                hideNotification(notification);
            }, 3000);
        }

        // Hide notification with animation
        function hideNotification(notification) {
            if (notification && notification.parentElement) {
                notification.classList.remove('show');
                notification.classList.add('hide');
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 300);
            }
        }
    </script>
</body>

</html>