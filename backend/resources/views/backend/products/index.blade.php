@extends('admin.layout')

@section('title', 'Quản lý Sản Phẩm')

@section('content')
    <div class="d-flex justify-between align-center" style="margin-bottom: 20px;">
        <h2>Danh sách Sản Phẩm</h2>
        <a href="{{ route('admin.products.create') }}" class="btn">Thêm mới</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Hình</th>
                <th>Tên</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td><img src="{{ $p->image }}" width="50" height="50" style="object-fit: cover;"></td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->category->name }}</td>
                    <td>{{ number_format($p->price, 0, ',', '.') }} đ</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $p->id) }}" style="margin-right: 10px;">Sửa</a>
                        <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" style="display:inline;"
                            onsubmit="return confirm('Khẳng định xóa?');">
                            @csrf @method('DELETE')
                            <button type="submit"
                                style="color: red; border: none; background: none; cursor: pointer;">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
@endsection