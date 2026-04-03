@extends('admin.layout')

@section('title', 'Quản lý Đơn Hàng')

@section('content')
    <h2>Danh sách Đơn Hàng</h2>

    <table style="margin-top: 20px;">
        <thead>
            <tr>
                <th>Mã ĐH</th>
                <th>Khách hàng</th>
                <th>Số Điện Thoại</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Cập nhật</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>
                        <strong>{{ $order->customer_name }}</strong><br>
                        <small>{{ $order->customer_address }}</small>
                    </td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>{{ number_format($order->total_amount, 0, ',', '.') }} đ</td>
                    <td>
                        <form action="{{ route('admin.orders.update_status', $order->id) }}" method="POST">
                            @csrf @method('PUT')
                            <select name="status" onchange="this.form.submit()" style="padding: 5px; border-radius: 4px;">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang làm
                                </option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đang giao</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành
                                </option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Hủy</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        {{ $order->created_at->format('d/m/Y H:i') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $orders->links('pagination::bootstrap-4') }}
    </div>
@endsection