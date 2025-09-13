<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Readora</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: #5a0010;
            border-color: #5a0010;
        }
        
        .profile-header {
            background: linear-gradient(135deg, var(--primary-color), #8b0018);
            color: white;
            padding: 60px 0;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 700;
            margin: 0 auto 1rem;
        }
        
        .profile-name {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        
        .profile-email {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .profile-content {
            padding: 60px 0;
        }
        
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .stats-label {
            color: #666;
            font-weight: 500;
        }
        
        .section-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }
        
        .order-item {
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .order-id {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .order-status {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
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
        
        .review-item {
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
        }
        
        .review-item:last-child {
            border-bottom: none;
        }
        
        .rating-stars {
            color: #ffc107;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 1rem 0;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .profile-tabs {
            display: flex;
            border-bottom: 2px solid #eee;
            margin-bottom: 2rem;
        }
        
        .profile-tab {
            padding: 1rem 2rem;
            background: none;
            border: none;
            color: #666;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .profile-tab.active {
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .edit-form {
            display: none;
        }
        
        .edit-form.active {
            display: block;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 0.75rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(113, 0, 20, 0.25);
        }
        
        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
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
                <li class="breadcrumb-item active" aria-current="page">My Profile</li>
            </ol>
        </nav>
    </div>

    <!-- Profile Header -->
    <section class="profile-header">
        <div class="container">
            <div class="text-center">
                <div class="profile-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h1 class="profile-name">{{ $user->name }}</h1>
                <p class="profile-email">{{ $user->email }}</p>
                <p class="text-muted">Member since {{ $user->created_at->format('M Y') }}</p>
            </div>
        </div>
    </section>

    <!-- Profile Content -->
    <section class="profile-content">
        <div class="container">
            <!-- Statistics -->
            <div class="row mb-5">
                <div class="col-md-2 mb-3">
                    <div class="stats-card">
                        <div class="stats-number">{{ $stats['total_orders'] }}</div>
                        <div class="stats-label">Orders</div>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <div class="stats-card">
                        <div class="stats-number">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</div>
                        <div class="stats-label">Total Spent</div>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <div class="stats-card">
                        <div class="stats-number">{{ $stats['books_owned'] }}</div>
                        <div class="stats-label">Books Owned</div>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <div class="stats-card">
                        <div class="stats-number">{{ $stats['wishlist_count'] }}</div>
                        <div class="stats-label">Wishlist</div>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <div class="stats-card">
                        <div class="stats-number">{{ $stats['reviews_written'] }}</div>
                        <div class="stats-label">Reviews</div>
                    </div>
                </div>
            </div>

            <!-- Profile Tabs -->
            <div class="profile-tabs">
                <button class="profile-tab active" data-tab="overview">Overview</button>
                <button class="profile-tab" data-tab="settings">Account Settings</button>
                <button class="profile-tab" data-tab="transactions">Transactions</button>
            </div>

            <!-- Tab Contents -->
            <div id="messageContainer"></div>

            <!-- Overview Tab -->
            <div class="tab-content active" id="overview">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Recent Orders -->
                        <div class="section-card">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="section-title mb-0">Recent Orders</h3>
                                <a href="/profile/transactions" class="btn btn-outline-primary btn-sm">View All</a>
                            </div>
                            
                            @forelse($recentOrders as $order)
                                <div class="order-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="order-id">#{{ $order->id }}</div>
                                            <div class="text-muted small">{{ $order->created_at->format('M d, Y') }}</div>
                                            <div class="mt-1">
                                                @foreach($order->orderItems->take(2) as $item)
                                                    <small class="text-muted">{{ $item->book->title }}</small>
                                                    @if(!$loop->last)<br>@endif
                                                @endforeach
                                                @if($order->orderItems->count() > 2)
                                                    <small class="text-muted">+{{ $order->orderItems->count() - 2 }} more</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="order-status status-{{ $order->status }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                            <div class="fw-bold mt-1">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted text-center">No orders yet. <a href="/categories">Start shopping!</a></p>
                            @endforelse
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <!-- Recent Reviews -->
                        <div class="section-card">
                            <h3 class="section-title">Recent Reviews</h3>
                            
                            @forelse($recentReviews as $review)
                                <div class="review-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fw-bold">{{ $review->book->title }}</div>
                                            <div class="rating-stars mb-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                                @endfor
                                            </div>
                                            @if($review->review_text)
                                                <p class="text-muted small mb-0">{{ Str::limit($review->review_text, 100) }}</p>
                                            @endif
                                        </div>
                                        <small class="text-muted">{{ $review->created_at->format('M d') }}</small>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted text-center">No reviews yet. Purchase books to leave reviews!</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="section-card">
                    <h3 class="section-title">Quick Actions</h3>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="/library" class="btn btn-outline-primary w-100">
                                <i class="fas fa-book me-2"></i>My Library
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="/wishlist" class="btn btn-outline-primary w-100">
                                <i class="fas fa-heart me-2"></i>Wishlist
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="/categories" class="btn btn-outline-primary w-100">
                                <i class="fas fa-shopping-bag me-2"></i>Browse Books
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="/profile/transactions" class="btn btn-outline-primary w-100">
                                <i class="fas fa-receipt me-2"></i>Order History
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Tab -->
            <div class="tab-content" id="settings">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Profile Information -->
                        <div class="section-card">
                            <h3 class="section-title">Profile Information</h3>
                            
                            <div id="profileDisplay">
                                <div class="mb-3">
                                    <strong>Name:</strong> {{ $user->name }}
                                </div>
                                <div class="mb-3">
                                    <strong>Email:</strong> {{ $user->email }}
                                </div>
                                <button class="btn btn-primary" onclick="showEditProfile()">
                                    <i class="fas fa-edit me-2"></i>Edit Profile
                                </button>
                            </div>
                            
                            <div class="edit-form" id="profileEditForm">
                                <form id="updateProfileForm">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <button type="button" class="btn btn-secondary" onclick="hideEditProfile()">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <!-- Change Password -->
                        <div class="section-card">
                            <h3 class="section-title">Change Password</h3>
                            
                            <form id="changePasswordForm">
                                <div class="form-group">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" class="form-control" name="current_password" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" required>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-lock me-2"></i>Update Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transactions Tab -->
            <div class="tab-content" id="transactions">
                <div class="section-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="section-title mb-0">Transaction History</h3>
                        <a href="/profile/transactions" class="btn btn-outline-primary">View Full History</a>
                    </div>
                    
                    @forelse($recentOrders as $order)
                        <div class="order-item">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="order-id">#{{ $order->id }}</div>
                                    <div class="text-muted small">{{ $order->created_at->format('M d, Y H:i') }}</div>
                                </div>
                                <div class="col-md-4">
                                    @foreach($order->orderItems->take(2) as $item)
                                        <div class="small">{{ $item->book->title }}</div>
                                    @endforeach
                                    @if($order->orderItems->count() > 2)
                                        <div class="small text-muted">+{{ $order->orderItems->count() - 2 }} more items</div>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <span class="order-status status-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <div class="col-md-2">
                                    <div class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                </div>
                                <div class="col-md-1">
                                    <a href="/profile/orders/{{ $order->id }}" class="btn btn-sm btn-outline-primary">View</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">No transactions found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Load cart count on page load
        fetch('/cart/count')
            .then(response => response.json())
            .then(data => {
                document.getElementById('cart-count').textContent = data.count;
            });

        // Tab switching
        document.querySelectorAll('.profile-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                const tabName = this.dataset.tab;
                
                // Update active tab
                document.querySelectorAll('.profile-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                // Update active content
                document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
                document.getElementById(tabName).classList.add('active');
            });
        });

        // Profile editing
        function showEditProfile() {
            document.getElementById('profileDisplay').style.display = 'none';
            document.getElementById('profileEditForm').classList.add('active');
        }

        function hideEditProfile() {
            document.getElementById('profileDisplay').style.display = 'block';
            document.getElementById('profileEditForm').classList.remove('active');
        }

        // Update profile form
        document.getElementById('updateProfileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('/profile/update', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage(data.message, 'success');
                    hideEditProfile();
                    // Update display
                    location.reload();
                } else {
                    showMessage(data.message || 'Error updating profile', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('Error updating profile. Please try again.', 'error');
            });
        });

        // Change password form
        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('/profile/password', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage(data.message, 'success');
                    this.reset();
                } else {
                    showMessage(data.message || 'Error updating password', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('Error updating password. Please try again.', 'error');
            });
        });

        function showMessage(message, type) {
            const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            const alertHtml = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            
            const messageContainer = document.getElementById('messageContainer');
            messageContainer.innerHTML = alertHtml;
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                const alert = messageContainer.querySelector('.alert');
                if (alert) {
                    alert.remove();
                }
            }, 5000);
        }
    </script>
</body>
</html>
