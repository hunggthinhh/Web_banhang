@extends('frontend.layout')

@section('title', 'Thực đơn Bánh')

@section('content')
<div class="container mt-5 mb-4">
    <h1 class="text-center">Thực Đơn Của Chúng Tôi</h1>
    
    <div class="products-grid">
        @foreach($products as $item)
        <div class="product-card">
            <a href="{{ route('product.detail', $item->slug) }}">
                <img src="{{ $item->image }}" alt="{{ $item->name }}" class="product-img">
            </a>
            <div class="product-info">
                <a href="{{ route('product.detail', $item->slug) }}">
                    <h3>{{ $item->name }}</h3>
                </a>
                <div class="product-price">{{ number_format($item->price, 0, ',', '.') }} VNĐ</div>
                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline" style="width: 100%;">Thêm vào giỏ</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Phân trang (nếu có) -->
    <div style="margin-top: 30px; text-align: center;">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
