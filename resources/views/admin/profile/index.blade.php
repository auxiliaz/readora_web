@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="page-title">── Profil Admin</h1>
            <a href="{{ route('admin.dashboard') }}" class="cta-button">
                Dashboard <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Profile Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Informasi Profil</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $admin->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $admin->email) }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="cta-button">
                            <i class="bi bi-check-circle"></i> Perbarui Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ubah Password</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.profile.password') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini <span class="text-danger">*</span></label>
                        <input type="password" 
                               class="form-control @error('current_password') is-invalid @enderror" 
                               id="current_password" 
                               name="current_password" 
                               required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password Baru <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="cta-button">
                            <i class="bi bi-shield-lock"></i> Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Admin Info -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Informasi Admin</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="avatar-circle text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                         style="width: 80px; height: 80px; font-size: 2rem; background-color: var(--primary-color);">
                        {{ strtoupper(substr($admin->name, 0, 1)) }}
                    </div>
                    <h5 class="mt-3 mb-1">{{ $admin->name }}</h5>
                    <p class="text-muted">{{ $admin->email }}</p>
                </div>

                <table class="table table-borderless table-sm">
                    <tr>
                        <td><strong>Akun Dibuat:</strong></td>
                        <td>{{ $admin->created_at->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Terakhir Diperbarui:</strong></td>
                        <td>{{ $admin->updated_at->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td><span class="badge" style="background-color: var(--primary-color); color: white;">Aktif</span></td>
                    </tr>
                    <tr>
                        <td><strong>Role:</strong></td>
                        <td>Administrator</td>
                    </tr>
                </table>

                <hr>

                <div class="mt-3">
                    <h6 class="mb-3">Tips Keamanan</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="bi bi-shield-check text-success me-2"></i>
                            <small>Gunakan password yang kuat dan unik</small>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-shield-check text-success me-2"></i>
                            <small>Ubah password secara berkala</small>
                        </li>
                        <li>
                            <i class="bi bi-shield-check text-success me-2"></i>
                            <small>Logout setelah selesai</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .page-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #710014;
        margin-bottom: 0;
    }
    
    .cta-button {
        background: var(--primary-color);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
    }

    .cta-button:hover {
        background: #5a0010;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        border-radius: 12px;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        border-radius: 12px 12px 0 0 !important;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 0.75rem 1rem;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(113, 0, 20, 0.25);
    }

    .avatar-circle {
        font-weight: 700;
        letter-spacing: 1px;
    }
</style>
