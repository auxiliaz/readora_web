@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Greeting Box with Illustration -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card greeting-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="greeting-title">Selamat Datang, {{ Auth::guard('admin')->user()->name }}!</h1>
                            <p class="greeting-subtitle">{{ now()->format('l, d F Y') }}</p>
                        </div>
                        <div class="col-lg-4 d-none d-lg-block text-center">
                            <img src="assets/admin.svg"
                                alt="Admin Dashboard" class="greeting-illustration">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Content -->

    <div class="row">
        <!-- Stat Boxes (stacked vertically) -->
        <div class="col-lg-4 mb-4">
            <div class="card dashboard-card stat-box">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stat-icon me-3">
                            <i class="bi bi-book" style="color: #710014"></></i>
                        </div>
                        <h6 class="mb-0">Total Buku</h6>
                    </div>
                    <h3 class="mb-0">{{ $totalBooks }}</h3>
                    <small class="text-muted">Dalam katalog</small>
                </div>
            </div>
            <div class="card dashboard-card stat-box">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stat-icon me-3">
                            <i class="bi bi-tags" style="color: #710014"></i>
                        </div>
                        <h6 class="mb-0">Kategori Buku</h6>
                    </div>
                    <h3 class="mb-0">{{ $totalCategories }}</h3>
                    <small class="text-muted">Tersedia</small>
                </div>
            </div>
            <div class="card dashboard-card stat-box">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stat-icon me-3">
                            <i class="bi bi-cart-check" style="color: #710014"></></i>
                        </div>
                        <h6 class="mb-0">Buku Terjual</h6>
                    </div>
                    <h3 class="mb-0">{{ $booksSoldThisMonth }}</h3>
                    <small class="text-muted">Bulan ini</small>
                </div>
            </div>
        </div>

        <!-- Todo List Widget -->
        <div class="col-lg-8 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-list-check me-2" style="color: #710014;"></i>To-Do List</h5>
                    <button class="cta-button btn-sm" onclick="addTodo()">
                        <i class="bi bi-plus"></i> Tambah
                    </button>
                </div>
                <div class="card-body p-4" style="min-height: 450px;">
                    <div id="todoContainer">
                        <div class="mb-3">
                            <div class="input-group" id="addTodoForm" style="display: none;">
                                <input type="text" class="form-control" id="todoInput" placeholder="Masukkan tugas baru..."
                                    maxlength="100">
                                <button class="cta-button btn-xs" onclick="saveTodo()">
                                    <i class="bi bi-check"></i>
                                </button>
                                <button class="btn-outline-danger btn-xs" onclick="cancelTodo()">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                        <div id="todoList"></div>
                        <div id="emptyTodoState" class="text-center py-4">
                            <div class="empty-state">
                                <i class="bi bi-clipboard-check"></i>
                                <p>Belum ada tugas. Klik "Tambah" untuk menambahkan tugas baru.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <!-- Category Distribution -->
        <div class="col-lg-6 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-pie-chart-fill me-2" style="color: #710014;"></i>Distribusi Kategori</h5>
                    <a href="{{ route('admin.categories.index') }}" class="cta-button btn-sm">Lihat Semua</a>
                </div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center">
                    <canvas id="categoryChart" height="150"></canvas>
                </div>
            </div>
        </div>

        <!-- Top Selling Books -->
        <div class="col-lg-6 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-award me-2" style="color: #710014;"></i>Buku Terlaris</h5>
                    <a href="{{ route('admin.books.index') }}" class="cta-button btn-sm">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="top-books-container">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mb-0">
                                <thead class="sticky-top bg-white">
                                    <tr>
                                        <th class="px-4 py-3">Buku</th>
                                        <th class="text-end px-4 py-3">Penjualan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($topBooks as $book)
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="book-icon me-3">
                                                        <i class="bi bi-book"></i>
                                                    </div>
                                                    <div>
                                                        <strong>{{ $book->title }}</strong><br>
                                                        <small class="text-muted">oleh {{ $book->author ? $book->author->nama : 'Unknown Author' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end px-4 py-3">
                                                <span class="badge rounded-pill" style="color: #fff; background-color: #710014;">{{ $book->sales_count }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class="bi bi-bar-chart-line"></i>
                                                    <p>Belum ada data penjualan</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Greeting Card Styles */
        .greeting-card {
            border: none;
            background: var(--primary-color);
            color: white;
            overflow: hidden;
            position: relative;
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.15);
        }

        .greeting-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }


        .greeting-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 1rem;
        }

        .greeting-text {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-bottom: 1.5rem;
            max-width: 90%;
        }

        .greeting-stat {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .greeting-illustration {
            max-width: 100%;
            height: auto;
            max-height: 210px;
        }

        /* Dashboard Cards */
        .dashboard-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .dashboard-card .card-header {
            background-color: white;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .dashboard-card .card-header h5 {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--text-color);
        }


        /* Book Icon */
        .book-icon {
            width: 36px;
            height: 36px;
            background-color: rgba(79, 70, 229, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .book-icon i {
            font-size: 1.2rem;
        }


        .stat-box {
            margin-bottom: 0.8rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .stat-box .card-body {
            padding: 1.75rem 1.5rem;
        }

        .stat-box:hover {
            transform: translateY(-5px);
        }

        .stat-box h3 {
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--text-color);
            margin: 0.5rem 0;
            font-family: 'Poppins', sans-serif;
        }

        .stat-box h6 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .stat-box small {
            font-size: 0.9rem;
            opacity: 0.7;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background-color: #F2F1ED;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon i {
            font-size: 1.6rem;
        }

        .col-lg-6 .row>.col-md-4 {
            margin-bottom: 1rem !important;
        }

        /* Todo List Styles */
        .todo-item {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            background-color: white;
            transition: all 0.2s ease;
        }

        .todo-item:hover {
            background-color: #f9fafb;
            border-color: var(--primary-color);
        }

        .todo-item.completed {
            background-color: #F2F1ED;
        }

        .todo-item.completed .todo-text {
            text-decoration: line-through;
            color: #6b7280;
        }

        .todo-checkbox {
            width: 18px;
            height: 18px;
            margin-right: 0.75rem;
            cursor: pointer;
            background-color: #710014;
        }

        .todo-text {
            flex: 1;
            font-size: 0.95rem;
            color: var(--text-color);
        }

        .todo-actions {
            display: flex;
            gap: 0.25rem;
        }

        .todo-actions .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }

        #addTodoForm .form-control {
            border-radius: 8px 0 0 8px;
            border-right: none;
        }

        #addTodoForm .cta-button {
            border-radius: 0;
            padding: 12px 16px;
        }

        #addTodoForm .btn-outline-danger {
            border-radius: 0 8px 8px 0;
            padding: 12px 16px;
        }

        #todoContainer {
            height: 100%;
        }

        /* Book Icon */
        .book-icon {
            width: 36px;
            height: 36px;
            background-color: #F2F1ED;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .book-icon i {
            font-size: 1.2rem;
            color: #710014;
        }

        /* Top Books Container */
        .top-books-container {
            max-height: 400px;
            overflow-y: auto;
        }

        .top-books-container::-webkit-scrollbar {
            width: 6px;
        }

        .top-books-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .top-books-container::-webkit-scrollbar-thumb {
            background: #710014;
            border-radius: 3px;
        }

        .top-books-container::-webkit-scrollbar-thumb:hover {
            background: #5a0010;
        }

        /* Ensure equal height for both cards */
        .row .col-lg-6 .dashboard-card {
            min-height: 500px;
        }

        /* Sticky header for top books table */
        .top-books-container .sticky-top {
            z-index: 10;
            border-bottom: 1px solid #dee2e6;
        }

        /* CTA Button Styling - Same as Home Page */
        .cta-button {
            background: var(--primary-color);
            color: white;
            padding: 14px 32px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .cta-button:hover {
            background: #5a0010;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .cta-button.btn-sm {
            padding: 8px 20px;
            font-size: 0.875rem;
        }

        .cta-button.btn-xs {
            padding: 6px 16px;
            font-size: 0.75rem;
        }

        /* Override existing button styles */
        .btn-primary {
            background: var(--primary-color);
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .btn-primary:hover {
            background: #5a0010;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-outline-danger {
            background: transparent;
            color: #dc3545;
            padding: 6px 12px;
            border: 1px solid #dc3545;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 3px;
        }

        .btn-outline-danger:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Todo List Management
        let todos = JSON.parse(localStorage.getItem('adminTodos')) || [];

        // Initialize todo list on page load
        document.addEventListener('DOMContentLoaded', function () {
            loadTodos();
        });

        function addTodo() {
            document.getElementById('addTodoForm').style.display = 'flex';
            document.getElementById('todoInput').focus();
        }

        function cancelTodo() {
            document.getElementById('addTodoForm').style.display = 'none';
            document.getElementById('todoInput').value = '';
        }

        function saveTodo() {
            const input = document.getElementById('todoInput');
            const text = input.value.trim();

            if (text === '') {
                alert('Mohon masukkan tugas yang valid');
                return;
            }

            const todo = {
                id: Date.now(),
                text: text,
                completed: false,
                createdAt: new Date().toISOString()
            };

            todos.unshift(todo);
            localStorage.setItem('adminTodos', JSON.stringify(todos));

            input.value = '';
            cancelTodo();
            loadTodos();
        }

        function toggleTodo(id) {
            todos = todos.map(todo => {
                if (todo.id === id) {
                    todo.completed = !todo.completed;
                }
                return todo;
            });
            localStorage.setItem('adminTodos', JSON.stringify(todos));
            loadTodos();
        }

        function deleteTodo(id) {
            if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                todos = todos.filter(todo => todo.id !== id);
                localStorage.setItem('adminTodos', JSON.stringify(todos));
                loadTodos();
            }
        }

        function loadTodos() {
            const todoList = document.getElementById('todoList');
            const emptyState = document.getElementById('emptyTodoState');

            if (todos.length === 0) {
                todoList.innerHTML = '';
                emptyState.style.display = 'block';
                return;
            }

            emptyState.style.display = 'none';

            todoList.innerHTML = todos.map(todo => `
                                    <div class="todo-item ${todo.completed ? 'completed' : ''}">
                                        <input type="checkbox" class="todo-checkbox" 
                                               ${todo.completed ? 'checked' : ''} 
                                               onchange="toggleTodo(${todo.id})">
                                        <span class="todo-text">${escapeHtml(todo.text)}</span>
                                        <div class="todo-actions">
                                            <button class="btn-outline-danger btn-xs" onclick="deleteTodo(${todo.id})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                `).join('');
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Handle Enter key in todo input
        document.addEventListener('keydown', function (e) {
            if (e.target.id === 'todoInput' && e.key === 'Enter') {
                saveTodo();
            }
            if (e.target.id === 'todoInput' && e.key === 'Escape') {
                cancelTodo();
            }
        });

        // Category Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryData = @json($categoryStats);

        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: categoryData.map(item => item.name),
                datasets: [{
                    data: categoryData.map(item => item.books_count),
                    backgroundColor: [
                        '#710014',
                        '#B38F6F',
                        '#10B981',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endpush