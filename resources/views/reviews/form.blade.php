<!-- Review Form Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Write a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reviewForm">
                    @csrf
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating *</label>
                        <div class="rating-input">
                            <div class="star-rating" id="starRating">
                                <i class="fas fa-star" data-rating="1"></i>
                                <i class="fas fa-star" data-rating="2"></i>
                                <i class="fas fa-star" data-rating="3"></i>
                                <i class="fas fa-star" data-rating="4"></i>
                                <i class="fas fa-star" data-rating="5"></i>
                            </div>
                            <input type="hidden" id="rating" name="rating" value="0">
                            <small class="text-muted">Click on stars to rate</small>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="reviewText" class="form-label">Your Review</label>
                        <textarea class="form-control" id="reviewText" name="review_text" rows="4" 
                                  placeholder="Share your thoughts about this book..."></textarea>
                        <small class="text-muted">Optional - Maximum 2000 characters</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitReview">Submit Review</button>
            </div>
        </div>
    </div>
</div>

<style>
.star-rating {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.star-rating i {
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s ease;
}

.star-rating i:hover,
.star-rating i.active {
    color: #ffc107;
}

.star-rating i:hover ~ i {
    color: #ddd;
}

.rating-input {
    text-align: center;
}

.review-item {
    border-bottom: 1px solid #eee;
    padding: 1.5rem 0;
}

.review-item:last-child {
    border-bottom: none;
}

.reviewer-info {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
}

.reviewer-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--primary-color);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-right: 1rem;
}

.reviewer-name {
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.review-date {
    font-size: 0.8rem;
    color: #666;
}

.review-rating {
    color: #ffc107;
    margin-bottom: 0.5rem;
}

.review-text {
    color: #333;
    line-height: 1.6;
}

.user-review-actions {
    margin-top: 1rem;
}

.btn-sm {
    padding: 0.25rem 0.75rem;
    font-size: 0.875rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const starRating = document.getElementById('starRating');
    const ratingInput = document.getElementById('rating');
    const stars = starRating.querySelectorAll('i');
    
    // Star rating functionality
    stars.forEach((star, index) => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);
            ratingInput.value = rating;
            
            // Update star display
            stars.forEach((s, i) => {
                if (i < rating) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });
        });
        
        star.addEventListener('mouseover', function() {
            const rating = parseInt(this.dataset.rating);
            
            stars.forEach((s, i) => {
                if (i < rating) {
                    s.style.color = '#ffc107';
                } else {
                    s.style.color = '#ddd';
                }
            });
        });
    });
    
    starRating.addEventListener('mouseleave', function() {
        const currentRating = parseInt(ratingInput.value);
        
        stars.forEach((s, i) => {
            if (i < currentRating) {
                s.style.color = '#ffc107';
            } else {
                s.style.color = '#ddd';
            }
        });
    });
});

function openReviewModal(bookId, existingReview = null) {
    const modal = new bootstrap.Modal(document.getElementById('reviewModal'));
    const form = document.getElementById('reviewForm');
    const submitBtn = document.getElementById('submitReview');
    const modalTitle = document.getElementById('reviewModalLabel');
    
    // Reset form
    form.reset();
    document.getElementById('rating').value = '0';
    document.querySelectorAll('.star-rating i').forEach(star => {
        star.classList.remove('active');
        star.style.color = '#ddd';
    });
    
    if (existingReview) {
        // Edit mode
        modalTitle.textContent = 'Edit Your Review';
        submitBtn.textContent = 'Update Review';
        
        // Fill form with existing data
        document.getElementById('rating').value = existingReview.rating;
        document.getElementById('reviewText').value = existingReview.review_text || '';
        
        // Update stars
        const stars = document.querySelectorAll('.star-rating i');
        stars.forEach((star, index) => {
            if (index < existingReview.rating) {
                star.classList.add('active');
                star.style.color = '#ffc107';
            }
        });
        
        submitBtn.onclick = () => updateReview(bookId, existingReview.id);
    } else {
        // Create mode
        modalTitle.textContent = 'Write a Review';
        submitBtn.textContent = 'Submit Review';
        submitBtn.onclick = () => submitReview(bookId);
    }
    
    modal.show();
}

function submitReview(bookId) {
    const rating = document.getElementById('rating').value;
    const reviewText = document.getElementById('reviewText').value;
    
    if (rating === '0') {
        alert('Please select a rating');
        return;
    }
    
    const formData = {
        rating: rating,
        review_text: reviewText
    };
    
    fetch(`/books/${bookId}/reviews`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('reviewModal')).hide();
            showMessage(data.message, 'success');
            loadReviews(bookId);
        } else {
            showMessage(data.message || 'Error submitting review', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('Error submitting review. Please try again.', 'error');
    });
}

