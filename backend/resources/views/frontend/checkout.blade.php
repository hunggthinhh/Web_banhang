@extends('frontend.layout')

@section('title', 'Thanh Toán')

@section('content')
<div class="container mt-5 mb-4">
    <h1 class="text-center mb-4">Thông Tin Thanh Toán</h1>

    <div class="d-flex" style="gap: 50px; flex-wrap: wrap;">
        <div style="flex: 2; min-width: 300px; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Họ và Tên *</label>
                    <input type="text" name="customer_name" class="form-control" value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                </div>
                <div class="form-group">
                    <label>Số Điện Thoại *</label>
                    <input type="text" name="customer_phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Địa Chỉ Giao Hàng *</label>
                    <input type="text" name="customer_address" class="form-control" required>
                </div>
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn" style="width: 100%;">Xác Nhận Đặt Hàng</button>
                </div>
            </form>
        </div>
        
        <div style="flex: 1; min-width: 300px; background: #fdfaf7; padding: 30px; border-radius: 12px;">
            <h3>Đơn Hàng Của Bạn</h3>
            <hr style="margin: 15px 0; border: 0; border-top: 1px solid var(--border);">
            
            <ul style="list-style: none; padding: 0;">
                @foreach($cart as $id => $item)
                <li style="margin-bottom: 15px; display: flex; justify-content: space-between;">
                    <span>{{ $item['name'] }} <small>x{{ $item['quantity'] }}</small></span>
                    <span>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} đ</span>
                </li>
                @endforeach
            </ul>
            
            <hr style="margin: 15px 0; border: 0; border-top: 1px solid var(--border);">
            <div class="d-flex justify-between" style="font-weight: bold; font-size: 18px;">
                <span>Tổng Cộng</span>
                <span style="color: var(--primary);">{{ number_format($total, 0, ',', '.') }} VNĐ</span>
            </div>
            <p style="font-size: 13px; color: var(--text-light); margin-top: 10px;">Thanh toán khi nhận hàng (COD)</p>
        </div>
    </div>
</div>
@endsection
