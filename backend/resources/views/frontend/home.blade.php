@extends('frontend.layout')

@section('title', 'Trang Chỉ')

@section('content')
<section class="hero">
    <div class="hero-content">
        <h1>Vị Ngọt Của Yêu Thương</h1>
        <p>Thưởng thức những chiếc bánh tươi ngon nướng mỗi ngày, mang lại cho bạn không gian ấm áp như ở nhà.</p>
        <a href="{{ route('shop') }}" class="btn">Mua Ngay</a>
    </div>
</section>

<section class="container mt-5">
    <h2 class="section-title">Bánh Nổi Bật</h2>
    <div class="products-grid">
        @foreach($featuredProducts as $item)
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
</section>
@endsection
