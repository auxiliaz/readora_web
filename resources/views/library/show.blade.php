<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} - My Library - Readora</title>
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
        
        .book-header {
            background: white;
            padding: 2rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .book-cover-large {
            width: 100%;
            max-width: 300px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .book-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .book-author {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 1rem;
        }
        
        .rating-stars {
            color: #ffc107;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        
        .book-meta {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }
        
        .meta-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        
        .meta-label {
            font-weight: 600;
            color: #666;
        }
        
        .notes-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }
        
        .note-item {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            border-left: 4px solid var(--primary-color);
        }
        
        .note-highlight {
            background: #fff3cd;
            padding: 0.5rem;
            border-radius: 5px;
            font-style: italic;
            margin-bottom: 0.5rem;
        }
        
        .note-text {
            margin-bottom: 0.5rem;
        }
        
        .note-meta {
            font-size: 0.8rem;
            color: #666;
            display: flex;
            justify-content: space-between;
        }
        
        .empty-notes {
            text-align: center;
            padding: 3rem 0;
            color: #666;
        }
        
        .empty-notes i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #ccc;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 1rem 0;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .btn-success {
            background-color: #10B981;
            border-color: #10B981;
        }
        
        .btn-success:hover {
            background-color: #059669;
            border-color: #059669;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .action-buttons .btn {
            flex: 1;
        }
        
        @media (max-width: 768px) {
            .book-title {
                font-size: 2rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
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
                <li class="breadcrumb-item"><a href="/library">My Library</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $book->title }}</li>
            </ol>
        </nav>
    </div>

    <!-- Book Header -->
    <section class="book-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <img src="{{ $book->cover_image ?? 'https://via.placeholder.com/300x400?text=Book+Cover' }}" 
                         alt="{{ $book->title }}" class="book-cover-large">
                </div>
                <div class="col-md-9">
                    <h1 class="book-title">{{ $book->title }}</h1>
                    <p class="book-author">by {{ $book->author }}</p>
                    
                    @if($book->reviews_count > 0)
                        <div class="rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= round($book->average_rating) ? '' : '-o' }}"></i>
                            @endfor
                            <span class="ms-2 text-muted">({{ $book->reviews_count }} reviews)</span>
                        </div>
                    @endif
                    
                    <div class="book-meta">
                        <div class="meta-item">
                            <span class="meta-label">Category:</span>
                            <span>{{ $book->category->name }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Purchased:</span>
                            <span>{{ $book->pivot->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Your Notes:</span>
                            <span>{{ $notes->count() }} {{ Str::plural('note', $notes->count()) }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Highlights:</span>
                            <span>{{ $notes->whereNotNull('highlight_text')->count() }} {{ Str::plural('highlight', $notes->whereNotNull('highlight_text')->count()) }}</span>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="/reader/{{ $book->id }}" class="btn btn-success btn-lg">
                            <i class="fas fa-book-open me-2"></i>Continue Reading
                        </a>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-info-circle me-2"></i>Book Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Notes Section -->
    <section class="py-5">
        <div class="container">
            <div class="notes-section">
                <h2 class="section-title">
                    <i class="fas fa-sticky-note me-2"></i>Your Notes & Highlights
                </h2>
                
                @if($notes->count() > 0)
                    <div class="mb-3">
                        <button class="btn btn-outline-primary btn-sm me-2" onclick="filterNotes('all')" id="filter-all">
                            All ({{ $notes->count() }})
                        </button>
                        <button class="btn btn-outline-primary btn-sm me-2" onclick="filterNotes('highlights')" id="filter-highlights">
                            Highlights ({{ $notes->whereNotNull('highlight_text')->count() }})
                        </button>
                        <button class="btn btn-outline-primary btn-sm" onclick="filterNotes('notes')" id="filter-notes">
                            Notes ({{ $notes->whereNotNull('note_text')->count() }})
                        </button>
                    </div>
                    
                    <div id="notes-container">
                        @foreach($notes as $note)
                            <div class="note-item" data-type="{{ $note->highlight_text ? 'highlight' : '' }} {{ $note->note_text ? 'note' : '' }}">
                                @if($note->highlight_text)
                                    <div class="note-highlight">
                                        <i class="fas fa-quote-left me-2"></i>
                                        "{{ $note->highlight_text }}"
                                    </div>
                                @endif
                                
                                @if($note->note_text)
                                    <div class="note-text">
                                        <i class="fas fa-sticky-note me-2"></i>
                                        {{ $note->note_text }}
                                    </div>
                                @endif
                                
                                <div class="note-meta">
                                    <span>
                                        <i class="fas fa-file-alt me-1"></i>
                                        Page {{ $note->page_number }}
                                    </span>
                                    <span>
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $note->created_at->format('M d, Y H:i') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-notes">
                        <i class="fas fa-sticky-note"></i>
                        <h4>No notes yet</h4>
                        <p>Start reading and add highlights or notes to keep track of important passages.</p>
                        <a href="/reader/{{ $book->id }}" class="btn btn-primary">
                            <i class="fas fa-book-open me-2"></i>Start Reading
                        </a>
                    </div>
                @endif
            </div>
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

        function filterNotes(type) {
            const notes = document.querySelectorAll('.note-item');
            const buttons = document.querySelectorAll('[id^="filter-"]');
            
            // Reset button styles
            buttons.forEach(btn => {
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-outline-primary');
            });
            
            // Highlight active button
            document.getElementById('filter-' + type).classList.remove('btn-outline-primary');
            document.getElementById('filter-' + type).classList.add('btn-primary');
            
            notes.forEach(note => {
                if (type === 'all') {
                    note.style.display = 'block';
                } else if (type === 'highlights') {
                    note.style.display = note.dataset.type.includes('highlight') ? 'block' : 'none';
                } else if (type === 'notes') {
                    note.style.display = note.dataset.type.includes('note') ? 'block' : 'none';
                }
            });
        }
        
        // Set default filter
        document.addEventListener('DOMContentLoaded', function() {
            filterNotes('all');
        });
    </script>
</body>
</html>
