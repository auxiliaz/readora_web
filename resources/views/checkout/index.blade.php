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
        
        .checkout-section {
            padding: 60px 0;
        }
        
        .checkout-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
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
            margin-bottom: 0.25rem;
        }
        
        .item-price {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }
        
        .summary-row:last-child {
            border-bottom: none;
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 1rem 0;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
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
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .payment-method:hover {
            border-color: var(--primary-color);
        }
        
        .payment-method i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
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
                <li class="breadcrumb-item"><a href="/cart">Cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </div>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Checkout</h1>
            <p class="lead">Complete your purchase securely</p>
        </div>
    </section>

    <!-- Checkout Section -->
    <section class="checkout-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Order Summary -->
                    <div class="checkout-card">
                        <h4 class="section-title">Order Summary</h4>
                        
                        @foreach($cart->cartItems as $item)
                            <div class="order-item">
                                <img src="{{ $item->book->cover_image ?? 'https://via.placeholder.com/90x135?text=Book+Cover' }}" 
                                     alt="{{ $item->book->title }}" class="item-image">
                                <div class="item-details">
                                    <div class="item-title">{{ $item->book->title }}</div>
                                    <div class="item-author">by {{ $item->book->author }}</div>
                                    <div class="text-muted small">Quantity: {{ $item->quantity }}</div>
                                </div>
                                <div class="item-price">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Payment Method -->
                    <div class="checkout-card">
                        <h4 class="section-title">Payment Method</h4>
                        <p class="text-muted">Choose your preferred payment method. You will be redirected to secure payment gateway.</p>
                        
                        <div class="payment-methods">
                            <div class="payment-method">
                                <i class="fas fa-credit-card"></i>
                                <div>Credit Card</div>
                            </div>
                            <div class="payment-method">
                                <i class="fas fa-university"></i>
                                <div>Bank Transfer</div>
                            </div>
                            <div class="payment-method">
                                <i class="fas fa-mobile-alt"></i>
                                <div>E-Wallet</div>
                            </div>
                            <div class="payment-method">
                                <i class="fas fa-store"></i>
                                <div>Convenience Store</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Payment Summary -->
                    <div class="checkout-card">
                        <h4 class="section-title">Payment Details</h4>
                        
                        <div class="summary-row">
                            <span>Subtotal ({{ $cart->cartItems->sum('quantity') }} items)</span>
                            <span>Rp {{ number_format($cart->total_amount, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Tax</span>
                            <span>Rp 0</span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Processing Fee</span>
                            <span>Rp 0</span>
                        </div>
                        
                        <div class="summary-row">
                            <strong>Total</strong>
                            <strong>Rp {{ number_format($cart->total_amount, 0, ',', '.') }}</strong>
                        </div>
                        
                        <button class="btn btn-primary w-100 btn-lg mt-3" onclick="processCheckout()">
                            <i class="fas fa-lock me-2"></i>Pay Now
                        </button>
                        
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="fas fa-shield-alt me-1"></i>
                                Your payment is secured by Midtrans
                            </small>
                        </div>
                        
                        <a href="/cart" class="btn btn-outline-secondary w-100 mt-2">
                            <i class="fas fa-arrow-left me-2"></i>Back to Cart
                        </a>
                    </div>

                    <!-- Security Info -->
                    <div class="checkout-card">
                        <h6><i class="fas fa-shield-alt text-success me-2"></i>Secure Checkout</h6>
                        <ul class="list-unstyled small text-muted">
                            <li><i class="fas fa-check text-success me-2"></i>SSL encrypted payment</li>
                            <li><i class="fas fa-check text-success me-2"></i>PCI DSS compliant</li>
                            <li><i class="fas fa-check text-success me-2"></i>No card details stored</li>
                            <li><i class="fas fa-check text-success me-2"></i>Instant access after payment</li>
                        </ul>
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
            <h5>Pembayaran Anda sedag dalam proses...</h5>
            <p class="text-muted">Mohon tunggu sementara kami mengarahkan Anda ke halaman sukses pembayaran.</p>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                if (data.success) {
                    // In a real implementation, you would use Midtrans Snap
                    // For demo purposes, we'll redirect to success page after a delay
                    setTimeout(() => {
                        window.location.href = data.redirect_url;
                    }, 2000);
                } else {
                    document.getElementById('loadingOverlay').style.display = 'none';
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
