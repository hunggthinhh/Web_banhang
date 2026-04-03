@extends('frontend.layout')

@section('title', $product->name)

@section('content')
<div class="container mt-5 mb-4">
    <div class="d-flex" style="gap: 50px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 300px;">
            <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width: 100%; border-radius: 12px;">
        </div>
        <div style="flex: 1; min-width: 300px;">
            <h1 style="margin-bottom: 10px;">{{ $product->name }}</h1>
            <p style="color: #8c7e73; font-style: italic; margin-bottom: 20px;">Danh mục: {{ $product->category->name }}</p>
            <h2 style="color: var(--primary); margin-bottom: 20px;">{{ number_format($product->price, 0, ',', '.') }} VNĐ</h2>
            
            <div style="margin-bottom: 30px; line-height: 1.8;">
                {!! nl2br(e($product->description)) !!}
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn">Thêm Vào Giỏ Hàng</button>
            </form>
        </div>
    </div>

    <div class="mt-5">
        <h2 class="text-center" style="margin-bottom: 30px;">Có thể bạn cũng thích</h2>
        <div class="products-grid">
            @foreach($relatedProducts as $item)
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
    </div>
</div>
@endsection
