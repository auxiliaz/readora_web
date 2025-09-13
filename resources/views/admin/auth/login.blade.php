<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Readora</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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

        .login-container {
            width: 400px;
            background: #F2F1ED; 
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden; 
            position: relative;
            padding: 40px;
        }

        .admin-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #710014;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .logo { 
            display: flex; 
            align-items: center; 
            justify-content: center;
            margin-bottom: 25px; 
        }
        
        .logo span { 
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem; 
            font-weight: bold; 
            color: #710014; 
        }

        .welcome-text { 
            margin-bottom: 30px; 
            text-align: center;
        }
        
        .welcome-text h1 { 
            font-family: 'Playfair Display', serif;
            font-size: 2rem; 
            color: #710014; 
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .welcome-text p { 
            color: #666; 
            font-size: 0.95rem; 
        }

        .form-group { 
            margin-bottom: 20px; 
            position: relative; 
        }
        
        .form-control {
            border: 2px solid #f8f9fa; 
            border-radius: 10px;
            padding: 15px 20px; 
            font-size: 1rem;
            transition: all 0.3s ease; 
            background: #f8f9fa; 
            width: 100%;
        }
        
        .form-control:focus {
            border-color: #710014;
            background: white; 
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(113, 0, 20, 0.25);
        }

        .password-field { 
            position: relative; 
        }
        
        .password-toggle {
            position: absolute; 
            right: 15px; 
            top: 50%;
            transform: translateY(-50%);
            background: none; 
            border: none; 
            color: #666; 
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #710014 0%, #64181c 100%);
            border: none; 
            border-radius: 10px; 
            padding: 15px;
            font-weight: 600; 
            font-size: 1rem; 
            width: 100%; 
            margin-top: 10px;
            transition: all 0.3s ease; 
            color: white;
        }
        
        .btn-primary:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 8px 25px rgba(179, 143, 111, 0.3); 
        }

        .form-check { 
            margin: 20px 0; 
        }
        
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

        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: #710014;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .back-link a:hover {
            color: #64181c;
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                width: 90%;
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="welcome-text">
            <h1>Admin Login</h1>
            <p>Login untuk mengakses halaman admin</p>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
            </div>
            
            <div class="form-group password-field">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                    <i class="fas fa-eye" id="passwordIcon"></i>
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
        
        <div class="back-link">
            <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back to Website</a>
        </div>
    </div>

    <script>
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
</body>
</html>