// Book Actions JavaScript
// Handles cart, wishlist, and notification functionality

// Close notification function
function closeNotification(notification) {
    if (notification && notification.parentElement) {
        notification.classList.remove('show');
        notification.classList.add('hide');
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 300); // Wait for hide animation to complete
    }
}

// Notification system
function showNotification(message, type = 'success') {
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
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
        </div>
        <button class="toast-close" onclick="closeNotification(this.parentElement)">
            <i class="fas fa-times"></i>
        </button>
    `;

    // Add to page
    document.body.appendChild(notification);

    // Trigger fade in animation
    setTimeout(() => {
        notification.classList.add('show');
    }, 50);

    // Auto remove after 3 seconds with fade out animation
    setTimeout(() => {
        closeNotification(notification);
    }, 3000);
}

// Add to cart function
function addToCart(bookId) {
    // Check if user is authenticated
    if (!document.querySelector('meta[name="csrf-token"]')) {
        showNotification('Please login to add items to cart', 'error');
        return;
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
    });
}

// Add to wishlist function
function addToWishlist(bookId) {
    // Check if user is authenticated
    if (!document.querySelector('meta[name="csrf-token"]')) {
        showNotification('Please login to add items to wishlist', 'error');
        return;
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
    });
}

// Toggle wishlist function
function toggleWishlist(bookId) {
    // Check if user is authenticated
    if (!document.querySelector('meta[name="csrf-token"]')) {
        showNotification('Please login to manage wishlist', 'error');
        return;
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
            
            // Update button icon if it exists
            const button = document.querySelector(`[onclick="toggleWishlist(${bookId})"]`);
            if (button) {
                const icon = button.querySelector('i');
                if (data.in_wishlist) {
                    icon.className = 'fas fa-heart';
                    button.title = 'Remove from Wishlist';
                } else {
                    icon.className = 'far fa-heart';
                    button.title = 'Add to Wishlist';
                }
            }
        } else {
            showNotification(data.message || 'Error updating wishlist', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error updating wishlist. Please try again.', 'error');
    });
}

// Update cart count in navbar
function updateCartCount() {
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
}

// Update wishlist count in navbar
function updateWishlistCount() {
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
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Load cart and wishlist counts if user is authenticated
    if (document.querySelector('meta[name="csrf-token"]')) {
        updateCartCount();
        updateWishlistCount();
    }
});
