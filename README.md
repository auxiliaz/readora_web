# 📚 Readora - Digital E-Book Store

A complete digital e-book store platform built with Laravel, featuring secure PDF reading, payment integration, and comprehensive user management.

## 🎯 Features

### Core Functionality
- ✅ **User Authentication** - Registration, login, and session management
- ✅ **Book Catalog** - Browse books by categories with advanced filtering
- ✅ **Shopping Cart & Wishlist** - Add books, manage quantities, save for later
- ✅ **Payment Integration** - Midtrans payment gateway with multiple payment methods
- ✅ **Digital Library** - Access purchased books with secure file serving
- ✅ **PDF Reader** - Built-in reader with notes, highlights, and navigation
- ✅ **Review System** - 5-star ratings and text reviews for purchased books
- ✅ **User Profile** - Account management, order history, and settings
- ✅ **Search System** - Advanced search with filters and auto-suggestions
- ✅ **Responsive Design** - Mobile-first approach with modern UI/UX

### Technical Features
- 🔐 **Security** - Secure file access, CSRF protection, input validation
- 📱 **Mobile Responsive** - Works seamlessly on all devices
- 🎨 **Design System** - Consistent styling with custom color palette
- ⚡ **Performance** - Optimized queries, caching, and asset management
- 🔍 **SEO Friendly** - Proper meta tags and URL structure

## 🛠️ Technology Stack

- **Backend**: Laravel 10.x (PHP 8.1+)
- **Frontend**: Blade Templates, Bootstrap 5, Custom CSS/JS
- **Database**: MySQL 8.0+
- **Payment**: Midtrans Payment Gateway
- **PDF Handling**: PDF.js for in-browser reading
- **File Storage**: Laravel's secure file system

## 🚀 Quick Start

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL 8.0+
- Node.js & NPM

### Installation

1. **Clone and Setup**
```bash
git clone <repository-url>
cd readora_web
composer install
npm install
```

2. **Environment Configuration**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Configure Database**
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=readora_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

4. **Configure Midtrans Payment**
```env
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
```

5. **Database Setup**
```bash
php artisan migrate
php artisan db:seed
```

6. **Storage Setup**
```bash
php artisan storage:link
mkdir storage/app/books
```

7. **Build Assets**
```bash
npm run build
```

8. **Start Development Server**
```bash
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## 📁 Project Structure

```
app/
├── Http/Controllers/    # Application controllers
├── Models/             # Eloquent models
├── Http/Requests/      # Form validation
└── Exceptions/         # Error handling

resources/
├── views/
│   ├── components/     # Reusable components
│   ├── auth/          # Authentication pages
│   ├── books/         # Book pages
│   ├── cart/          # Shopping cart
│   ├── library/       # User library
│   ├── profile/       # User profile
│   ├── reader/        # PDF reader
│   └── search/        # Search results
├── css/               # Stylesheets
└── js/                # JavaScript files

database/
├── migrations/        # Database schema
└── seeders/          # Sample data
```

## 🎨 Design System

### Color Palette
- **Primary**: #710014 (Deep Red)
- **Secondary**: #B38F6F (Warm Brown)
- **Background**: #F2F1ED (Light Cream)
- **Text**: #000000 (Black)

### Typography
- **Headings**: Playfair Display (serif)
- **Body Text**: Poppins (sans-serif)

## 🔐 Security Features

- **Authentication**: Laravel Sanctum session management
- **Authorization**: Middleware protection for user routes
- **File Security**: Private PDF storage with ownership verification
- **Input Validation**: Comprehensive server and client-side validation
- **CSRF Protection**: All forms protected against CSRF attacks

## 💳 Payment Integration

### Midtrans Features
- Multiple payment methods (Cards, Bank Transfer, E-wallets)
- Secure payment processing
- Webhook handling for real-time updates
- Order status tracking

### Supported Payment Methods
- Credit/Debit Cards
- Bank Transfer (BCA, Mandiri, BNI, BRI)
- E-wallets (GoPay, OVO, DANA)
- Convenience Store payments (Indomaret, Alfamart)

## 📖 Key Features Detail

### PDF Reader
- **Secure Access**: Only purchased books accessible
- **Interactive Features**: Notes, highlights, bookmarks
- **Navigation**: Page jumping, zoom controls
- **Responsive**: Works on desktop and mobile

### Shopping Experience
- **Smart Cart**: Persistent across sessions
- **Wishlist**: Save books for later purchase
- **Reviews**: Rate and review purchased books
- **Search**: Advanced filtering and sorting

### User Management
- **Profile Management**: Update personal information
- **Order History**: Track all purchases
- **Library Access**: Organized book collection
- **Security**: Password management and account settings

## 🚀 Deployment

See `DEPLOYMENT_GUIDE.md` for detailed production deployment instructions.

### Quick Production Setup
```bash
# Set production environment
APP_ENV=production
APP_DEBUG=false
MIDTRANS_IS_PRODUCTION=true

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

## 📊 Sample Data

The application includes seeders with:
- 10+ book categories
- 20+ sample books with metadata
- Realistic pricing and descriptions
- Sample user accounts for testing

## 🔧 Development

### Running Tests
```bash
php artisan test
```

### Code Style
```bash
./vendor/bin/pint
```

### Database Reset
```bash
php artisan migrate:fresh --seed
```

## 📞 Support

For issues and questions:
1. Check the `DEPLOYMENT_GUIDE.md` for detailed setup instructions
2. Review the code comments for implementation details
3. Check Laravel documentation for framework-specific questions

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

**Readora** - Your complete digital bookstore solution 📚✨
