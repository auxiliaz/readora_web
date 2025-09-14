<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - Readora</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #710014;
            --secondary-color: #B38F6F;
            --background-color: #F2F1ED;
            --text-color: #000000;
            --success-color: #10B981;
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
        
        .success-section {
            padding: 100px 0;
            text-align: center;
        }
        
        .success-icon {
            width: 120px;
            height: 120px;
            background: var(--success-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            animation: pulse 2s infinite;
        }
        
        .success-icon i {
            font-size: 3rem;
            color: white;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }
        
        .success-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 3rem;
            color: var(--success-color);
            margin-bottom: 1rem;
        }
        
        .success-subtitle {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 3rem;
        }
        
        .order-summary {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 3rem;
            text-align: left;
        }
        
        .order-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .item-image {
            width: 60px;
            height: 90px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 1rem;
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .item-author {
            color: #666;
            font-size: 0.9rem;
        }
        
        .item-price {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .btn-success:hover {
            background-color: #059669;
            border-color: #059669;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('components.navbar')
    <!-- Success Section -->
    <section class="success-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="success-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    
                    <h1 class="success-title">Pembayaran Berhasil!</h1>
                    <p class="success-subtitle">
                        Terima kasih atas pembelian Anda. Buku-buku telah ditambahkan ke perpustakaan Anda dan siap untuk dibaca.
                    </p>
                    
                    <!-- Order Summary -->
                    <div class="order-summary">
                        <h4 class="mb-3">
                            <i class="fas fa-receipt me-2"></i>Order Details
                        </h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Order ID:</strong> {{ $order->midtrans_order_id }}
                            </div>
                            <div class="col-md-6">
                                <strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}
                            </div>
                        </div>
                        
                        @foreach($order->orderItems as $item)
                            <div class="order-item">
                                <img src="{{ $item->book->cover_image ?? 'https://via.placeholder.com/90x135?text=Book+Cover' }}" 
                                     alt="{{ $item->book->title }}" class="item-image">
                                <div class="item-details">
                                    <div class="item-title">{{ $item->book->title }}</div>
                                    <div class="item-author">by {{ $item->book->author }}</div>
                                </div>
                                <div class="item-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                        
                        <div class="text-end mt-3 pt-3 border-top">
                            <h5>Total: <span class="text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span></h5>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <a href="/library" class="btn btn-success btn-lg">
                            <i class="fas fa-book-open me-2"></i>Go to Library
                        </a>
                        <a href="/categories" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                        </a>
                        <a href="/profile" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-user me-2"></i>View Profile
                        </a>
                    </div>
                    
                    <!-- Additional Info -->
                    <div class="mt-5">
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>What's Next?</h6>
                            <ul class="mb-0">
                                <li>Your books are now available in your <strong>Library</strong></li>
                                <li>You can read them anytime with our built-in PDF reader</li>
                                <li>Add highlights and personal notes while reading</li>
                                <li>Don't forget to leave a review to help other readers!</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
