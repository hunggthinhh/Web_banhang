@extends('frontend.layout')

@section('title', 'Đăng Nhập')

@section('content')
<div class="container mt-5 mb-4 d-flex justify-center" style="justify-content: center;">
    <div style="max-width: 500px; width: 100%; background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
        <h2 class="text-center mb-4">Đăng Nhập</h2>
        <p class="text-center mb-4" style="color: var(--text-light);">Admin/User tài khoản mẫu được tạo trong database seeder.</p>
        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <span style="color: red; font-size: 12px;">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <button type="submit" class="btn mt-3" style="width: 100%;">Đăng Nhập</button>
        </form>

        <div style="margin-top: 30px; font-size: 13px; color: var(--text-light); border-top: 1px solid var(--border); padding-top: 20px;">
            <p><strong>Admin:</strong> admin@email.com / password</p>
            <p><strong>User:</strong> user@email.com / password</p>
        </div>
    </div>
</div>
@endsection
