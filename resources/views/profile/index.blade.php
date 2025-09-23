<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Readora</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            --text-color: #000000;
            --card-shadow: 0 2px 8px rgba(0,0,0,0.08);
            --border-radius: 12px;
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
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #5a0010;
            border-color: #5a0010;
        }

        .page-header {
            background: var(--background-color);
            color: white;
            padding: 40px 0;
            margin-bottom: -20px;
        }


        .breadcrumb {
            background: transparent;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
        }

        .profile-container {
            background: var(--background-color);
            border-radius: var(--border-radius);
            overflow: hidden;
            margin: 5px 0;
        }

        .profile-header {
            background: var(--background-color);
            padding: 5px;
            border-bottom: 1px solid #e9ecef;
        }

        .profile-info {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: 700;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(113, 0, 20, 0.3);
        }

        .profile-details h1 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .profile-details .text-muted {
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .member-since {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .stats-section {
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 200px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 8px;
            display: block;
        }

        .stat-label {
            color: #6c757d;
            font-weight: 500;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .profile-nav {
            padding: 0 40px;
            border-bottom: 1px solid #e9ecef;
        }

        .nav-tabs {
            border-bottom: none;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 20px 30px;
            border-bottom: 3px solid transparent;
            background: none;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
            background: none;
        }

        .nav-tabs .nav-link:hover {
            color: var(--primary-color);
            border-color: transparent;
        }

        .tab-content {
            padding: 40px;
        }

        .profile-section {
            background: #f8f9fa;
            border-radius: var(--border-radius);
            padding: 30px;
            margin-bottom: 30px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--primary-color);
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #495057;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px 16px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(113, 0, 20, 0.15);
        }

        .profile-display-item {
            padding: 15px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .profile-display-item:last-child {
            border-bottom: none;
        }

        .profile-display-item strong {
            color: #495057;
            display: inline-block;
            min-width: 100px;
        }

        .edit-form {
            display: none;
        }

        .edit-form.active {
            display: block;
        }

        .transaction-item {
            background: #f8f9fa;
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid var(--primary-color);
        }

        .transaction-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 10px;
        }

        .transaction-id {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .transaction-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
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

        .transaction-amount {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
            border-radius: 8px;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Message Container */
        #messageContainer {
            position: sticky;
            top: 0;
            z-index: 1000;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-header {
                padding: 20px;
            }

            .profile-info {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .stats-section, .tab-content, .profile-nav {
                padding: 20px;
            }

            .nav-tabs .nav-link {
                padding: 15px 20px;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 20px;
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
            <h1 class="fw-bold" style="color: #710014; font-family: 'Playfair Display';">Profil Saya</h1>
            <p class="text" style="color: #000000">Kelola profil dan lihat histori transaksi mu di halaman ini.
            </p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Profile Content -->
    <section class="profile-content">
        <div class="container">
            <!-- Message Container -->
            <div id="messageContainer"></div>

            <div class="profile-container">
                <!-- Profile Header -->
                <div class="profile-header">
                    <div class="profile-info">
                        <div class="profile-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="profile-details">
                            <h1>{{ $user->name }}</h1>
                            <div class="text-muted">{{ $user->email }}</div>
                            <div class="member-since">Member since {{ $user->created_at->format('M Y') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="stats-section">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</span>
                            <div class="stat-label">Total Spent</div>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $stats['books_owned'] }}</span>
                            <div class="stat-label">Books Owned</div>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $stats['wishlist_count'] }}</span>
                            <div class="stat-label">Wishlist</div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="profile-nav">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">
                                <i class="fas fa-user me-2"></i>Profile Details
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="edit-profile-tab" data-bs-toggle="tab" data-bs-target="#edit-profile" type="button" role="tab">
                                <i class="fas fa-edit me-2"></i>Edit Profile
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="transactions-tab" data-bs-toggle="tab" data-bs-target="#transactions" type="button" role="tab">
                                <i class="fas fa-history me-2"></i>Transactions
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Profile Details Tab -->
                    <div class="tab-pane fade show active" id="profile" role="tabpanel">
                        <div class="profile-section">
                            <h3 class="section-title">Account Information</h3>
                            <div class="profile-display-item">
                                <strong>Full Name:</strong> {{ $user->name }}
                            </div>
                            <div class="profile-display-item">
                                <strong>Email:</strong> {{ $user->email }}
                            </div>
                            <div class="profile-display-item">
                                <strong>Member Since:</strong> {{ $user->created_at->format('F d, Y') }}
                            </div>
                        </div>
                    </div>

                    <!-- Edit Profile Tab -->
                    <div class="tab-pane fade" id="edit-profile" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="profile-section">
                                    <h3 class="section-title">Update Profile Information</h3>
                                    <form id="updateProfileForm">
                                        <div class="form-group">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Save Changes
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="profile-section">
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
                    <div class="tab-pane fade" id="transactions" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="section-title mb-0">Transaction History</h3>
                            <a href="/profile/transactions" class="btn btn-outline-primary">
                                <i class="fas fa-external-link-alt me-2"></i>View Full History
                            </a>
                        </div>

                        @forelse($recentOrders as $order)
                        <div class="transaction-item">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="transaction-id">#{{ $order->id }}</div>
                                    <div class="text-muted small">{{ $order->created_at->format('M d, Y H:i') }}</div>
                                </div>
                                <div class="col-md-4">
                                    @foreach($order->orderItems->take(2) as $item)
                                        <div class="small mb-1">{{ $item->book->title }}</div>
                                    @endforeach
                                    @if($order->orderItems->count() > 2)
                                        <div class="small text-muted">+{{ $order->orderItems->count() - 2 }} more items</div>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <span class="transaction-status status-{{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <div class="col-md-2">
                                    <div class="transaction-amount">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                </div>
                                <div class="col-md-1">
                                    <a href="/profile/orders/{{ $order->id }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No transactions found.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
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

        // Profile update form
        document.getElementById('updateProfileForm').addEventListener('submit', function (e) {
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
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
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
        document.getElementById('changePasswordForm').addEventListener('submit', function (e) {
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

        // Message display function
        function showMessage(message, type) {
            const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            const iconClass = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
            
            const alertHtml = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    <i class="${iconClass} me-2"></i>${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;

            const messageContainer = document.getElementById('messageContainer');
            messageContainer.innerHTML = alertHtml;
            
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