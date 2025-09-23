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

        h1, h5 {
            font-family: 'Playfair Display', serif;
        }
        
        p, .text {
            font-family: 'Poppins', sans-serif;
        }
        

        .cart-section {
            padding: 5px 40px;
            background-color: var(--background-color);
            margin-top: -30px;
        }
        
        .cart-container {
            max-width: 1138px;
            margin: 0 auto;
        }

        .cart-items-container {
            background: var(--background-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-light);
            overflow-y: auto;
            margin-bottom: 2rem;
            max-height: calc(100vh - 200px);
            min-height: 300px; 
            overflow-y: auto; 
            padding-right: 10px;
        }

        .cart-items-container {
            overflow-y: scroll;
        }

        .cart-items-container::-webkit-scrollbar {
            width: 6px;
        }
        .cart-items-container::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 3px;
        }
        .cart-items-container::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .cart-item {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
        }

        .cart-item::after {
            content: "";
            display: block;
            width: 100%; 
            height: 1px;
            background: rgba(113, 0, 20, 0.4);
            position: absolute;
            bottom: 0;
            width: calc(100% - 35px);
}
        
        .cart-item:last-child {
            border-bottom: none;
        }
    
        
        .cart-item.unselected {
            opacity: 0.5;
            background-color: var(--background-color);
        }
        
        
        .remove-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            color: #999;
            font-size: 18px;
            cursor: pointer;
            padding: 5px;
            transition: var(--transition);
        }
        
        .remove-btn:hover {
            color: #710014;
            transform: scale(1.1);
        }
        
        .item-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--primary-color);
            margin-right: 10px;
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
        
        .item-subtitle {
            color: #666;
            font-size: 12px;
            margin-bottom: 8px;
        }
        
        .item-price {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 16px;
        }
        
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
        }
        
        .quantity-btn {
            background: #f0f0f0;
            border: none;
            border-radius: 4px;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            font-size: 12px;
        }
        
        .quantity-btn:hover {
            background: #e0e0e0;
        }
        
        .quantity-input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 4px;
            font-size: 12px;
            height: 28px;
        }
    
        .cart-summary {
            background: var(--background-color);
            margin-top: 20px;
            padding: 30px;
            height: fit-content;
            position: relative;
            top: 15px;
            z-index: 100;
            margin-bottom: 60px;
        }

        .cart-summary::before {
            content: "";
            position: absolute;
            left: 0;
            top: 40px;
            height: 300px;
        }
        
        .summary-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 25px;
            font-family: 'Playfair Display', serif;
            letter-spacing: 0.5px;
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
        
        .btn-checkout {
            background: #333;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: 100%;
            transition: var(--transition);
            margin-bottom: 15px;
        }
        
        .btn-checkout:hover:not(:disabled) {
            background: #222;
            transform: translateY(-1px);
        }
        
        .btn-checkout:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
        
        .btn-continue {
            background: transparent;
            color: #333;
            border: 2px solid #333;
            border-radius: 6px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: 100%;
            transition: var(--transition);
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-continue:hover {
            background: #333;
            color: white;
            text-decoration: none;
        }
        
        .cart-header {
            background: var(--background-color);
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .select-all-section {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            font-size: 14px;
        }
        
        .select-all-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--primary-color);
        }
        
        .btn-clear {
            background: #710014;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: 500;
            font-size: 13px;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .btn-clear:hover {
            background: #550110;
            transform: translateY(-1px);
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
        
        @media (max-width: 768px) {
            .cart-header {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }
            
            .cart-item {
                flex-wrap: wrap;
                gap: 10px;
            }
            
            .item-details {
                min-width: 150px;
            }
            
            .quantity-controls {
                margin-top: 5px;
            }
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

        .empty-cart .cta-button {
            width: auto;          
            display: inline-flex; 
            padding: 10px 25px;   
            margin: 0 auto;       
        }
        .cart-actions {
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('components.navbar')

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="fw-bold" style="color: #710014">Keranjang</h1>
            <p class="text" style="color: #000000">Cek kembali item yang dipilih sebelum Anda checkout.</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Cart Section -->
    <section class="cart-section">
        <div class="container cart-container">
            @if($cartItems->count() > 0)
                <div class="row g-4">
                    <div class="col-lg-8">
                        <!-- Cart Header -->
                        <div class="cart-header">
                            <div class="select-all-section">
                                <input type="checkbox" class="select-all-checkbox" id="selectAll" onchange="toggleSelectAll()">
                                <span>Pilih Semua ({{ $cartItems->count() }} item)</span>
                            </div>
                            <button class="btn-clear" onclick="clearCart()">
                                <i class="fas fa-trash me-2"></i>Hapus Semua
                            </button>
                        </div>

                        <!-- Cart Items -->
                        <div class="cart-items-container">
                            @foreach($cartItems as $item)
                                <div class="cart-item" id="cart-item-{{ $item->id }}">
                                    <button class="remove-btn" onclick="removeItem({{ $item->id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    
                                    <input type="checkbox" class="item-checkbox" id="item-{{ $item->id }}" 
                                           data-item-id="{{ $item->id }}" 
                                           data-price="{{ $item->book->price }}" 
                                           data-quantity="{{ $item->quantity }}" 
                                           data-subtotal="{{ $item->subtotal }}"
                                           onchange="toggleItemSelection({{ $item->id }})" checked>
                                    
                                    <img src="{{ $item->book->cover_image ?? 'https://via.placeholder.com/80x110?text=Book' }}" 
                                         alt="{{ $item->book->title }}" class="item-image">
                                    
                                    <div class="item-details">
                                        <div class="item-title">{{ $item->book->title }}</div>
                                        <div class="item-subtitle">{{ $item->book->category->name }}</div>
                                        <div class="item-subtitle">by {{ $item->book->author ? $item->book->author->nama : 'Unknown Author' }}</div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <div class="item-price">Rp {{ number_format($item->book->price, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <div class="summary-title">Cart Totals</div>
                            
                            <div class="summary-row">
                                <span class="summary-label">Subtotal (<span id="selected-items-count">{{ $cartItems->sum('quantity') }}</span> items dipilih)</span>
                                <span class="summary-value" id="cart-subtotal">Rp {{ number_format($cart->total_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Total</span>
                                <span class="summary-value" id="cart-total">Rp {{ number_format($cart->total_amount, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="cart-actions">
                                <button id="cta-button" class="cta-button mt-5" onclick="proceedToCheckout()">
                                    Proceed to Checkout
                                </button>
                                <a href="/categories" class="cta-button">
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart" style="color: var(--primary-color)"></i>
                    <h3>Keranjang kosong...</h3>
                    <p class="text-muted">Mulai tambahkan buku yang ingin Anda beli ke dalam keranjang!</p>
                    <a href="/categories" class="cta-button">Cari Buku
                    </a>
                </div>
            @endif
        </div>
    </section>

    @include('components.footer')

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
                    const checkbox = document.getElementById(`item-${itemId}`);
                    checkbox.setAttribute('data-quantity', quantity);
                    checkbox.setAttribute('data-subtotal', data.subtotal);
                    updateCartSummary();
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
                            updateCartSummary();
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

        function toggleSelectAll() {
            const selectAllCheckbox = document.getElementById('selectAll');
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');
            
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
                const itemId = checkbox.getAttribute('data-item-id');
                const cartItem = document.getElementById(`cart-item-${itemId}`);
                
                if (checkbox.checked) {
                    cartItem.classList.remove('unselected');
                } else {
                    cartItem.classList.add('unselected');
                }
            });
            
            updateCartSummary();
        }

        function toggleItemSelection(itemId, updateSelectAll = true) {
            const checkbox = document.getElementById(`item-${itemId}`);
            const cartItem = document.getElementById(`cart-item-${itemId}`);
            
            if (checkbox.checked) {
                cartItem.classList.remove('unselected');
            } else {
                cartItem.classList.add('unselected');
            }
            
            if (updateSelectAll) {
                updateSelectAllCheckbox();
            }
            
            updateCartSummary();
        }

        function updateSelectAllCheckbox() {
            const selectAllCheckbox = document.getElementById('selectAll');
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');
            const checkedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
            
            if (itemCheckboxes.length === 0) {
                return;
            }
            
            if (checkedCheckboxes.length === itemCheckboxes.length) {
                selectAllCheckbox.checked = true;
                selectAllCheckbox.indeterminate = false;
            } else if (checkedCheckboxes.length === 0) {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = false;
            } else {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = true;
            }
        }

        function updateCartSummary() {
            const checkedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
            let totalAmount = 0;
            let totalItems = 0;
            
            checkedCheckboxes.forEach(checkbox => {
                const subtotal = parseFloat(checkbox.getAttribute('data-subtotal'));
                const quantity = parseInt(checkbox.getAttribute('data-quantity'));
                totalAmount += subtotal;
                totalItems += quantity;
            });
            
            document.getElementById('selected-items-count').textContent = totalItems;
            document.getElementById('cart-subtotal').textContent = 
                'Rp ' + new Intl.NumberFormat('id-ID').format(totalAmount);
            document.getElementById('cart-total').textContent = 
                'Rp ' + new Intl.NumberFormat('id-ID').format(totalAmount);
            
            // Enable/disable checkout button based on selection
            const checkoutBtn = document.getElementById('cta-button');
            if (checkoutBtn) {
                if (checkedCheckboxes.length === 0) {
                    checkoutBtn.disabled = true;
                    checkoutBtn.innerHTML = 'Pilih item untuk checkout';
                } else {
                    checkoutBtn.disabled = false;
                    checkoutBtn.innerHTML = 'Proceed to Checkout';
                }
            }
        }

        function proceedToCheckout() {
            const checkedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
            
            if (checkedCheckboxes.length === 0) {
                alert('Pilih minimal satu item untuk checkout');
                return;
            }
            
            const selectedItems = [];
            checkedCheckboxes.forEach(checkbox => {
                selectedItems.push(checkbox.getAttribute('data-item-id'));
            });
            
            // Store selected items in session storage for checkout page
            sessionStorage.setItem('selectedCartItems', JSON.stringify(selectedItems));
            
            // Redirect to checkout
            window.location.href = '/checkout';
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            updateSelectAllCheckbox();
            updateCartSummary();
        });
    </script>
</body>
</html>