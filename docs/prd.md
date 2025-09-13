# Product Requirement Document (PRD) - Readora Admin Panel

## 1. Overview
Admin panel for managing Readora digital e-book store.  
Provides admin with dashboard, CRUD operations for books and categories, ability to manage reviews, and simple profile management.  

---

## 2. Goals
- Allow admin to manage book and category data efficiently.  
- Provide admin with insights on sales and activity via charts and statistics.  
- Enable review moderation (view and delete).  
- Provide simple profile management and secure authentication.  

---

## 3. User Role
### Admin
- Authenticate via login.  
- Manage books and categories (CRUD).  
- View dashboard with stats, calendar, and charts.  
- View and delete buyer reviews.  
- Manage own profile (basic info, password).  
- Logout securely.  

---

## 4. Features

### 4.1 Authentication
- Admin login (email, password).  
- Session-based authentication.  
- Logout functionality.  

### 4.2 Dashboard
- Greeting: “Welcome Admin”.  
- Stats:  
  - Total Books.  
  - Total Categories.  
  - Total Books Sold (current month).  
- Calendar widget.  
- Charts/Diagrams:  
  - Sales per month (Line/Bar chart).  
  - Category distribution (Pie/Donut chart).  
  - Book popularity/top selling (Bar chart).  

### 4.3 Sidebar Navigation
- Dashboard.  
- Books (CRUD).  
- Categories (CRUD).  
- Reviews (View/Delete).  
- Profile.  
- Logout.  

### 4.4 CRUD Categories
- Add new category.  
- Edit existing category.  
- Delete category.  
- Categories integrated into book form as selectable field.  

### 4.5 CRUD Books
- Add book: title, author, description, price, category, upload file (PDF).  
- Edit book.  
- Delete book.  
- View list of all books.  

### 4.6 Reviews Management
- View list of reviews by users.  
- Filter reviews by book.  
- Delete inappropriate reviews.  

### 4.7 Profile
- View admin info (name, email).  
- Update email/password.  

---

## 5. User Flow (Admin)

1. **Login** → Admin enters email & password → redirected to Dashboard.  
2. **Dashboard** → Shows stats, charts, and calendar.  
3. **Sidebar Navigation** → Admin chooses between Books, Categories, Reviews, Profile.  
4. **Books CRUD** → Add/Edit/Delete books.  
5. **Categories CRUD** → Add/Edit/Delete categories.  
6. **Reviews** → View list of reviews, delete if needed.  
7. **Profile** → Edit basic info, update password.  
8. **Logout** → End session, redirect to login page.  

---

## 6. Database (Admin Related Tables)

### Admins
- id  
- name  
- email  
- password  
- created_at  
- updated_at  

### Categories
- id  
- name  
- created_at  
- updated_at  

### Books
- id  
- title  
- author  
- description  
- price  
- category_id  
- file_path (PDF storage path)  
- created_at  
- updated_at  

### Reviews
- id  
- user_id  
- book_id  
- rating  
- review_text  
- created_at  
- deleted_at (for soft delete by admin)  

---

## 7. Tech Stack
- **Framework**: Laravel  
- **Frontend**: Blade, Bootstrap/Tailwind  
- **Database**: MySQL  
- **Charts**: Chart.js or Laravel Charts  

---

## 8. Future Enhancements
- Multi-admin support with role-based access.  
- Advanced analytics dashboard.  
- Admin activity logs.  

## UI/UX Design

### Design System

The application will follow a consistent design system:

---

#### 1. Color Palette
- **Primary**: #710014  
- **Secondary**: #B38F6F  
- **Background**: #F2F1ED  
- **Text**: #000000 (Black)  
- **Success**: #10B981 (Green)  
- **Error**: #EF4444 (Red)  
- **Warning**: #F59E0B (Amber)  

---

#### 2. Typography
- **Headings**: Playfair Display (Bold)  
- **Body**: Poppins (Regular)  
- **Buttons**: Poppins (Medium)  
- **Size Scale**: 12px, 14px, 16px, 18px, 20px, 24px, 30px, 36px  

---

#### 3. Component Library

##### Core Components
- **Buttons**  
  - Variants: Primary, Secondary, Outline, Disabled  
  - Sizes: Small, Medium, Large  

- **Form Components**  
  - Text Input (with validation states: success, error, warning)  
  - Password Input (toggle visibility)  
  - Select Dropdown (for categories/filters)  
  - Checkbox / Radio (for filter options, terms & conditions)  

- **Cards**  
  - Book Card (cover image, title, author, price, rating, add-to-cart button)  
  - Review Card (user avatar, name, rating stars, review text)  
  - Transaction Card (order ID, date, status)  

- **Chips**  
  - Status Chips for transaction states (Success, Pending, Failed)  
  - Category Chips for filtering books  

- **Progress Indicators**  
  - Loading Spinner (for fetch states)  
  - Linear Progress (for reader progress if needed)  

---

##### Navigation & Layout
- **Navbar**  
  - Sections: Logo, Home, Categories, Search, Wishlist, Cart, Profile/Login  
  - Responsive (collapsible on mobile)  

- **Sidebar (optional)**  
  - For filtering books in category page  

- **Breadcrumbs**  
  - For navigation inside book detail or checkout flow  

- **Footer**  
  - About, Contact, Social Media Links  

---

##### User Interaction Components
- **Search Bar**  
  - Auto-suggestion for book titles/authors  
  - Clearable input  

- **Pagination**  
  - For book listing and reviews  

- **Modal/Dialogs**  
  - Login/Register  
  - Checkout Confirmation  
  - Review Submission  

- **Alerts/Notifications**  
  - Toast Notifications for success/error actions (e.g., “Added to cart”)  

---

##### Reader Components
- **PDF Viewer Frame**  
  - Navigation (next/previous page, jump to page)  
  - Zoom controls (in/out, fit to width)  
  - Highlight text feature  
  - Notes sidebar (user’s saved highlights & comments)  

---

##### Review & Rating
- **Rating Stars**  
  - Interactive (1–5) for input  
  - Display-only for book detail page  

- **Review Form**  
  - Rating selector  
  - Textarea input with validation  

---

#### 4. Accessibility & Responsiveness
- Color contrast checked for readability.  
- Keyboard navigation support (tab focus).  
- Responsive design for mobile, tablet, and desktop.  

