// Standardized Notification System for Readora
// This file provides consistent notification functionality across all pages

// Global notification function
window.showNotification = function (message, type = 'success') {
    // Remove existing notifications with fade out animation
    const existingNotifications = document.querySelectorAll('.toast-notification');
    existingNotifications.forEach(notification => {
        notification.classList.add('hide');
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 300);
    });

    // Create notification element
    const notification = document.createElement('div');
    notification.className = `toast-notification toast-${type}`;
    notification.innerHTML = `
        <div class="toast-content">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'}"></i>
            <span>${message}</span>
        </div>
        <button class="toast-close" onclick="hideNotification(this.parentElement)">
            <i class="fas fa-times"></i>
        </button>
    `;

    // Add to page
    document.body.appendChild(notification);

    // Trigger fade in animation
    setTimeout(() => {
        notification.classList.add('show');
    }, 50);

    // Auto remove after 4 seconds with fade out animation
    setTimeout(() => {
        hideNotification(notification);
    }, 4000);
};

// Hide notification with animation
window.hideNotification = function (notification) {
    if (notification && notification.parentElement) {
        notification.classList.remove('show');
        notification.classList.add('hide');
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 300);
    }
};

// Alias for backward compatibility
window.showMessage = window.showNotification;

// Update cart count function
window.updateCartCount = function () {
    fetch('/cart/count')
        .then(response => response.json())
        .then(data => {
            const cartBadge = document.querySelector('#cart-count');
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
};

// Update wishlist count function
window.updateWishlistCount = function () {
    fetch('/wishlist/count')
        .then(response => response.json())
        .then(data => {
            const wishlistBadge = document.querySelector('#wishlist-count');
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
};

// Global add to cart function
window.addToCart = function (bookId) {
    console.log('Adding to cart:', bookId);

    if (!document.querySelector('meta[name="csrf-token"]')) {
        showNotification('Please login to add items to cart', 'error');
        return;
    }

    const button = document.querySelector(`[onclick="addToCart(${bookId})"]`);
    const originalText = button ? button.innerHTML : '';

    // Show loading state
    if (button) {
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>Adding...';
    }

    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            book_id: bookId,
            quantity: 1
        })
    })
        .then(response => response.json())
        .then(data => {
            console.log('Cart response:', data);
            if (data.success) {
                showNotification(data.message, 'success');
                updateCartCount();
            } else {
                showNotification(data.message || 'Error adding to cart', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error adding to cart. Please try again.', 'error');
        })
        .finally(() => {
            if (button) {
                button.disabled = false;
                button.innerHTML = originalText;
            }
        });
};

// Global add to wishlist function
window.addToWishlist = function (bookId) {
    console.log('Adding to wishlist:', bookId);

    if (!document.querySelector('meta[name="csrf-token"]')) {
        showNotification('Please login to add items to wishlist', 'error');
        return;
    }

    const button = document.querySelector(`[onclick="addToWishlist(${bookId})"]`);
    const originalText = button ? button.innerHTML : '';

    // Show loading state
    if (button) {
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>Adding...';
    }

    fetch('/wishlist/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            book_id: bookId
        })
    })
        .then(response => response.json())
        .then(data => {
            console.log('Wishlist response:', data);
            if (data.success) {
                showNotification(data.message, 'success');
                updateWishlistCount();
            } else {
                showNotification(data.message || 'Error adding to wishlist', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error adding to wishlist. Please try again.', 'error');
        })
        .finally(() => {
            if (button) {
                button.disabled = false;
                button.innerHTML = originalText;
            }
        });
};

// Global toggle wishlist function
window.toggleWishlist = function (bookId) {
    if (!document.querySelector('meta[name="csrf-token"]')) {
        showNotification('Please login to manage wishlist', 'error');
        return;
    }

    const button = document.querySelector(`[onclick="toggleWishlist(${bookId})"]`);
    const originalText = button ? button.innerHTML : '';

    if (button) {
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>Loading...';
    }

    fetch('/wishlist/toggle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            book_id: bookId
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                updateWishlistCount();

                // Update button text and icon
                if (button) {
                    if (data.in_wishlist) {
                        button.innerHTML = '<i class="fas fa-heart"></i>Remove from Wishlist';
                    } else {
                        button.innerHTML = '<i class="fas fa-heart"></i>Add to Wishlist';
                    }
                }
            } else {
                showNotification(data.message || 'Error updating wishlist', 'error');
                if (button) {
                    button.innerHTML = originalText;
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error updating wishlist. Please try again.', 'error');
            if (button) {
                button.innerHTML = originalText;
            }
        })
        .finally(() => {
            if (button) {
                button.disabled = false;
            }
        });
};

// Initialize on page load
document.addEventListener('DOMContentLoaded', function () {
    console.log('Notifications system loaded');
    if (document.querySelector('meta[name="csrf-token"]')) {
        updateCartCount();
        updateWishlistCount();
    }
});
