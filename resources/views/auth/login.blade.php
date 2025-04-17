@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow border-0 p-4" style="width: 420px; border-radius: 15px; background: #ffffff;">
        <div class="text-center mb-4">
            <div class="rounded-circle d-flex justify-content-center align-items-center mx-auto mb-3"
                 style="width: 50px; height: 50px; background-color: #4e73df;">
                <i class="bi bi-person-fill text-white fs-3"></i>
            </div>
            <h4 class="fw-bold text-dark">Đăng Nhập</h4>
            <p class="text-muted small">Chào mừng bạn trở lại 👋</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold text-dark">Tên đăng nhập</label>
                <input id="name" type="text"
                       class="form-control shadow-sm px-3 py-2 @error('name') is-invalid @enderror"
                       name="name" value="{{ old('name') }}" required autofocus
                       placeholder="Nhập tên đăng nhập"
                       style="border-radius: 12px;">
                @error('name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold text-dark">Mật khẩu</label>
                <input id="password" type="password"
                       class="form-control shadow-sm px-3 py-2 @error('password') is-invalid @enderror"
                       name="password" required
                       placeholder="Nhập mật khẩu"
                       style="border-radius: 12px;">
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                           {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Ghi nhớ</label>
                </div>
                <a href="#" class="text-decoration-none small text-primary">Quên mật khẩu?</a>
            </div>

            <button type="submit" class="btn w-100 text-white fw-semibold py-2" style="background-color: #36b9cc; border-radius: 12px;">
                <i class="bi bi-box-arrow-in-right me-1"></i> Đăng nhập
            </button>
        </form>

        <div class="text-center mt-4">
            <span class="text-muted small">Chưa có tài khoản?</span>
            <a href="{{ route('register') }}" class="text-decoration-none fw-semibold ms-1 text-primary">Đăng ký ngay</a>
        </div>
    </div>
</div>
@endsection
