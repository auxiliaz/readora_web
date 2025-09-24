<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Library - Readora</title>
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
            --text-color: #333;
            --light-gray: #f5f5f5;
            --medium-gray: #e0e0e0;
            --dark-gray: #9e9e9e;
            --card-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            --card-hover-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
            --border-radius: 12px;
            --gradient-primary: linear-gradient(135deg, #710014 0%, #8B1C33 100%);
            --gradient-secondary: linear-gradient(135deg, #B38F6F 0%, #D4AF94 100%);
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background-color: var(--background-color);
        }

        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(113, 0, 20, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(113, 0, 20, 0.3);
        }

        .library-section {
            margin-top: -20px;
            margin-bottom: 50px;
            background: var(--background-color);
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
            background: var(--gradient-primary);
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

        .action-btn {
            background: var(--gradient-primary);
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

        .action-btn:hover {
            background: var(--gradient-secondary);
            color: white;
            transform: scale(1.1);
        }

        .book-card:hover .book-actions {
            opacity: 1;
        }

        .sold-badge {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background: var(--gradient-primary);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(113, 0, 20, 0.3);
        }

        .empty-library {
            text-align: center;
            padding: 100px 40px;
            background: linear-gradient(135deg, white 0%, #fafafa 100%);
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            margin-top: 40px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
        }

        .empty-library i {
            font-size: 6rem;
            background: var(--background-color);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .empty-library h3 {
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--text-color);
            font-family: 'Playfair Display', serif;
        }

        .empty-library p {
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            position: relative;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-3px);
        }

        .stat-item:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 60px;
            width: 1px;
            background: linear-gradient(to bottom, transparent, var(--medium-gray), transparent);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
            line-height: 1;
            font-family: 'Playfair Display', serif;
        }

        .stat-label {
            color: var(--dark-gray);
            font-size: 0.95rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .purchased-date {
            font-size: 0.85rem;
            color: var(--dark-gray);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            background: rgba(113, 0, 20, 0.05);
            border-radius: 20px;
            border-left: 3px solid var(--primary-color);
        }

        .purchased-date i {
            color: var(--primary-color);
            font-size: 0.8rem;
        }

        .btn-success {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
        }

        .breadcrumb {
            background: transparent;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
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

        .page-header {
            background: var(--background-color);
            color: white;
            padding: 40px 0;
        }

        .library-header {
            background: linear-gradient(135deg, white 0%, #fafafa 100%);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
        }

        .library-controls {
            background: var(--background-color);
            border-radius: 15px;
            padding: 1px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .form-select {
            border: 2px solid var(--medium-gray);
            border-radius: 10px;
            padding: 10px 15px;
            font-weight: 500;
            transition: all 0.3s ease;
            background: white;
        }

        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(113, 0, 20, 0.1);
        }

        .books-grid {
            background: transparent;
        }

        @media (max-width: 768px) {
            .stat-item:not(:last-child)::after {
                display: none;
            }

            .library-stats {
                padding: 25px 20px;
            }

            .stat-item {
                padding: 15px 10px;
            }

            .stat-number {
                font-size: 2rem;
            }
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--text-color);
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 65px;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 2px;
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
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('components.navbar')

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="fw-bold" style="color: #710014">Perpustakaan</h1>
            <p class="text" style="color: #000000">Buku yang telah kamu beli akan muncul disini untuk dibaca. Selamat
                membaca!
            </p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Perpustakaan</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Library Section -->
    <section class="library-section">
        <div class="container">
            @if($libraryBooks->count() > 0)
                <!-- Library Controls -->
                <div class="library-controls">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="section-title mb-4">Buku Koleksimu</h4>
                            <p class="text-muted mb-0">{{ $libraryBooks->count() }} buku di perpustakaan.</p>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <label class="form-label mb-0 text-muted small">Urutkan berdasarkan:</label>
                                <select class="form-select" id="sortBooks" onchange="sortBooks()">
                                    <option value="recent">Terbaru</option>
                                    <option value="title">Judul A-Z</option>
                                    <option value="author">Penulis A-Z</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Books Grid -->
                <div class="books-grid">
                    <div class="row" id="booksContainer">
                        @foreach($libraryBooks as $book)
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 book-item" data-title="{{ $book->title }}"
                                data-author="{{ $book->author ? $book->author->nama : 'Unknown Author' }}"
                                data-category="{{ $book->category->name }}" data-added="{{ $book->pivot->created_at }}">
                                <div class="book-card">
                                    <img src="{{ $book->cover_image_url }}"
                                        alt="{{ $book->title }}" class="book-cover-main">

                                    <div class="book-actions">
                                        <a href="/reader/{{ $book->id }}" class="action-btn" title="Read Book">
                                            <i class="fas fa-book-open"></i>
                                        </a>
                                        <a href="{{ route('books.show', $book->id) }}" class="action-btn" title="View Details">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>

                                    <div class="book-info">
                                        <p class="book-author">{{ $book->author ? $book->author->nama : 'Unknown Author' }}</p>
                                        <h6 class="book-title">{{ $book->title }}</h6>
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
                                            <i class="fas fa-calendar-alt"></i>
                                            Dibeli pada {{ $book->pivot->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="empty-library">
                    <i class="fas fa-book"></i>
                    <h3>Perpustakaanmu kosong</h3>
                    <p class="text-muted">Kamu belum membeli buku apa pun. Mulailah membangun perpustakaan digitalmi!</p>
                    <a href="/categories" class="cta-button">
                        Cari Buku
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

        function sortBooks() {
            const sortBy = document.getElementById('sortBooks').value;
            const container = document.getElementById('booksContainer');
            const books = Array.from(container.children);

            books.sort((a, b) => {
                switch (sortBy) {
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