// Book Actions JavaScript
// Handles cart, wishlist, PDF upload, and notification functionality

// Add CSS for PDF upload styling and notifications
document.addEventListener('DOMContentLoaded', function() {
    // Add CSS for PDF upload styling and notifications if not already present
    if (!document.getElementById('pdf-upload-styles')) {
        const style = document.createElement('style');
        style.id = 'pdf-upload-styles';
        style.innerHTML = `
            /* PDF Upload Styles */
            .pdf-drop-area {
                position: relative;
                padding: 15px;
                border: 2px dashed #ccc;
                border-radius: 5px;
                transition: all 0.3s ease;
            }
            
            .pdf-drop-area.highlight {
                border-color: #007bff;
                background-color: rgba(0, 123, 255, 0.05);
            }
            
            .pdf-drop-text {
                margin-top: 10px;
                color: #6c757d;
                text-align: center;
                font-style: italic;
            }
            
            .pdf-file-info {
                margin-top: 10px;
            }
            
            .pdf-preview-container {
                margin-top: 15px;
                padding: 10px;
                border: 1px solid #eee;
                border-radius: 5px;
                background-color: #f9f9f9;
            }
            
            /* Toast Notification Styles */
            .toast-notification {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: space-between;
                min-width: 300px;
                max-width: 450px;
                padding: 15px 20px;
                border-radius: 5px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                opacity: 0;
                transform: translateY(-20px);
                transition: all 0.3s ease;
            }
            
            .toast-notification.show {
                opacity: 1;
                transform: translateY(0);
            }
            
            .toast-notification.hide {
                opacity: 0;
                transform: translateY(-20px);
            }
            
            .toast-success {
                background-color: #d4edda;
                border-left: 5px solid #28a745;
                color: #155724;
            }
            
            .toast-error {
                background-color: #f8d7da;
                border-left: 5px solid #dc3545;
                color: #721c24;
            }
            
            .toast-info {
                background-color: #d1ecf1;
                border-left: 5px solid #17a2b8;
                color: #0c5460;
            }
            
            .toast-content {
                display: flex;
                align-items: center;
                flex: 1;
            }
            
            .toast-content i {
                margin-right: 10px;
                font-size: 1.2rem;
            }
            
            .toast-close {
                background: none;
                border: none;
                color: inherit;
                cursor: pointer;
                font-size: 1rem;
                opacity: 0.7;
                transition: opacity 0.2s;
            }
            
            .toast-close:hover {
                opacity: 1;
            }
        `;
        document.head.appendChild(style);
    }
    
    // Setup form submission validation for admin book forms
    setupBookFormValidation();
});

// Setup form validation for book forms
function setupBookFormValidation() {
    const bookForm = document.querySelector('form#bookForm');
    
    if (bookForm) {
        bookForm.addEventListener('submit', function(e) {
            // Check if this is a create form (has required PDF) or edit form
            const isCreateForm = bookForm.getAttribute('data-form-type') === 'create' || 
                                 window.location.href.includes('/admin/books/create');
            const pdfInput = document.getElementById('file_path');
            
            // For create form, PDF is required
            if (isCreateForm && pdfInput && (!pdfInput.files || pdfInput.files.length === 0)) {
                e.preventDefault();
                showNotification('Please select a PDF file for the book', 'error');
                pdfInput.focus();
                return false;
            }
            
            // If PDF is selected, validate it
            if (pdfInput && pdfInput.files && pdfInput.files.length > 0) {
                const file = pdfInput.files[0];
                const maxSize = 10 * 1024 * 1024; // 10MB
                
                if (file.type !== 'application/pdf') {
                    e.preventDefault();
                    showNotification('Invalid file type. Please select a PDF file', 'error');
                    return false;
                }
                
                if (file.size > maxSize) {
                    e.preventDefault();
                    showNotification('PDF file is too large. Maximum size is 10MB', 'error');
                    return false;
                }
            }
            
            // All validations passed
            return true;
        });
        
        // Add form type attribute for easier identification
        if (window.location.href.includes('/admin/books/create')) {
            bookForm.setAttribute('data-form-type', 'create');
        } else if (window.location.href.includes('/admin/books/') && window.location.href.includes('/edit')) {
            bookForm.setAttribute('data-form-type', 'edit');
        }
    }
}

// Hide notification function
function hideNotification(notification) {
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

    // Auto remove after 3 seconds with fade out animation
    setTimeout(() => {
        hideNotification(notification);
    }, 3000);
}

// PDF File Validation and Preview & Cover Image Preview
document.addEventListener('DOMContentLoaded', function() {
    const pdfFileInput = document.getElementById('file_path');
    const coverImageInput = document.getElementById('cover_image');
    
    if (pdfFileInput) {
        // Handle file selection
        pdfFileInput.addEventListener('change', function() {
            validatePdfFile(this);
        });
        
        // Setup drag and drop for PDF upload
        setupPdfDragAndDrop(pdfFileInput);
    }
    
    if (coverImageInput) {
        // Handle cover image selection
        coverImageInput.addEventListener('change', function() {
            previewCoverImage(this);
        });
    }
});

