<!-- Navigation Bar Component -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <img class="navbar-brand" src="{{ asset('assets/logo.svg') }}" alt="Readora Logo">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}" href="/categories">Kategori</a>
                </li>
            </ul>
            
            <ul class="navbar-nav">
                @auth
                    
                    <!-- Wishlist -->
                    <li class="nav-item">
                        <a class="nav-link nav-icon {{ request()->is('wishlist*') ? 'active' : '' }}" href="/wishlist" title="Wishlist">
                            <i class="fas fa-heart"></i>
                            <span class="badge bg-danger" id="wishlist-count">0</span>
                        </a>
                    </li>
                    
                    <!-- Cart -->
                    <li class="nav-item">
                        <a class="nav-link nav-icon {{ request()->is('cart*') ? 'active' : '' }}" href="/cart" title="Shopping Cart">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge bg-danger" id="cart-count">0</span>
                        </a>
                    </li>
                    
                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle user-dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="user-name">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item {{ request()->is('profile*') ? 'active' : '' }}" href="/profile">
                                    <i class="fas fa-user me-2"></i>Profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->is('library*') ? 'active' : '' }}" href="/library">
                                    <i class="fas fa-book me-2"></i>Perpustakaan
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- Guest Navigation -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
.navbar {
    background-color: #F2F1ED !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 0.50rem 0;
    border-bottom: 2px solid #710014;
}

.navbar-brand {
    width: 110px;
    height: auto;
    color: var(--primary-color) !important;
    font-size: 1.8rem;
}

.nav-link {
    color: var(--text-color) !important;
    font-weight: 500;
    transition: color 0.3s ease;
    position: relative;
}

.nav-link:hover,
.nav-link.active {
    color: var(--primary-color) !important;
}

.nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -0.03rem;
    left: 50%;
    transform: translateX(-50%);
    width: 30px;
    height: 2px;
    background-color: var(--primary-color);
}

.nav-icon i {
    position: relative;
    padding: 0.5rem 1rem !important;
    margin-top: 5px;
}

.nav-icon .badge {
    position: absolute;
    top: 0.30rem;
    right: 0.5rem;
    font-size: 0.7rem;
    min-width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.user-dropdown {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem !important;
    margin-top: 5px;
}

.user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--primary-color);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.9rem;

}

.user-name {
    font-weight: 500;
    max-width: 120px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.dropdown-item {
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
}

.dropdown-item:hover,
.dropdown-item.active {
    background-color: var(--primary-color);
    color: white;
}

.dropdown-item i {
    width: 16px;
}

@media (max-width: 991.98px) {
    .search-container {
        margin: 1rem 0;
    }
    
    .search-input {
        width: 100%;
    }
    
    .search-input:focus {
        width: 100%;
    }
    
    .user-name {
        display: none;
    }
    
    .nav-icon {
        text-align: center;
    }
    
    .navbar-nav {
        text-align: center;
    }
    
    .dropdown-menu {
        text-align: left;
    }
}

/* Badge Animation */
.badge {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
    }
}

/* Hide badge when count is 0 */
.badge:empty,
.badge[data-count="0"] {
    display: none;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load cart and wishlist counts
    updateCartCount();
    updateWishlistCount();
    
    // Update counts every 30 seconds
    setInterval(function() {
        updateCartCount();
        updateWishlistCount();
    }, 30000);
});

function updateCartCount() {
    fetch('/cart/count')
        .then(response => response.json())
        .then(data => {
            const cartBadge = document.getElementById('cart-count');
            if (cartBadge) {
                cartBadge.textContent = data.count;
                cartBadge.setAttribute('data-count', data.count);
                if (data.count === 0) {
                    cartBadge.style.display = 'none';
                } else {
                    cartBadge.style.display = 'flex';
                }
            }
        })
        .catch(error => console.log('Error updating cart count:', error));
}

function updateWishlistCount() {
    fetch('/wishlist/count')
        .then(response => response.json())
        .then(data => {
            const wishlistBadge = document.getElementById('wishlist-count');
            if (wishlistBadge) {
                wishlistBadge.textContent = data.count;
                wishlistBadge.setAttribute('data-count', data.count);
                if (data.count === 0) {
                    wishlistBadge.style.display = 'none';
                } else {
                    wishlistBadge.style.display = 'flex';
                }
            }
        })
        .catch(error => console.log('Error updating wishlist count:', error));
}

// Search functionality
document.getElementById('searchForm')?.addEventListener('submit', function(e) {
    const searchInput = this.querySelector('input[name="q"]');
    if (!searchInput.value.trim()) {
        e.preventDefault();
        searchInput.focus();
    }
});
</script>
