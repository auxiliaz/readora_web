<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Readora</title>
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
        
        .cart-section {
            padding: 60px 0;
        }
        
        .cart-item {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .item-image {
            width: 80px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .item-title {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }
        
        .item-author {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .item-price {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.1rem;
        }
        
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .quantity-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        
        .quantity-input {
            width: 60px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
        }
        
        .cart-summary {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            height: fit-content;
        }
        
        .summary-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
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
        
        .empty-cart {
            text-align: center;
            padding: 4rem 0;
        }
        
        .empty-cart i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 1rem;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 1rem 0;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
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
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </nav>
    </div>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Shopping Cart</h1>
            <p class="lead">Review your selected books before checkout</p>
        </div>
    </section>

    <!-- Cart Section -->
    <section class="cart-section">
        <div class="container">
            @if($cartItems->count() > 0)
                <div class="row">
                    <div class="col-lg-8">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4>Cart Items ({{ $cartItems->count() }})</h4>
                            <button class="btn btn-outline-danger" onclick="clearCart()">
                                <i class="fas fa-trash me-2"></i>Clear Cart
                            </button>
                        </div>

                        @foreach($cartItems as $item)
                            <div class="cart-item" id="cart-item-{{ $item->id }}">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <img src="{{ $item->book->cover_image ?? 'https://via.placeholder.com/120x180?text=Book+Cover' }}" 
                                             alt="{{ $item->book->title }}" class="item-image">
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="item-title">{{ $item->book->title }}</h6>
                                        <p class="item-author">by {{ $item->book->author }}</p>
                                        <p class="text-muted small">{{ $item->book->category->name }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="item-price">Rp {{ number_format($item->book->price, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="quantity-controls">
                                            <button class="quantity-btn" onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" class="quantity-input" value="{{ $item->quantity }}" 
                                                   min="1" max="10" id="quantity-{{ $item->id }}"
                                                   onchange="updateQuantity({{ $item->id }}, this.value)">
                                            <button class="quantity-btn" onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="item-price" id="subtotal-{{ $item->id }}">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-outline-danger btn-sm" onclick="removeItem({{ $item->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <h4 class="summary-title">Order Summary</h4>
                            
                            <div class="summary-row">
                                <span>Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                                <span id="cart-subtotal">Rp {{ number_format($cart->total_amount, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="summary-row">
                                <span>Tax</span>
                                <span>Rp 0</span>
                            </div>
                            
                            <div class="summary-row">
                                <strong>Total</strong>
                                <strong id="cart-total">Rp {{ number_format($cart->total_amount, 0, ',', '.') }}</strong>
                            </div>
                            
                            <a href="/checkout" class="btn btn-primary w-100 btn-lg mt-3">
                                <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                            </a>
                            
                            <a href="/categories" class="btn btn-outline-primary w-100 mt-2">
                                <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Your cart is empty</h3>
                    <p class="text-muted">Looks like you haven't added any books to your cart yet.</p>
                    <a href="/categories" class="btn btn-primary btn-lg">
                        <i class="fas fa-book me-2"></i>Browse Books
                    </a>
                </div>
            @endif
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateQuantity(itemId, quantity) {
            if (quantity < 1) {
                removeItem(itemId);
                return;
            }
            
            if (quantity > 10) {
                alert('Maximum quantity is 10');
                return;
            }

            fetch(`/cart/update/${itemId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`quantity-${itemId}`).value = quantity;
                    document.getElementById(`subtotal-${itemId}`).textContent = 
                        'Rp ' + new Intl.NumberFormat('id-ID').format(data.subtotal);
                    document.getElementById('cart-subtotal').textContent = 
                        'Rp ' + new Intl.NumberFormat('id-ID').format(data.total);
                    document.getElementById('cart-total').textContent = 
                        'Rp ' + new Intl.NumberFormat('id-ID').format(data.total);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the cart');
            });
        }

        function removeItem(itemId) {
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                fetch(`/cart/remove/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`cart-item-${itemId}`).remove();
                        document.getElementById('cart-count').textContent = data.cart_count;
                        
                        if (data.cart_count === 0) {
                            location.reload();
                        } else {
                            document.getElementById('cart-subtotal').textContent = 
                                'Rp ' + new Intl.NumberFormat('id-ID').format(data.total);
                            document.getElementById('cart-total').textContent = 
                                'Rp ' + new Intl.NumberFormat('id-ID').format(data.total);
                        }
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while removing the item');
                });
            }
        }

        function clearCart() {
            if (confirm('Are you sure you want to clear your entire cart?')) {
                fetch('/cart/clear', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while clearing the cart');
                });
            }
        }
    </script>
</body>
</html>
