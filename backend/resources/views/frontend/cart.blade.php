@extends('frontend.layout')

@section('title', 'Giỏ Hàng')

@section('content')
<div class="container mt-5 mb-4">
    <h1 class="text-center mb-4">Giỏ Hàng Của Bạn</h1>

    @if(empty($cart))
        <div class="text-center">
            <p>Giỏ hàng của bạn đang trống.</p>
            <a href="{{ route('shop') }}" class="btn mt-3">Tiếp Tục Mua Sắm</a>
        </div>
    @else
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td><img src="{{ $item['image'] }}" width="80" alt="{{ $item['name'] }}"></td>
                    <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            <button type="submit" style="background: none; border: none; color: #721c24; cursor: pointer; text-decoration: underline;">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-between mt-5" style="align-items: center">
            <a href="{{ route('shop') }}" class="btn btn-outline">Tiếp Tục Mua Sắm</a>
            <div style="text-align: right;">
                <h3 style="margin-bottom: 20px;">Tạm tính: <span style="color: var(--primary);">{{ number_format($total, 0, ',', '.') }} VNĐ</span></h3>
                <a href="{{ route('checkout') }}" class="btn">Thanh Toán</a>
            </div>
        </div>
    @endif
</div>
@endsection
