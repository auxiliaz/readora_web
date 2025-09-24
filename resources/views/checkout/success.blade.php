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
        }
        
        .success-content {
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
        
        .success-icon {
            width: 120px;
            height: 120px;
            background: var(--primary-color);
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
            color: #000;
            margin-bottom: 1rem;
        }
        
        .success-subtitle {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 0;
        }
        
        .order-summary {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: left;
            height: fit-content;
        }
        
        .order-item {
            display: flex;
            align-items: center;
            padding: 1rem 0; 
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
            margin-top: -50px;
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 3rem;
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
            text-decoration: none;
        }

        .cta-button:hover {
            background: #5a0010;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            color: white;
        }

        @media (max-width: 768px) {
            .success-title {
                font-size: 2rem;
            }
            
            .success-section {
                padding: 50px 0;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .cta-button {
                width: 100%;
                max-width: 250px;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('components.navbar')

    <!-- Success Section -->
    <section class="success-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Success Content - Kiri -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="success-content">
                        <div class="success-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        
                        <h1 class="success-title">Pembayaran Berhasil!</h1>
                        <p class="success-subtitle">
                            Terima kasih atas pembelianmu. Buku-buku telah ditambahkan ke perpustakaan kamu dan siap untuk dibaca.
                        </p>
                    </div>
                </div>
                
                <!-- Order Summary - Kanan -->
                <div class="col-lg-6">
                    <div class="order-summary">
                        <h4 class="mb-3">
                            <i class="fas fa-receipt me-2" style="color: #710014"></i>Order Details
                        </h4>
                        <div class="row mb-3">
                            <div class="col-sm-6 mb-2 mb-sm-0">
                                <strong>Order ID:</strong> {{ $order->midtrans_order_id }}
                            </div>
                            <div class="col-sm-6">
                                <strong>Tanggal:</strong> {{ $order->created_at->format('M d, Y H:i') }}
                            </div>
                        </div>
                        
                        @foreach($order->orderItems as $item)
                            <div class="order-item">
                                <img src="{{ $item->book->cover_image_url }}" 
                                     alt="{{ $item->book->title }}" class="item-image">
                                <div class="item-details">
                                    <div class="item-title">{{ $item->book->title }}</div>
                                    <div class="item-author">by {{ $item->book->author ? $item->book->author->nama : 'Unknown Author' }}</div>
                                </div>
                                <div class="item-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                        
                        <div class="text-end mt-3 pt-3 border-top">
                            <h5>Total: <span class="fw-bold" style="color: #710014">Rp 270.000</span></h5>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </section>

    <!-- Action Buttons Section -->
    <section class="py-2" style="background-color: var(--background-color);">
        <div class="container">
            <div class="action-buttons">
                <a href="/library" class="cta-button">
                    <i class="fas fa-book me-2"></i>
                    Perpustakaan
                </a>
                <a href="/categories" class="cta-button">
                    <i class="fas fa-shopping-cart me-2"></i>
                    Lanjut Berbelanja
                </a>
            </div>
        </div>
    </section>

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>