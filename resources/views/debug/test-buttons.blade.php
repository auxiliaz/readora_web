<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test Cart & Wishlist - Readora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Test Cart & Wishlist Functionality</h2>
        
        @auth
            <div class="alert alert-success">
                ✅ User logged in: {{ Auth::user()->name }} (ID: {{ Auth::user()->id }})
            </div>
            
            @if($books->count() > 0)
                <div class="alert alert-info">
                    📚 Found {{ $books->count() }} books in database
                </div>
                
                <div class="row">
                    @foreach($books->take(3) as $book)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <p class="card-text">{{ $book->author }}</p>
                                    <p class="card-text"><strong>Rp {{ number_format($book->price, 0, ',', '.') }}</strong></p>
                                    
                                    <button class="btn btn-primary btn-sm" onclick="testAddToCart({{ $book->id }})">
                                        Test Add to Cart
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" onclick="testAddToWishlist({{ $book->id }})">
                                        Test Add to Wishlist
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-warning">
                    ⚠️ No books found in database. Run: php artisan db:seed
                </div>
            @endif
        @else
            <div class="alert alert-danger">
                ❌ User not logged in. Please <a href="/login">login</a> first.
            </div>
        @endauth
        
        <div class="mt-4">
            <h4>Debug Console:</h4>
            <div id="debug-console" class="bg-dark text-light p-3" style="height: 200px; overflow-y: scroll;">
                <div>Debug messages will appear here...</div>
            </div>
        </div>
    </div>

    <script>
        function log(message) {
            const console = document.getElementById('debug-console');
            const time = new Date().toLocaleTimeString();
            console.innerHTML += `<div>[${time}] ${message}</div>`;
            console.scrollTop = console.scrollHeight;
        }

        function testAddToCart(bookId) {
            log(`🛒 Testing add to cart for book ID: ${bookId}`);
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            log(`🔑 CSRF Token: ${csrfToken ? 'Found' : 'Missing'}`);
            
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    book_id: bookId,
                    quantity: 1
                })
            })
            .then(response => {
                log(`📡 Response status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                log(`✅ Cart response: ${JSON.stringify(data)}`);
                if (data.success) {
                    alert('✅ Successfully added to cart!');
                } else {
                    alert('❌ Failed to add to cart: ' + data.message);
                }
            })
            .catch(error => {
                log(`❌ Cart error: ${error.message}`);
                alert('❌ Error: ' + error.message);
            });
        }

        function testAddToWishlist(bookId) {
            log(`❤️ Testing add to wishlist for book ID: ${bookId}`);
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch('/wishlist/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    book_id: bookId
                })
            })
            .then(response => {
                log(`📡 Response status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                log(`✅ Wishlist response: ${JSON.stringify(data)}`);
                if (data.success) {
                    alert('✅ Successfully updated wishlist!');
                } else {
                    alert('❌ Failed to update wishlist: ' + data.message);
                }
            })
            .catch(error => {
                log(`❌ Wishlist error: ${error.message}`);
                alert('❌ Error: ' + error.message);
            });
        }

        // Test on page load
        document.addEventListener('DOMContentLoaded', function() {
            log('🚀 Page loaded, testing basic functionality...');
            
            // Test CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                log('✅ CSRF token found');
            } else {
                log('❌ CSRF token missing');
            }
            
            // Test if user is authenticated
            @auth
                log('✅ User authenticated: {{ Auth::user()->name }}');
            @else
                log('❌ User not authenticated');
            @endauth
        });
    </script>
</body>
</html>
