<!-- Error Display Component -->
@if ($errors->any())
    <div class="toast-notification toast-error show">
        <div class="toast-content">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Please correct the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button class="toast-close" onclick="hideNotification(this.parentElement)">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <script>
        setTimeout(() => {
            hideNotification(document.querySelector('.toast-notification'));
        }, 3000);
    </script>
@endif

@if (session('error'))
    <div class="toast-notification toast-error show">
        <div class="toast-content">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Error:</strong> {{ session('error') }}
        </div>
        <button class="toast-close" onclick="hideNotification(this.parentElement)">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <script>
        setTimeout(() => {
            hideNotification(document.querySelector('.toast-notification'));
        }, 3000);
    </script>
@endif

@if (session('success'))
    <div class="toast-notification toast-success show">
        <div class="toast-content">
            <i class="fas fa-check-circle"></i>
            <strong>Success:</strong> {{ session('success') }}
        </div>
        <button class="toast-close" onclick="hideNotification(this.parentElement)">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <script>
        setTimeout(() => {
            hideNotification(document.querySelector('.toast-notification'));
        }, 5000);
    </script>
@endif

@if (session('warning'))
    <div class="toast-notification toast-warning show">
        <div class="toast-content">
            <i class="fas fa-exclamation-circle"></i>
            <strong>Warning:</strong> {{ session('warning') }}
        </div>
        <button class="toast-close" onclick="hideNotification(this.parentElement)">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <script>
        setTimeout(() => {
            hideNotification(document.querySelector('.toast-notification'));
        }, 5000);
    </script>
@endif

@if (session('info'))
    <div class="toast-notification toast-info show">
        <div class="toast-content">
            <i class="fas fa-info-circle"></i>
            <strong>Info:</strong> {{ session('info') }}
        </div>
        <button class="toast-close" onclick="hideNotification(this.parentElement)">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <script>
        setTimeout(() => {
            hideNotification(document.querySelector('.toast-notification'));
        }, 5000);
    </script>
@endif

<style>
.toast-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    max-width: 350px;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    animation: slideIn 0.3s ease-out;
}

.toast-notification.toast-error {
    background: linear-gradient(135deg, #f8d7da, #f1aeb5);
    border-left: 4px solid #dc3545;
    color: #721c24;
}

.toast-notification.toast-success {
    background: linear-gradient(135deg, #d1e7dd, #a3cfbb);
    border-left: 4px solid #198754;
    color: #0f5132;
}

.toast-notification.toast-warning {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    border-left: 4px solid #ffc107;
    color: #664d03;
}

.toast-notification.toast-info {
    background: linear-gradient(135deg, #d1ecf1, #a2d2ff);
    border-left: 4px solid #0dcaf0;
    color: #055160;
}

.toast-notification .toast-content {
    display: flex;
    align-items: flex-start;
    flex: 1;
}

.toast-notification i {
    margin-right: 10px;
    font-size: 1.1rem;
}

.toast-notification ul {
    padding-left: 1.2rem;
    margin-bottom: 0;
}

.toast-notification li {
    margin-bottom: 0.25rem;
}

.toast-close {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    opacity: 0.7;
    transition: opacity 0.2s;
    padding: 0;
    margin-left: 10px;
}

.toast-close:hover {
    opacity: 1;
}

/* Animation */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.toast-notification.hide {
    animation: fadeOut 0.3s forwards;
}

@keyframes fadeOut {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-20px);
    }
}
</style>

<!-- Function to hide notifications -->
<script>
    function hideNotification(notification) {
        if (notification) {
            notification.classList.add('hide');
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 300);
        }
    }
</script>
