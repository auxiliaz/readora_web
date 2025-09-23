<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Readora</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #710014;
            --secondary-color: #B38F6F;
            --background-color: #F2F1ED;
            --text-color: #000000;
            --card-bg: #ffffff;
            --shadow-light: 0 5px 12px rgba(0,0,0,0.05);
            --shadow-hover: 0 4px 12px rgba(0,0,0,0.08);
            --border-radius: 8px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: var(--text-color);
            min-height: 100vh;
        }
        
        .page-header {
            background: var(--background-color);
            color: white;
            padding: 40px 0;
        }
        
        .page-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 2.5rem;
        }
        
        .breadcrumb {
            background: transparent;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
        }

        h1, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }
        
        p, .text {
            font-family: 'Poppins', sans-serif;
        }

        .checkout-section {
            padding: 5px 40px;
            background-color: var(--background-color);
            margin-top: -30px;
        }
        
        .checkout-container {
            max-width: 1210px;
            margin: 0 auto;
        }

        .checkout-card {
            background: var(--background-color);
            border-radius: var(--border-radius);
            padding: 30px;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 25px;
            font-family: 'Playfair Display', serif;
            letter-spacing: 0.5px;
        }
        
        .order-items-container {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 1rem;
            padding-right: 10px;
        }

        .order-items-container::-webkit-scrollbar {
            width: 6px;
        }
        .order-items-container::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 3px;
        }
        .order-items-container::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .order-item {
            padding: 20px 0;
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
        }

        .order-item::after {
            content: "";
            display: block;
            width: 100%; 
            height: 1px;
            background: rgba(113, 0, 20, 0.4);
            position: absolute;
            bottom: 0;
            width: calc(100% - 15px);
        }
        
        .order-item:last-child::after {
            display: none;
        }
        
        .item-image {
            width: 80px;
            height: 110px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            flex-shrink: 0;
        }
        
        .item-details {
            flex: 1;
            min-width: 0;
        }
        
        .item-title {
            font-weight: 600;
            color: #000;
            margin-bottom: 5px;
            font-size: 14px;
            line-height: 1.4;
        }
        
        .item-author {
            color: #666;
            font-size: 12px;
            margin-bottom: 4px;
        }
        
        .item-quantity {
            color: #666;
            font-size: 12px;
            margin-bottom: 8px;
        }
        
        .item-price {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 16px;
        }

        .payment-summary {
            background: var(--background-color);
            margin-top: 20px;
            padding: 30px;
            height: fit-content;
            position: relative;
            top: 15px;
            z-index: 100;
            margin-bottom: 60px;
        }

        .payment-summary::before {
            content: "";
            position: absolute;
            left: 0;
            top: 40px;
            height: 300px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-size: 14px;
        }
        
        .summary-row:last-child {
            border-top: 2px solid #eee;
            padding-top: 15px;
            margin-top: 20px;
            font-weight: 700;
            font-size: 16px;
            color: #333;
        }
        
        .summary-label {
            color: #666;
        }
        
        .summary-value {
            font-weight: 600;
            color: var(--primary-color);
        }

        .cta-button {
            text-decoration: none;   
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            display: block;       
            width: 100%;            
            margin-bottom: 10px;    
            padding: 10px 20px;  
            text-align: center;
        }

        .cta-button:hover {
            background: #5a0010;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .payment-method {
            text-align: center;
            padding: 1rem;
            border: 2px solid #eee;
            border-radius: var(--border-radius);
            transition: var(--transition);
            background: white;
        }
        
        .payment-method:hover {
            border-color: var(--primary-color);
            box-shadow: var(--shadow-hover);
        }
        
        .payment-method i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .payment-method div {
            font-size: 12px;
            font-weight: 500;
            color: #666;
        }

        .security-info {
            background: var(--background-color);
            padding: 20px;
            border-radius: var(--border-radius);
            margin-top: 20px;
            box-shadow: var(--shadow-light);
        }

        .security-info h6 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 15px;
        }

        .security-info ul {
            margin: 0;
        }

        .security-info li {
            margin-bottom: 8px;
            font-size: 13px;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
        
        .loading-content {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            max-width: 600px;
            margin: 0 20px;
        }

        .loading-content h4 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-weight: 800;
            font-family: 'Poppins', sans-serif;
        }

        @media (max-width: 768px) {
            .checkout-section {
                padding: 5px 20px;
            }
            
            .order-item {
                flex-wrap: wrap;
                gap: 10px;
            }
            
            .item-details {
                min-width: 150px;
            }
            
            .payment-methods {
                grid-template-columns: repeat(2, 1fr);
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
            <h1 class="fw-bold" style="color: #710014">Checkout</h1>
            <p class="text" style="color: #000000">Selesaikan pembelian dengan aman dan dapatkan akses instan ke buku Anda.</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="/cart">Keranjang</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Checkout Section -->
    <section class="checkout-section">
        <div class="container checkout-container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <!-- Order Summary -->
                    <div class="checkout-card">
                        <h4 class="section-title">Order Summary</h4>
                        
                        <div class="order-items-container">
                            @foreach($cart->cartItems as $item)
                                <div class="order-item">
                                    <img src="{{ $item->book->cover_image ?? 'https://via.placeholder.com/80x110?text=Book' }}" 
                                         alt="{{ $item->book->title }}" class="item-image">
                                    
                                    <div class="item-details">
                                        <div class="item-title">{{ $item->book->title }}</div>
                                        <div class="item-author">by {{ $item->book->author ? $item->book->author->nama : 'Unknown Author' }}</div>
                                        <div class="item-quantity">Quantity: {{ $item->quantity }}</div>
                                    </div>
                                    
                                    <div class="item-price">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Payment Summary -->
                    <div class="payment-summary">
                        <div class="section-title">Payment Details</div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Subtotal ({{ $cart->cartItems->sum('quantity') }} items dipilih)</span>
                            <span class="summary-value">Rp {{ number_format($cart->total_amount, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Diskon</span>
                            <span class="summary-value">Rp 0</span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Biaya Admin</span>
                            <span class="summary-value">Rp 0</span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Total</span>
                            <span class="summary-value">Rp {{ number_format($cart->total_amount, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="mt-4">
                            <button class="cta-button" onclick="processCheckout()">
                               Bayar Sekarang
                            </button>       
                            <a href="/cart" class="cta-button">
                            Kembali ke Keranjang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <h4>Pembayaran Anda sedang dalam proses...</h4>
            <p class="text-muted">Mohon tunggu sementara kami mengarahkan Anda ke halaman sukses pembayaran.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script>
        function processCheckout() {
            // Show loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';
            
            fetch('/checkout/process', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Hide loading overlay
                document.getElementById('loadingOverlay').style.display = 'none';
                
                if (data.success) {
                    // Use Midtrans Snap to show payment popup
                    snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            console.log('Payment success:', result);
                            window.location.href = data.redirect_url;
                        },
                        onPending: function(result) {
                            console.log('Payment pending:', result);
                            alert('Payment is being processed. Please wait for confirmation.');
                            window.location.href = data.redirect_url;
                        },
                        onError: function(result) {
                            console.log('Payment error:', result);
                            alert('Payment failed. Please try again.');
                        },
                        onClose: function() {
                            console.log('Payment popup closed');
                            alert('Payment cancelled. You can try again anytime.');
                        }
                    });
                } else {
                    alert(data.message || 'Payment processing failed. Please try again.');
                }
            })
            .catch(error => {
                document.getElementById('loadingOverlay').style.display = 'none';
                console.error('Error:', error);
                alert('An error occurred while processing your payment. Please try again.');
            });
        }
    </script>
</body>
</html>