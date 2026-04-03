@extends('admin.layout')

@section('title', 'Sửa Sản Phẩm')

@section('content')
    <h2 style="margin-bottom: 20px;">Cập Nhật Sản Phẩm</h2>

    <div style="background: #fff; padding: 20px; border-radius: 8px;">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Tên Sản Phẩm</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label>Danh mục</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Giá (VNĐ)</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
            </div>
            <div class="form-group">
                <label>Link Hình Ảnh (URL)</label>
                <input type="text" name="image" class="form-control" value="{{ $product->image }}">
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="5">{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="is_active" {{ $product->is_active ? 'checked' : '' }} value="1"> Kích
                    hoạt</label>
            </div>
            <button type="submit" class="btn">Lưu Thay Đổi</button>
        </form>
    </div>
@endsection