// Setup drag and drop functionality for PDF upload
function setupPdfDragAndDrop(fileInput) {
    const dropArea = fileInput.parentElement;
    
    // Add visual cues for drag and drop
    dropArea.classList.add('pdf-drop-area');
    const dropText = document.createElement('div');
    dropText.className = 'pdf-drop-text';
    dropText.innerHTML = 'or drag and drop PDF here';
    dropArea.appendChild(dropText);
    
    // Prevent default behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    // Highlight drop area when file is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight() {
        dropArea.classList.add('highlight');
    }
    
    function unhighlight() {
        dropArea.classList.remove('highlight');
    }
    
    // Handle dropped files
    dropArea.addEventListener('drop', handleDrop, false);
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length) {
            fileInput.files = files;
            validatePdfFile(fileInput);
        }
    }
}

// Validate PDF file size and type
function validatePdfFile(input) {
    const maxSize = 10 * 1024 * 1024; // 10MB in bytes
    const fileInfoElement = document.createElement('div');
    fileInfoElement.className = 'pdf-file-info mt-2';
    
    // Remove any existing file info and preview
    const existingInfo = input.parentElement.querySelector('.pdf-file-info');
    if (existingInfo) {
        existingInfo.remove();
    }
    
    const existingPreview = input.parentElement.querySelector('.pdf-preview-container');
    if (existingPreview) {
        existingPreview.remove();
    }
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Check file type
        if (file.type !== 'application/pdf') {
            fileInfoElement.innerHTML = `<div class="alert alert-danger">Invalid file type. Please select a PDF file.</div>`;
            input.value = ''; // Clear the input
        } 
        // Check file size
        else if (file.size > maxSize) {
            fileInfoElement.innerHTML = `<div class="alert alert-danger">File is too large. Maximum size is 10MB.</div>`;
            input.value = ''; // Clear the input
        } 
        // Valid file
        else {
            fileInfoElement.innerHTML = `
                <div class="alert alert-success">
                    <strong>File:</strong> ${file.name}<br>
                    <strong>Size:</strong> ${(file.size / (1024 * 1024)).toFixed(2)} MB
                </div>
            `;
            
            // Create PDF preview
            createPdfPreview(file, input.parentElement);
        }
        
        // Add file info after the input
        input.parentElement.appendChild(fileInfoElement);
    }
}

// Create PDF preview
function createPdfPreview(file, container) {
    const reader = new FileReader();
    
    reader.onload = function(e) {
        const previewContainer = document.createElement('div');
        previewContainer.className = 'pdf-preview-container mt-3';
        
        previewContainer.innerHTML = `
            <h5>PDF Preview</h5>
            <div class="pdf-preview">
                <iframe src="${e.target.result}" width="100%" height="300" style="border: 1px solid #ddd;"></iframe>
            </div>
            <div class="pdf-preview-actions mt-2">
                <button type="button" class="btn btn-sm btn-secondary" onclick="this.parentElement.parentElement.remove()">Hide Preview</button>
                <button type="button" class="btn btn-sm btn-danger ml-2" onclick="resetPdfUpload(this)">Reset</button>
            </div>
        `;
        
        container.appendChild(previewContainer);
    };
    
    reader.readAsDataURL(file);
}

// Create cover image preview
function previewCoverImage(input) {
    // Remove any existing preview
    const existingPreview = document.querySelector('.cover-image-preview-container');
    if (existingPreview) {
        existingPreview.remove();
    }
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Validate file type
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        if (!validImageTypes.includes(file.type)) {
            showNotification('Please select a valid image file (JPEG, PNG, GIF)', 'error');
            input.value = '';
            return;
        }
        
        // Validate file size (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
            showNotification('Image file is too large. Maximum size is 2MB', 'error');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const previewContainer = document.createElement('div');
            previewContainer.className = 'cover-image-preview-container mt-3';
            
            previewContainer.innerHTML = `
                <h5>Cover Image Preview</h5>
                <div class="cover-image-preview">
                    <img src="${e.target.result}" style="max-width: 100%; max-height: 300px; border: 1px solid #ddd;">
                </div>
                <div class="cover-image-preview-actions mt-2">
                    <button type="button" class="btn btn-sm btn-danger" onclick="resetCoverImage(this)">Reset</button>
                </div>
            `;
            
            // Insert after the cover_image input
            input.parentNode.appendChild(previewContainer);
        };
        
        reader.readAsDataURL(file);
    }
}

// Reset cover image
function resetCoverImage(button) {
    const coverImageInput = document.getElementById('cover_image');
    if (coverImageInput) {
        coverImageInput.value = '';
    }
    
    const previewContainer = button.closest('.cover-image-preview-container');
    if (previewContainer) {
        previewContainer.remove();
    }
    
    showNotification('Cover image has been reset', 'info');
}

// Reset PDF upload
function resetPdfUpload(button) {
    const container = button.closest('.pdf-drop-area');
    const fileInput = container.querySelector('input[type="file"]');
    
    // Clear file input
    fileInput.value = '';
    
    // Remove preview and file info
    const previewContainer = container.querySelector('.pdf-preview-container');
    if (previewContainer) {
        previewContainer.remove();
    }
    
    const fileInfo = container.querySelector('.pdf-file-info');
    if (fileInfo) {
        fileInfo.remove();
    }
    
    // Show reset message
    showNotification('PDF file selection has been reset', 'success');
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