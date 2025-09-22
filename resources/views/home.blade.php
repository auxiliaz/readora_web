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
            min-height: 100vh;
            background-color: var(--background-color) !important;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .hero-content {
            text-align: center;
            z-index: 2;
            max-width: 800px;
            margin-bottom: 4rem;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 400;
            color: var(--primary-color);
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }

        .hero-description {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .cta-button {
            background: var(--primary-color);
            color: white;
            padding: 14px 32px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .cta-button:hover {
            background: #5a0010;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .books-carousel {
            width: 100%;
            height: 300px;
            position: relative;
            overflow: hidden;
            perspective: 1500px;
            margin-top: 2px;
            margin-bottom: 5px;
            background-color: var(--background-color);
        }

        .books-track {
            display: flex;
            position: absolute;
            height: 100%;
            gap: 20px;
            width: max-content;
            animation: infiniteSlide 30s linear infinite;
        }

        .book-card {
            width: 200px;
            height: 280px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            flex-shrink: 0;
        }

        .book-card:hover {
            transform: rotateY(0deg) translateZ(20px);
        }

        .book-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .book-title {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .book-author {
            font-size: 0.8rem;
            opacity: 0.9;
        }

        @keyframes infiniteSlide {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-100% / 3));
            }
        }

        .features-section {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            width: 100%;
            margin-top: 4rem;
            gap: 2rem;
        }

        .feature {
            text-align: center;
            flex: 1;
            padding: 1rem;
        }

        .feature-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .feature-description {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.5;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            animation: gradientShift 8s ease-in-out infinite;
        }

        @keyframes gradientShift {

            0%,
            100% {
                opacity: 0.3;
            }

            50% {
                opacity: 0.7;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 2.5rem;
            }

            .features-section {
                flex-direction: column;
                gap: 2rem;
            }

            .books-carousel {
                height: 250px;
            }

            .book-card {
                width: 160px;
                height: 220px;
            }
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-color);
            font-size: 2.5rem;
            margin-bottom: 3rem;
            text-align: center;
        }

        .new-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-color);
            font-size: 2.5rem;
            margin-bottom: 3rem;
            text-align: right;
            position: relative;
            display: block;
            padding-bottom: 5px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .new-title::after {
            content: "";
            position: absolute;
            right: 0;
            bottom: 0;
            width: 238px;
            height: 2px;
            background-color: #710014;
            border-radius: 2px;
        }

        .books-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-color);
            font-size: 2.5rem;
            margin-bottom: 3rem;
            text-align: center;
            position: relative;
            display: inline-block;
            padding-bottom: 5px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .books-title::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 2px;
            background-color: #710014;
            border-radius: 2px;
        }

        .book-card-main {
            margin-top: 15px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            background: white;
            height: 97%;
            display: flex;
            flex-direction: column;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .book-card-main::before {
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

        .book-card-main:hover::before {
            transform: scaleX(1);
        }

        .book-card-main:hover {
            transform: translateY(-1px) scale(1.01);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .book-cover-main {
            padding: 15px;
            object-fit: cover;
            height: 350px;
            width: 100%;
            border-radius: 20px;
        }

        .book-info {
            padding: 1.5rem;
            flex-grow: 1;
        }

        .book-title-main {
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

        .book-author-main {
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
        }

        .book-icons a:hover {
            background: linear-gradient(135deg, #B38F6F 0%, #D4AF94 100%);
            color: white;
            transform: scale(1.1);
        }

        .book-card-main:hover .book-icons {
            opacity: 1;
        }

        .sold-badge {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background: linear-gradient(135deg, #710014 0%, #8B1C33 100%);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(113, 0, 20, 0.3);
        }


        .about-section {
            background: white;
            padding: 80px 0;
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

        .category-card {
            padding: 15px 20px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            cursor: pointer;
        }

        .category-card:hover {
            transform: translateY(-10px);
        }

        .category-icon {
            width: 100px;
            height: 100px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: all 0.3s ease;
        }

        .category-icon i {
            font-size: 2.5rem;
            color: #710014;
        }

        .category-card:hover .category-icon {
            transform: scale(1);
        }

        .category-name {
            color: white;
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: 1.2rem;
            margin: 0;
            transition: all 0.3s ease;
        }

        .category-card:hover .category-name {
            color: #F2F1ED;
        }

        .btn-primary {
            background-color: #F2F1ED;
            border: 2px solid #710014;
            color: #710014;
            border-radius: 50px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #710014;
            border-color: #710014;
        }

        .btn-primary:focus,
        .btn-primary:active {
            background-color: #710014 !important;
            border-color: #710014 !important;
            color: #fff !important;
            box-shadow: none;
        }
    </style>
</head>

<body>
    @include('components.navbar')
    <section class="hero-section">
        <div class="hero-content mt-4">
            <h1 class="hero-title">Jelajahi Dunia Pengetahuan,</h1>
            <h2 class="hero-subtitle">Kembangkan Wawasan Anda</h2>
            <p class="hero-description">
                Platform terlengkap untuk membaca, belajar, dan berkembang dengan koleksi buku berkualitas dari berbagai
                bidang ilmu.
            </p>
            <button class="cta-button" onclick="window.location.href='/categories'">
                Eksplor Buku Sekarang
            </button>
        </div>

        <div class="books-carousel">
            <div class="books-track" id="booksTrack">
            </div>
        </div>
    </section>

    <!-- About Readora Section -->
    <section id="about" class="py-5 mb-3 mt-4" style="background-color: #710014;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center mb-4 mb-md-0">
                    <img src="assets/about.svg" alt="About Readora" class="img-fluid"
                        style="max-width: 75%; height: auto;">
                </div>
                <div class="col-md-6 text-white">
                    <h1 class="fw-bold mb-3" style="font-family: 'Playfair Display';">About Readora</h1>
                    <p class="mb-4">
                        Dengan koleksi e-book yang terus diperbarui dan beragam kategori yang menarik, kami hadir untuk
                        memberikan pengalaman membaca yang lebih seru dan fleksibel. Nikmati pengalaman membaca e-book
                        favoritmu langsung di fitur Perpustakaan. Lebih praktis, tanpa perlu unduh—cukup sekali klik,
                        dan kamu bisa mulai membaca sekarang juga.
                    </p>
                    <a href="/library" class="btn btn-light rounded-pill" style="font-weight: 600;">Jelajahi Perpustakaan</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Books -->
    <section id="popular-books" class="py-5">
        <div class="container">
            <h2 class="books-title">Buku Populer</h2>
            <div class="row">
                @forelse($popularBooks as $book)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card book-card-main shadow-sm">
                            <img src="{{ $book->cover_image ?? 'https://via.placeholder.com/300x400?text=Book+Cover' }}"
                                alt="{{ $book->title }}" class="book-cover-main">

                            <!-- Badge untuk jumlah buku terjual -->
                            <div class="sold-badge">
                                <i class="fas fa-shopping-cart me-1"></i> {{ $book->sales_count }} terjual
                            </div>

                            <div class="book-icons">
                                <a href="/books/{{ $book->id }}" title="View Details"><i class="fa-solid fa-eye"></i></a>
                                @auth
                                    <a href="javascript:void(0)" onclick="addToWishlist({{ $book->id }})"
                                        title="Add to Wishlist"><i class="fa-solid fa-heart"></i></a>
                                    <a href="javascript:void(0)" onclick="addToCart({{ $book->id }})" title="Add to Cart"><i
                                            class="fa-solid fa-cart-plus"></i></a>
                                @else
                                    <a href="{{ route('login') }}" title="Login to add to Wishlist"><i
                                            class="fa-solid fa-heart"></i></a>
                                    <a href="{{ route('login') }}" title="Login to add to Cart"><i
                                            class="fa-solid fa-cart-plus"></i></a>
                                @endauth
                            </div>

                            <div class="book-info">
                                <p class="book-author-main">{{ $book->author ? $book->author->nama : 'Unknown Author' }}</p>
                                <h6 class="book-title-main">{{ $book->title }}</h6>
                                <p class="text-muted small mb-3">{{ $book->category->name }}</p>
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

    <!-- Choose Your Categories Section -->
    <section class="py-5" style="background-color: var(--primary-color);">
        <div class="container">
            <h2 class="section-title text-white mb-5">Pilih Kategori Favoritmu</h2>
            <div class="row justify-content-center">
                <!-- Fiction -->
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <a href="/categories?category=1" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <h6 class="category-name">Fiction</h6>
                        </div>
                    </a>
                </div>

                <!-- Romance -->
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <a href="/categories?category=5" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h6 class="category-name">Romance</h6>
                        </div>
                    </a>
                </div>

                <!-- Science Fiction -->
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <a href="/categories?category=3" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <h6 class="category-name">Science Fiction</h6>
                        </div>
                    </a>
                </div>

                <!-- Mystery & Thriller -->
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <a href="/categories?category=6" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <i class="fas fa-search"></i>
                            </div>
                            <h6 class="category-name">Mystery & Thriller</h6>
                        </div>
                    </a>
                </div>

                <!-- Fantasy -->
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <a href="/categories?category=4" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <i class="fas fa-magic"></i>
                            </div>
                            <h6 class="category-name">Fantasy</h6>
                        </div>
                    </a>
                </div>

                <!-- Self-Help -->
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <a href="/categories?category=9" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h6 class="category-name">Self-Help</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Releases -->
    <section class="py-5">
        <div class="container">
            <h2 class="new-title">Rilis Terbaru</h2>
            <div class="row">
                @forelse($latestBooks as $book)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card book-card-main shadow-sm">
                            <img src="{{ $book->cover_image ?? 'https://via.placeholder.com/300x400?text=Book+Cover' }}"
                                alt="{{ $book->title }}" class="book-cover-main">

                            <!-- Badge untuk buku baru -->
                            <div class="sold-badge" style="background-color: #ff5e5e">
                                <i class="fas fa-certificate me-1"></i> Baru!
                            </div>

                            <div class="book-icons">
                                <a href="/books/{{ $book->id }}" title="View Details"><i class="fa-solid fa-eye"></i></a>
                                @auth
                                    <a href="javascript:void(0)" onclick="addToWishlist({{ $book->id }})"
                                        title="Add to Wishlist"><i class="fa-solid fa-heart"></i></a>
                                    <a href="javascript:void(0)" onclick="addToCart({{ $book->id }})" title="Add to Cart"><i
                                            class="fa-solid fa-cart-plus"></i></a>
                                @else
                                    <a href="{{ route('login') }}" title="Login to add to Wishlist"><i
                                            class="fa-solid fa-heart"></i></a>
                                    <a href="{{ route('login') }}" title="Login to add to Cart"><i
                                            class="fa-solid fa-cart-plus"></i></a>
                                @endauth
                            </div>

                            <div class="book-info">
                                <p class="book-author-main">{{ $book->author ? $book->author->nama : 'Unknown Author' }}</p>
                                <h6 class="book-title-main">{{ $book->title }}</h6>
                                <p class="text-muted small mb-3">{{ $book->category->name }}</p>
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

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/book-actions.js') }}"></script>

    <script>
        const books = [
            {
                'cover': '{{ asset("assets/buku1.jpeg") }}',
                'color': '#4a90e2',
                'title': 'Book 1'
            },
            {
                'cover': '{{ asset("assets/buku2.jpeg") }}',
                'color': '#e74c3c',
                'title': 'Book 2'
            },
            {
                'cover': '{{ asset("assets/buku3.jpeg") }}',
                'color': '#2ecc71',
                'title': 'Book 3'
            },
            {
                'cover': '{{ asset("assets/buku4.jpeg") }}',
                'color': '#9b59b6',
                'title': 'Book 4'
            },
            {
                'cover': '{{ asset("assets/buku5.jpeg") }}',
                'color': '#f39c12',
                'title': 'Book 5'
            },
            {
                'cover': '{{ asset("assets/buku6.jpeg") }}',
                'color': '#1abc9c',
                'title': 'Book 6'
            },
            {
                'cover': '{{ asset("assets/buku7.jpeg") }}',
                'color': '#34495e',
                'title': 'Book 7'
            },
            {
                'cover': '{{ asset("assets/buku8.jpeg") }}',
                'color': '#e67e22',
                'title': 'Book 8'
            },
            {
                'cover': '{{ asset("assets/buku9.jpeg") }}',
                'color': '#16a085',
                'title': 'Book 9'
            },
            {
                'cover': '{{ asset("assets/buku10.jpeg") }}',
                'color': '#8e44ad',
                'title': 'Book 10'
            },
            {
                'cover': '{{ asset("assets/buku11.jpeg") }}',
                'color': '#d35400',
                'title': 'Book 11'
            },
            {
                'cover': '{{ asset("assets/buku12.jpeg") }}',
                'color': '#c0392b',
                'title': 'Book 12'
            }
        ];
        const allBooks = [...books, ...books, ...books];

        function createBookCard(book, index) {
            return `
                <div class="book-card" style="animation-delay: ${index * 0.1}s">
                    <img src="${book.cover}" alt="${book.title}" class="book-cover" 
                         onerror="this.style.background='${book.color}'; this.style.display='flex'; this.style.alignItems='center'; this.style.justifyContent='center'; this.style.color='white'; this.style.fontSize='14px'; this.style.textAlign='center'; this.innerHTML='${book.title}';">
                </div>
            `;
        }

        function initializeCarousel() {
            const booksTrack = document.getElementById('booksTrack');
            const cardWidth = 220;
            const totalWidth = cardWidth * allBooks.length;

            booksTrack.innerHTML = allBooks.map((book, index) => createBookCard(book, index)).join('');
            booksTrack.style.width = totalWidth + 'px';
        }


        document.addEventListener('DOMContentLoaded', function () {
            initializeCarousel();
        });

        window.addToCart = function (bookId) {
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

        window.addToWishlist = function (bookId) {
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

        window.showNotification = function (message, type = 'success') {
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

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.add('show');
            }, 50);

            setTimeout(() => {
                hideNotification(notification);
            }, 4000);
        };

        window.hideNotification = function (notification) {
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

        window.updateCartCount = function () {
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

        window.updateWishlistCount = function () {
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


        document.addEventListener('DOMContentLoaded', function () {
            console.log('Home page loaded, initializing...');
            if (document.querySelector('meta[name="csrf-token"]')) {
                updateCartCount();
                updateWishlistCount();
            }
        });
    </script>
</body>

</html>