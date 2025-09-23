<style>
    :root {
        --primary-color: #710014;
    }

    .footer {
        background-color: var(--primary-color);
        color: white;
        padding: 20px 0 20px 0;
    }

    .footer-logo {
        font-family: 'Poppins';
        font-size: 2.5rem;
        font-weight: bold;
        font-style: italic;
        color: white;
        text-decoration: none;
    }

    .footer-nav {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        gap: 30px;
    }

    .footer-nav li {
        margin: 0;
    }

    .footer-nav a {
        color: white;
        text-decoration: none;
        font-size: 1rem;
        transition: opacity 0.3s ease;
    }

    .footer-nav a:hover {
        opacity: 0.8;
        color: white;
    }

    .footer-email {
        color: white;
        text-decoration: none;
        font-size: 1rem;
    }

    .footer-bottom {
        border-top: 1px solid white;
        margin-top: 10px;
        padding-top: 20px;
    }

    .social-icons {
        display: flex;
        gap: 15px;
    }

    .social-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .social-icon:hover {
        transform: scale(1.05);
    }

    .social-icon i {
        color: var(--primary-color);
        font-size: 1.2rem;
    }

    .copyright-text {
        color: white;
        margin: 0;
        font-size: 0.95rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .footer-nav {
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }

        .footer-logo {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }

        .footer-email {
            text-align: center;
            display: block;
            margin-top: 20px;
        }

        .footer-bottom {
            text-align: center;
        }

        .social-icons {
            justify-content: center;
            margin-top: 15px;
        }
    }
</style>
</head>
<!-- Footer -->
<footer class="footer">
    <div class="container">
        <!-- Top section -->
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-md-4">
                <img src="{{ asset('assets/logo_whitev.svg') }}" alt="Readora Logo" style="width: 150px; height: auto;">
            </div>

            <!-- Navigation -->
            <div class="col-md-4">
                <nav>
                    <ul class="footer-nav justify-content-center">
                        <li><a href="/">Beranda</a></li>
                        <li><a href="/categories">Kategori</a></li>
                        <li><a href="/library">Perpustakaan</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Email -->
            <div class="col-md-4 text-end">
                <a href="mailto:readoraid@gmail.com" class="footer-email">readoraid@gmail.com</a>
            </div>
        </div>

        <!-- Bottom section -->
        <div class="footer-bottom">
            <div class="row align-items-center">
                <!-- Social Media Icons -->
                <div class="col-md-6">
                    <div class="social-icons">
                        <a href="#" class="social-icon">
                            <img src="{{ asset('assets/whatsapp.svg') }}" alt="WhatsApp">
                        </a>
                        <a href="#" class="social-icon">
                            <img src="{{ asset('assets/instagram.svg') }}" alt="Instagram">
                        </a>
                        <a href="#" class="social-icon">
                            <img src="{{ asset('assets/facebook.svg') }}" alt="Facebook">
                        </a>
                    </div>
                </div>

                <div class="col-md-6 text-end">
                    <p class="copyright-text">&copy; 2025 Readora Store. All rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>

</html>