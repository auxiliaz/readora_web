<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Browse Books - Readora</title>
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
        
        .filter-sidebar {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            height: fit-content;
        }
        
        /* Gaya Book Card yang Diperbarui */
        .book-card {
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 2px solid #710014;
            border-radius: 15px;
            background-color: #f5f5f5;
            height: 100%;
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
        
        .book-icons a {
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
        }

        .book-icons a:hover {
            background: #B38F6F;
        }
        
        .book-card:hover .book-icons {
            opacity: 1;
        }
        
        .sold-badge {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background-color: rgba(113, 0, 20, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
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
        
        .search-form {
            background: white;
            border-radius: 50px;
            padding: 5px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .search-input {
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
        }
        
        .search-input:focus {
            outline: none;
            box-shadow: none;
        }
        
        .category-filter {
            margin-bottom: 1rem;
        }
        
        .category-item {
            display: block;
            padding: 8px 0;
            color: var(--text-color);
            text-decoration: none;
            border-bottom: 1px solid #eee;
        }
        
        .category-item:hover {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .category-item.active {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .sort-dropdown {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 8px 12px;
        }
        
        /* Pagination yang diperbaiki */
        .pagination {
            margin-top: 2rem;
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
                    <h1 class="page-title">Browse Books</h1>
                    <p class="lead">Discover your next favorite read from our extensive collection</p>
                </div>
                <div class="col-lg-6">
                    <form method="GET" action="{{ route('categories') }}" class="search-form">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control search-input" 
                                   placeholder="Search books or authors..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <!-- Preserve other filters -->
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if(request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar Filters -->
                <div class="col-lg-3 mb-4">
                    <div class="filter-sidebar">
                        <h5 class="mb-3">Categories</h5>
                        <div class="category-filter">
                            <a href="{{ route('categories') }}" 
                               class="category-item {{ !request('category') ? 'active' : '' }}">
                                All Books
                                <span class="float-end text-muted">{{ $categories->sum('books_count') }}</span>
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('categories', ['category' => $category->id] + request()->except('category')) }}" 
                                   class="category-item {{ request('category') == $category->id ? 'active' : '' }}">
                                    {{ $category->name }}
                                    <span class="float-end text-muted">{{ $category->books_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Books Grid -->
                <div class="col-lg-9">
                    <!-- Sort and Results Info -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <p class="text-muted mb-0">
                                Showing {{ $books->firstItem() ?? 0 }}-{{ $books->lastItem() ?? 0 }} of {{ $books->total() }} results
                            </p>
                        </div>
                        <div>
                            <form method="GET" action="{{ route('categories') }}" class="d-inline">
                                <select name="sort" class="sort-dropdown" onchange="this.form.submit()">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                </select>
                                <!-- Preserve other filters -->
                                @if(request('category'))
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                @if(request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                            </form>
                        </div>
                    </div>

                    <!-- Books Grid -->
                    <div class="row">
                        @forelse($books as $book)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card book-card shadow-sm">
                                    <img src="{{ $book->cover_image ?? 'https://via.placeholder.com/300x400?text=Book+Cover' }}" 
                                         alt="{{ $book->title }}" class="book-cover">
                                    
                                    <!-- Badge untuk jumlah buku terjual -->
                                    <div class="sold-badge">
                                        <i class="fas fa-shopping-cart me-1"></i> {{ $book->sales_count }} terjual
                                    </div>
                                    
                                    <div class="book-icons">
                                        <a href="{{ route('books.show', $book->id) }}" title="View Details"><i class="fa-solid fa-eye"></i></a>
                                        @auth
                                            <a href="javascript:void(0)" onclick="addToWishlist({{ $book->id }})" title="Add to Wishlist"><i class="fa-solid fa-heart"></i></a>
                                            <a href="javascript:void(0)" onclick="addToCart({{ $book->id }})" title="Add to Cart"><i class="fa-solid fa-cart-plus"></i></a>
                                        @else
                                            <a href="{{ route('login') }}" title="Login to add to Wishlist"><i class="fa-solid fa-heart"></i></a>
                                            <a href="{{ route('login') }}" title="Login to add to Cart"><i class="fa-solid fa-cart-plus"></i></a>
                                        @endauth
                                    </div>
                                    
                                    <div class="book-info">
                                        <p class="book-author">by {{ $book->author }}</p>
                                        <h6 class="book-title">{{ $book->title }}</h6>
                                        <p class="text-muted small">{{ $book->category->name }}</p>                
                                        <p class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <i class="fas fa-book fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No books found</h5>
                                <p class="text-muted">Try adjusting your search or filter criteria</p>
                                <a href="{{ route('categories') }}" class="btn btn-primary">View All Books</a>
                            </div>
                        @endforelse
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
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/book-actions.js') }}"></script>
    
    <script>
        // Ensure functions are available globally
        window.addToCart = function(bookId) {
            console.log('Adding to cart:', bookId);
            
            if (!document.querySelector('meta[name="csrf-token"]')) {
                showNotification('Please login to add items to cart', 'error');
                return;
            }

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
                console.log('Cart response:', data);
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
        };

        window.addToWishlist = function(bookId) {
            console.log('Adding to wishlist:', bookId);
            
            if (!document.querySelector('meta[name="csrf-token"]')) {
                showNotification('Please login to add items to wishlist', 'error');
                return;
            }

            fetch('/wishlist/add', {
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
                console.log('Wishlist response:', data);
                if (data.success) {
                    showNotification(data.message, 'success');
                    updateWishlistCount();
                } else {
                    showNotification(data.message || 'Error adding to wishlist', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error adding to wishlist. Please try again.', 'error');
            });
        };

        // Notification function
        window.showNotification = function(message, type = 'success') {
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
            notification.className = `toast-notification toast-${type}`;
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
        };

        // Hide notification with animation
        window.hideNotification = function(notification) {
            if (notification && notification.parentElement) {
                notification.classList.remove('show');
                notification.classList.add('hide');
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 300);
            }
        };

        // Update cart count
        window.updateCartCount = function() {
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
                    const cartBadge = document.querySelector('#cart-count');
                    if (cartBadge) {
                        cartBadge.textContent = data.count;
                        cartBadge.setAttribute('data-count', data.count);
                        if (data.count === 0) {
                            cartBadge.style.display = 'none';
                        } else {
                            cartBadge.style.display = 'flex';
                        }
                    }
                })
                .catch(error => console.log('Error updating cart count:', error));
        };

        // Update wishlist count
        window.updateWishlistCount = function() {
            fetch('/wishlist/count')
                .then(response => response.json())
                .then(data => {
                    const wishlistBadge = document.querySelector('#wishlist-count');
                    if (wishlistBadge) {
                        wishlistBadge.textContent = data.count;
                        wishlistBadge.setAttribute('data-count', data.count);
                        if (data.count === 0) {
                            wishlistBadge.style.display = 'none';
                        } else {
                            wishlistBadge.style.display = 'flex';
                        }
                    }
                })
                .catch(error => console.log('Error updating wishlist count:', error));
        };

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded, initializing...');
            if (document.querySelector('meta[name="csrf-token"]')) {
                updateCartCount();
                updateWishlistCount();
            }
        });
    </script>
</body>
</html>