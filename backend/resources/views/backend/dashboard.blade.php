@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <h1 style="margin-bottom: 20px;">Tổng Quan</h1>

    <div class="d-flex" style="gap: 20px; margin-bottom: 40px;">
        <div style="flex: 1; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
            <h3>Sản Phẩm</h3>
            <p style="font-size: 24px; color: var(--primary); font-weight: bold;">{{ $productsCount }}</p>
        </div>
        <div style="flex: 1; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
            <h3>Đơn Hàng</h3>
            <p style="font-size: 24px; color: var(--primary); font-weight: bold;">{{ $ordersCount }}</p>
        </div>
        <div style="flex: 1; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
            <h3>Doanh Thu (Đã Giao)</h3>
            <p style="font-size: 24px; color: var(--primary); font-weight: bold;">{{ number_format($revenue, 0, ',', '.') }}
                VNĐ</p>
        </div>
    </div>

    <h3>Đơn hàng gần đây</h3>
    <table>
        <thead>
            <tr>
                <th>Mã ĐH</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentOrders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                    <td>
                        @if($order->status == 'pending') <span style="color: orange;">Chờ xử lý</span> @endif
                        @if($order->status == 'completed') <span style="color: green;">Đã giao</span> @endif
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection