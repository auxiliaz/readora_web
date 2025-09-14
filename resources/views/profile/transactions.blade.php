<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History - Readora</title>
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
        
        .transactions-section {
            padding: 60px 0;
        }
        
        .transaction-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }
        
        .transaction-header {
            background: #f8f9fa;
            padding: 1.5rem;
            border-bottom: 1px solid #dee2e6;
        }
        
        .transaction-body {
            padding: 1.5rem;
        }
        
        .order-id {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
        }
        
        .order-status {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .status-completed {
            background: #d4edda;
            color: #155724;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-failed {
            background: #f8d7da;
            color: #721c24;
        }
        
        .book-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }
        
        .book-item:last-child {
            border-bottom: none;
        }
        
        .book-cover-small {
            width: 60px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 1rem;
        }
        
        .book-details {
            flex: 1;
        }
        
        .book-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .book-author {
            color: #666;
            font-size: 0.9rem;
        }
        
        .book-price {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .breadcrumb {
            background: transparent;
            padding: 1rem 0;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #5a0010;
            border-color: #5a0010;
        }
        
        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .empty-state {
            text-align: center;
            padding: 4rem 0;
        }
        
        .empty-state i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('components.navbar')
 

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Transaction History</h1>
            <p class="lead">View all your past orders and purchases</p>
        </div>
    </section>
   <!-- Breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/profile">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transaction History</li>
            </ol>
        </nav>
    </div>
    <!-- Transactions Section -->
    <section class="transactions-section">
        <div class="container">
            @if($orders->count() > 0)
                @foreach($orders as $order)
                    <div class="transaction-card">
                        <div class="transaction-header">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="order-id">Order #{{ $order->id }}</div>
                                    <div class="text-muted">{{ $order->created_at->format('M d, Y H:i') }}</div>
                                </div>
                                <div class="col-md-3">
                                    <span class="order-status status-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <div class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                    <div class="text-muted small">{{ $order->orderItems->count() }} {{ Str::plural('item', $order->orderItems->count()) }}</div>
                                </div>
                                <div class="col-md-3 text-end">
                                    <a href="/profile/orders/{{ $order->id }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="transaction-body">
                            @foreach($order->orderItems as $item)
                                <div class="book-item">
                                    <img src="{{ $item->book->cover_image ?? 'https://via.placeholder.com/60x80?text=Book' }}" 
                                         alt="{{ $item->book->title }}" class="book-cover-small">
                                    <div class="book-details">
                                        <div class="book-title">{{ $item->book->title }}</div>
                                        <div class="book-author">by {{ $item->book->author }}</div>
                                    </div>
                                    <div class="book-price">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                            
                            @if($order->status === 'completed')
                                <div class="mt-3 pt-3 border-top">
                                    <div class="d-flex gap-2">
                                        <a href="/library" class="btn btn-success btn-sm">
                                            <i class="fas fa-book me-1"></i>View in Library
                                        </a>
                                        @if($order->orderItems->count() === 1)
                                            <a href="/reader/{{ $order->orderItems->first()->book->id }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-book-open me-1"></i>Start Reading
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-receipt"></i>
                    <h3>No transactions found</h3>
                    <p class="text-muted">You haven't made any purchases yet. Start exploring our book collection!</p>
                    <a href="/categories" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i>Browse Books
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
    </script>
</body>
</html>