function updateReview(bookId, reviewId) {
    const rating = document.getElementById('rating').value;
    const reviewText = document.getElementById('reviewText').value;
    
    if (rating === '0') {
        alert('Please select a rating');
        return;
    }
    
    const formData = {
        rating: rating,
        review_text: reviewText
    };
    
    fetch(`/books/${bookId}/reviews/${reviewId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('reviewModal')).hide();
            showMessage(data.message, 'success');
            loadReviews(bookId);
        } else {
            showMessage(data.message || 'Error updating review', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('Error updating review. Please try again.', 'error');
    });
}

function deleteReview(bookId, reviewId) {
    if (!confirm('Are you sure you want to delete your review?')) {
        return;
    }
    
    fetch(`/books/${bookId}/reviews/${reviewId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showMessage(data.message, 'success');
            loadReviews(bookId);
        } else {
            showMessage(data.message || 'Error deleting review', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('Error deleting review. Please try again.', 'error');
    });
}

function loadReviews(bookId) {
    fetch(`/books/${bookId}/reviews`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateReviewsDisplay(data.reviews, data.average_rating, data.total_reviews);
            }
        })
        .catch(error => {
            console.error('Error loading reviews:', error);
        });
}

function loadUserReview(bookId) {
    fetch(`/books/${bookId}/user-review`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateUserReviewSection(data.review, data.can_review, bookId);
            }
        })
        .catch(error => {
            console.error('Error loading user review:', error);
        });
}

function updateReviewsDisplay(reviews, averageRating, totalReviews) {
    // Update average rating display
    const avgRatingElement = document.getElementById('averageRating');
    if (avgRatingElement) {
        avgRatingElement.innerHTML = `
            <div class="rating-stars">
                ${generateStarRating(averageRating)}
            </div>
            <span class="rating-text">${averageRating.toFixed(1)} out of 5 (${totalReviews} reviews)</span>
        `;
    }
    
    // Update reviews list
    const reviewsList = document.getElementById('reviewsList');
    if (reviewsList) {
        if (reviews.data.length > 0) {
            reviewsList.innerHTML = reviews.data.map(review => `
                <div class="review-item">
                    <div class="reviewer-info">
                        <div class="reviewer-avatar">
                            ${review.user.name.charAt(0).toUpperCase()}
                        </div>
                        <div>
                            <div class="reviewer-name">${review.user.name}</div>
                            <div class="review-date">${new Date(review.created_at).toLocaleDateString()}</div>
                        </div>
                    </div>
                    <div class="review-rating">
                        ${generateStarRating(review.rating)}
                    </div>
                    ${review.review_text ? `<div class="review-text">${review.review_text}</div>` : ''}
                </div>
            `).join('');
        } else {
            reviewsList.innerHTML = '<p class="text-muted text-center">No reviews yet. Be the first to review this book!</p>';
        }
    }
}

function updateUserReviewSection(userReview, canReview, bookId) {
    const userReviewSection = document.getElementById('userReviewSection');
    if (!userReviewSection) return;
    
    if (userReview) {
        userReviewSection.innerHTML = `
            <div class="alert alert-info">
                <h6>Your Review</h6>
                <div class="review-rating mb-2">
                    ${generateStarRating(userReview.rating)}
                </div>
                ${userReview.review_text ? `<p class="mb-2">${userReview.review_text}</p>` : ''}
                <div class="user-review-actions">
                    <button class="btn btn-outline-primary btn-sm" onclick="openReviewModal(${bookId}, ${JSON.stringify(userReview).replace(/"/g, '&quot;')})">
                        <i class="fas fa-edit me-1"></i>Edit Review
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="deleteReview(${bookId}, ${userReview.id})">
                        <i class="fas fa-trash me-1"></i>Delete Review
                    </button>
                </div>
            </div>
        `;
    } else if (canReview) {
        userReviewSection.innerHTML = `
            <button class="btn btn-primary" onclick="openReviewModal(${bookId})">
                <i class="fas fa-star me-2"></i>Write a Review
            </button>
        `;
    } else {
        userReviewSection.innerHTML = `
            <p class="text-muted">
                <i class="fas fa-info-circle me-1"></i>
                You need to purchase this book to write a review.
            </p>
        `;
    }
}

function generateStarRating(rating) {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        if (i <= rating) {
            stars += '<i class="fas fa-star"></i>';
        } else if (i - 0.5 <= rating) {
            stars += '<i class="fas fa-star-half-alt"></i>';
        } else {
            stars += '<i class="far fa-star"></i>';
        }
    }
    return stars;
}

function showMessage(message, type) {
    // Create and show a toast or alert message
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    // Find a container to show the message (you might need to adjust this)
    const messageContainer = document.getElementById('messageContainer') || document.body;
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = alertHtml;
    messageContainer.insertBefore(tempDiv.firstElementChild, messageContainer.firstChild);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        const alert = messageContainer.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 5000);
}
</script>
