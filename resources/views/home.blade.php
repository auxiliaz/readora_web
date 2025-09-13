<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Readora - Digital E-Book Store</title>
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
            --success-color: #10B981;
            --error-color: #EF4444;
            --warning-color: #F59E0B;
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

        .btn-main {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-main:hover {
            background-color: #5a0010;
            color: white;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .hero-section {
            background: #F2F1ED;
            padding: 100px 0;
        }

        .hero {
            min-height: 80vh;
            padding: 60px 10px;
            border-radius: 0;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #710014;
            font-family: 'Playfair Display', serif;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #000;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-color);
            font-size: 2.5rem;
            margin-bottom: 3rem;
            text-align: center;
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

        .review-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
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

        .about-section {
            background: white;
            padding: 80px 0;
        }

        .footer {
            background-color: var(--primary-color);
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        .cart-badge {
            background-color: var(--error-color);
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.8rem;
            position: absolute;
            top: -5px;
            right: -5px;
        }

        .nav-icon {
            position: relative;
            display: inline-block;
        }
    </style>
</head>

<body>
    <!-- Navbar (tetap menggunakan include) -->
    @include('components.navbar')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero d-flex flex-column justify-content-center align-items-center text-center">
                <h1 data-aos="fade-down" data-aos-duration="1000">Selamat Datang di Readora</h1>
                <p data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">
                    Temukan ribuan buku favoritmu, dari novel, komik, hingga buku sejarah dan pendidikan.
                </p>
                <div data-aos="zoom-in" data-aos-delay="600">
                    <a href="/categories" class="btn-main">Browse Categories</a>
                    <a href="/search" class="btn-main ms-2">Search Books</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Readora Section -->
    <section id="about" class="py-5 mb-5" style="background-color: #710014;">
        <div class="container">
            <div class="row align-items-center">
                <!-- Kiri: Gambar -->
                <div class="col-md-6 text-center mb-4 mb-md-0">
                    <img src="assets/about.svg" alt="About Readora" class="img-fluid">
                </div>
                <!-- Kanan: Teks -->
                <div class="col-md-6 text-white">
                    <h1 class="fw-bold mb-3">About Readora</h1>
                    <p class="mb-4">
                        Dengan koleksi e-book yang terus diperbarui dan beragam kategori yang menarik, kami hadir untuk
                        memberikan pengalaman membaca yang lebih seru dan fleksibel. Nikmati pengalaman membaca e-book
                        favoritmu langsung di fitur Perpustakaan. Lebih praktis, tanpa perlu unduh—cukup sekali klik,
                        dan kamu bisa mulai membaca sekarang juga.
                    </p>
                    <a href="#popular-books" class="btn btn-light rounded-pill">Jelajahi Buku</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Books -->
    <section id="popular-books" class="py-5">
        <div class="container">
            <h2 class="section-title">Popular Books</h2>
            <div class="row">
                @forelse($popularBooks as $book)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card book-card shadow-sm">
                            <img src="{{ $book->cover_image ?? 'https://via.placeholder.com/300x400?text=Book+Cover' }}"
                                alt="{{ $book->title }}" class="book-cover">

                            <!-- Badge untuk jumlah buku terjual -->
                            <div class="sold-badge">
                                <i class="fas fa-shopping-cart me-1"></i> {{ $book->sales_count }} terjual
                            </div>

                            <div class="book-icons">
                                <a href="/books/{{ $book->id }}" title="View Details"><i class="fa-solid fa-eye"></i></a>
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
                                <p class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No popular books available yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Latest Releases -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Latest Releases</h2>
            <div class="row">
                @forelse($latestBooks as $book)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card book-card shadow-sm">
                            <img src="{{ $book->cover_image ?? 'https://via.placeholder.com/300x400?text=Book+Cover' }}"
                                alt="{{ $book->title }}" class="book-cover">

                            <!-- Badge untuk buku baru -->
                            <div class="sold-badge" style="background-color: rgba(25, 135, 84, 0.8);">
                                <i class="fas fa-certificate me-1"></i> Baru!
                            </div>

                            <div class="book-icons">
                                <a href="/books/{{ $book->id }}" title="View Details"><i class="fa-solid fa-eye"></i></a>
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

                                <p class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No new releases available yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Readora</h5>
                    <p>Your digital library for endless reading adventures.</p>
                </div>
                <div class="col-md-6">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="/categories" class="text-light">Browse Books</a></li>
                        <li><a href="/about" class="text-light">About Us</a></li>
                        <li><a href="/contact" class="text-light">Contact</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p>&copy; 2024 Readora. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/book-actions.js') }}"></script>
    
    <script>
        // Ensure functions are available globally for home page
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
            // Remove existing notifications with slide out animation
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

            // Trigger slide in animation
            setTimeout(() => {
                notification.classList.add('show');
            }, 50);

            // Auto remove after 4 seconds with slide out animation
            setTimeout(() => {
                hideNotification(notification);
            }, 4000);
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
                }, 400);
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
            console.log('Home page loaded, initializing...');
            if (document.querySelector('meta[name="csrf-token"]')) {
                updateCartCount();
                updateWishlistCount();
            }
        });
    </script>
</body>

</html>