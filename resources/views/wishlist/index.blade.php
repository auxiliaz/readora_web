<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist - Readora</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
        
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), #8b0018);
            color: white;
            padding: 60px 0;
        }
        
        .page-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 2.5rem;
        }
        
        .wishlist-section {
            padding: 60px 0;
        }
        
        .book-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            height: 100%;
            position: relative;
        }
        
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .book-cover {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .book-info {
            padding: 1.5rem;
        }
        
        .book-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: var(--text-color);
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
        
        .empty-wishlist {
            text-align: center;
            padding: 4rem 0;
        }
        
        .empty-wishlist i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 1rem;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 1rem 0;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .wishlist-actions {
            margin-bottom: 2rem;
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
                <li class="breadcrumb-item active" aria-current="page">My Wishlist</li>
            </ol>
        </nav>
    </div>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">My Wishlist</h1>
            <p class="lead">Books you want to read later</p>
        </div>
    </section>

    <!-- Wishlist Section -->
    <section class="wishlist-section">
        <div class="container">
            @if($wishlistItems->count() > 0)
                <div class="wishlist-actions">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>{{ $wishlistItems->count() }} {{ Str::plural('book', $wishlistItems->count()) }} in your wishlist</h4>
                        <div>
                            <button class="btn btn-primary" onclick="moveAllToCart()">
                                <i class="fas fa-shopping-cart me-2"></i>Move All to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach($wishlistItems as $book)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" id="wishlist-item-{{ $book->id }}">
                            <div class="book-card">
                                <div class="book-actions">
                                    <button class="action-btn" onclick="moveToCart({{ $book->id }})" title="Move to Cart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                    <button class="action-btn" onclick="removeFromWishlist({{ $book->id }})" title="Remove from Wishlist">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <a href="{{ route('books.show', $book->id) }}" class="action-btn" title="View Details">
                                        <i class="fas fa-eye"></i>
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
                                    
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                        <small class="text-muted">{{ $book->sales_count }} sold</small>
                                    </div>
                                    
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary btn-sm" onclick="moveToCart({{ $book->id }})">
                                            <i class="fas fa-shopping-cart me-2"></i>Move to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-wishlist">
                    <i class="fas fa-heart"></i>
                    <h3>Your wishlist is empty</h3>
                    <p class="text-muted">Start adding books you'd like to read to your wishlist.</p>
                    <a href="/categories" class="btn btn-primary btn-lg">
                        <i class="fas fa-book me-2"></i>Browse Books
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
