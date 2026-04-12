@extends('admin.layout')

@section('title', 'Thêm Sản Phẩm')

@section('content')
    <h2 style="margin-bottom: 20px;">Thêm Sản Phẩm Mới</h2>

    <div style="background: #fff; padding: 20px; border-radius: 8px;">
        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Tên Sản Phẩm</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Danh mục</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Giá (VNĐ)</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Link Hình Ảnh (URL)</label>
                <input type="text" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="is_active" checked value="1"> Kích hoạt (Hiển thị)</label>
            </div>
            <button type="submit" class="btn">Lưu Sản Phẩm</button>
        </form>
    </div>
@endsection