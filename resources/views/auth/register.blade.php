@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow border-0 p-4" style="width: 420px; border-radius: 15px; background: #ffffff;">
        <div class="text-center mb-4">
            <div class="rounded-circle d-flex justify-content-center align-items-center mx-auto mb-3"
                 style="width: 50px; height: 50px; background-color: #4e73df;">
                <i class="bi bi-person-plus text-white fs-3"></i>
            </div>
            <h4 class="fw-bold text-dark">Đăng Ký Tài Khoản</h4>
            <p class="text-muted small">Hãy tham gia cùng chúng tôi!</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
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
        
            <div class="mb-3">
                <label for="password-confirm" class="form-label fw-semibold text-dark">Xác nhận mật khẩu</label>
                <input id="password-confirm" type="password"
                       class="form-control shadow-sm px-3 py-2"
                       name="password_confirmation" required
                       placeholder="Xác nhận mật khẩu"
                       style="border-radius: 12px;">
            </div>
        
            <button type="submit" class="btn w-100 text-white fw-semibold py-2" style="background-color: #36b9cc; border-radius: 12px;">
                <i class="bi bi-check-circle me-1"></i> Đăng ký
            </button>
        </form>
        

        <div class="text-center mt-4">
            <span class="text-muted small">Đã có tài khoản?</span>
            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold ms-1 text-primary">Đăng nhập ngay</a>
        </div>
    </div>
</div>
@endsection
