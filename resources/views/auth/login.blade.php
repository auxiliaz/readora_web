<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readora - Login & Register</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #F2F1ED 0%, #FDDFC5 100%);
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            position: relative; overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute; top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><rect x="70" y="10" width="4" height="4" fill="rgba(255,255,255,0.1)"/><polygon points="10,70 15,60 20,70" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="3" fill="rgba(255,255,255,0.1)"/></svg>');
            animation: float 20s linear infinite;
            pointer-events: none;
        }
        
        @keyframes float {
            0% { transform: translateX(-50px) translateY(-50px) rotate(0deg); }
            100% { transform: translateX(50px) translateY(50px) rotate(360deg); }
        }

        .auth-container {
            width: 1000px; height: 550px;
            background: #F2F1ED; border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden; position: relative;
        }

        .red-panel {
            position: absolute; top: 0; right: 0;
            width: 50%; height: 100%;
            background: linear-gradient(180deg, #710014 0%, #64181c 100%);
            transition: all 0.6s cubic-bezier(0.68,-0.55,0.265,1.55);
            z-index: 10; display: flex;
            align-items: center; justify-content: center;
            flex-direction: column; color: white;
            text-align: left;
        }
        
        .register-mode .red-panel { right: 50%; }

        .red-panel::before {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 2px, transparent 2px),
                radial-gradient(circle at 80% 20%, rgba(49, 10, 10, 0.1) 1px, transparent 1px),
                radial-gradient(circle at 40% 40%, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px, 30px 30px, 70px 70px;
            opacity: 0.3;
        }

        .panel-content { z-index: 3; position: relative; padding: 40px; align-items: center;}
        .panel-content h2 { font-family: Playfair Display; font-size: 1.8rem; margin-bottom: 2px; font-weight: 700; }
        .panel-content p { font-size: 0.95rem; line-height: 1.6; margin-bottom: 2px; opacity: 0.9; }

        .panel-img {
            width: 330px; 
            height: auto;
            margin-bottom: 20px;
            border-radius: 12px;
            object-fit: cover;
            display: block;         
            margin: 0 auto 20px;    
        }

        .switch-btn {
            margin-top: 8px;
            background: transparent; border: 2px solid white; color: white;
            padding: 10px 0px; border: transparent; font-weight: 400; font-size: 0.90rem;
            cursor: pointer; transition: all 0.3s ease;
        }
        
        .switch-btn:hover { color: #FDDFC5; transform: translateY(-2px); }

        .form-container {
            position: absolute; top: 0;
            width: 50%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            padding: 60px 40px;
            transition: opacity 0.6s ease-in-out;
        }

        .login-container {
            left: 0; opacity: 1;
            z-index: 5; pointer-events: auto;
        }

        .register-container {
            right: 0; opacity: 0;
            z-index: 4; pointer-events: none;
        }

        .register-mode .login-container {
            opacity: 0; pointer-events: none;
        }
        
        .register-mode .register-container {
            opacity: 1; pointer-events: auto; z-index: 6;
        }

        .form-content { width: 100%; max-width: 320px; }

        .logo { display: flex; align-items: center; margin-bottom: 15px; }
        
        .logo span { 
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem; 
            font-weight: bold; 
            color: #710014; 
        }

        .welcome-text { margin-bottom: 2px; }
        .welcome-text h5 { font-size: 1.8rem; color: #333; font-weight: 600;}
        .welcome-text p { color: #666; font-size: 0.95rem; }

        .form-group { margin-bottom: 20px; position: relative; }
        .form-control {
            border: 2px solid #f8f9fa; border-radius: 10px;
            padding: 15px 20px; font-size: 1rem;
            transition: all 0.3s ease; background: #f8f9fa; width: 100%;
        }
        
        .form-control:focus {
            border-color: #710014;
            background: white; outline: none;
            box-shadow: 0 0 0 0.2rem rgba(113, 0, 20, 0.25);
        }

        .password-field { position: relative; }
        .password-toggle {
            position: absolute; right: 15px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none; color: #666; cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #710014 0%, #64181c 100%);
            border: none; border-radius: 10px; padding: 15px;
            font-weight: 600; font-size: 1rem; width: 100%; margin-top: 10px;
            transition: all 0.3s ease; color: white;
        }
        
        .btn-primary:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 8px 25px rgba(179, 143, 111, 0.3); 
        }

        .form-check { margin: 20px 0; }
        .form-check-input:checked { 
            background-color: #710014; 
            border-color: #64181c; 
        }
        
        .alert-danger {
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .alert-danger ul {
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .auth-container { 
                width: 95%; 
                height: auto; 
                min-height: 600px; 
                flex-direction: column; 
            }
            
            .red-panel { 
                position: relative; 
                width: 100%; 
                height: 200px; 
                right: 0 !important; 
            }
            
            .form-container { 
                position: relative; 
                width: 100%; 
                left: 0 !important; 
                right: 0 !important; 
            }
            
            .register-mode .login-container, 
            .register-mode .register-container {
                left: 0 !important; 
                right: 0 !important;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container" id="authContainer">
        <div class="red-panel">
            <div class="panel-content py-5">
                <img src="assets/readingmaskot2.svg" alt="Welcome Image" class="panel-img" id="panelImage">
                <h2 id="panelTitle">Halo, Readorans!</h2>
                <p id="panelText">Jika Anda belum memiliki akun, silakan registrasi.</p>
                <button class="switch-btn" onclick="toggleMode()">
                    <span id="switchBtnText">Register ></span>
                </button>
            </div>
        </div>

        <!-- Login Form -->
        <div class="form-container login-container">
            <div class="form-content">
                <div class="welcome-text">
                    <h1 style="font-family: 'Playfair Display'; color: #710014;">Login</h1>
                    <p>Login dengan mengisi data di bawah</p>
                </div>
                
                @if ($errors->any() && session('form_type') !== 'register')
                    <div class="toast-notification toast-error show">
                        <div class="toast-content">
                            <i class="fas fa-exclamation-circle"></i>
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
                        }, 5000);
                    </script>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
                    </div>
                    
                    <div class="form-group password-field">
                        <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('loginPassword')">
                            <i class="fas fa-eye" id="loginPasswordIcon"></i>
                        </button>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>

        <!-- Register Form -->
        <div class="form-container register-container">
            <div class="form-content">
                <div class="welcome-text">
                    <h1 style="font-family: 'Playfair Display'; color: #710014;">Buat Akun</h1>
                    <p>Registrasi dengan mengisi data di bawah</p>
                </div>
                
                @if ($errors->any() && session('form_type') === 'register')
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
                    </div>
                    
                    <div class="form-group password-field">
                        <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Password" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('registerPassword')">
                            <i class="fas fa-eye" id="registerPasswordIcon"></i>
                        </button>
                    </div>
                    
                    <div class="form-group password-field">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye" id="password_confirmationIcon"></i>
                        </button>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let isRegisterMode = false;
        
        // Check if there were validation errors for register form to set the correct mode
        @if($errors->any() && session('form_type') === 'register')
            isRegisterMode = true;
            document.addEventListener('DOMContentLoaded', function() {
                toggleMode();
            });
        @endif

        function toggleMode() {
            const authContainer = document.getElementById('authContainer');
            const panelTitle = document.getElementById('panelTitle');
            const panelText = document.getElementById('panelText');
            const switchBtnText = document.getElementById('switchBtnText');
            const panelImage = document.getElementById('panelImage');

            isRegisterMode = !isRegisterMode;
            if (isRegisterMode) {
                authContainer.classList.add('register-mode');
                panelTitle.textContent = 'Selamat Datang di Readora!';
                panelText.textContent = 'Silakan isi data Anda untuk membuat akun.';
                switchBtnText.textContent = '< Login';
                // Change image for register mode if needed
                if (panelImage) panelImage.src = "assets/readingmaskot.svg";
            } else {
                authContainer.classList.remove('register-mode');
                panelTitle.textContent = 'Halo, Readorans!';
                panelText.textContent = 'Jika Anda belum memiliki akun, silakan registrasi.';
                switchBtnText.textContent = 'Register >';
                // Change image for login mode if needed
                if (panelImage) panelImage.src = "assets/readingmaskot2.svg";
            }
        }

        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + 'Icon');
            if (field.type === 'password') {
                field.type = 'text'; 
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = 'password'; 
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
    
    <script>
        // Function to hide notifications
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
</body>
</html>