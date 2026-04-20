<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function revenueReport(Request $request)
    {
        $type = $request->query('type', 'month'); // day, week, month
        $date = $request->query('date') ? Carbon::parse($request->query('date')) : Carbon::now();
        $data = [];
        $totalRevenue = 0;

        if ($type === 'day') {
            $start = $date->copy()->startOfDay();
            $end = $date->copy()->endOfDay();

            // Hourly breakdown for one day
            for ($i = 0; $i < 24; $i++) {
                $hourStart = $start->copy()->addHours($i);
                $hourEnd = $hourStart->copy()->endHour();
                $amount = Order::whereIn('status', ['shipped', 'completed', 'delivered'])
                    ->whereBetween('created_at', [$hourStart, $hourEnd])
                    ->sum('total_amount');
                $data[] = [
                    'label' => $hourStart->format('H:00'),
                    'amount' => (float) $amount
                ];
                $totalRevenue += (float) $amount;
            }
        } elseif ($type === 'week') {
            $start = $date->copy()->startOfWeek();
            $end = $date->copy()->endOfWeek();

            for ($i = 0; $i < 7; $i++) {
                $day = $start->copy()->addDays($i);
                $amount = Order::whereIn('status', ['shipped', 'completed', 'delivered'])
                    ->whereDate('created_at', $day)
                    ->sum('total_amount');
                $data[] = [
                    'label' => $day->format('d/m'),
                    'amount' => (float) $amount
                ];
                $totalRevenue += (float) $amount;
            }
        } else {
            // Default: month
            $start = $date->copy()->startOfMonth();
            $end = $date->copy()->endOfMonth();
            $daysInMonth = $date->daysInMonth;

            for ($i = 0; $i < $daysInMonth; $i++) {
                $day = $start->copy()->addDays($i);
                $amount = Order::whereIn('status', ['shipped', 'completed', 'delivered'])
                    ->whereDate('created_at', $day)
                    ->sum('total_amount');
                $data[] = [
                    'label' => $day->format('d/m'),
                    'amount' => (float) $amount
                ];
                $totalRevenue += (float) $amount;
            }
        }

        $isExport = $request->query('export') == '1';
        $orderQuery = Order::with('items')
            ->whereIn('status', ['shipped', 'completed', 'delivered'])
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('created_at', 'desc');

        if (!$isExport) {
            $orderQuery->take(10);
        }

        return response()->json([
            'type' => $type,
            'date' => $date->toDateString(),
            'totalRevenue' => $totalRevenue,
            'chartData' => $data,
            'orders' => $orderQuery->get()
        ]);
    }

    public function stats()
    {
        $now = Carbon::now();

        // Revenue by period
        $revenueWeek  = Order::whereIn('status', ['shipped', 'completed', 'delivered'])
            ->whereBetween('created_at', [$now->startOfWeek()->copy(), $now->copy()->endOfWeek()])
            ->sum('total_amount');

        $revenueMonth = Order::whereIn('status', ['shipped', 'completed', 'delivered'])
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_amount');

        $revenueYear  = Order::whereIn('status', ['shipped', 'completed', 'delivered'])
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_amount');

        $revenueTotal = Order::whereIn('status', ['shipped', 'completed', 'delivered'])
            ->sum('total_amount');

        // Order status counts
        $ordersByStatus = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        // Top 5 selling products
        $topProducts = OrderItem::select('product_name', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(price * quantity) as total_revenue'))
            ->groupBy('product_name')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // Revenue by month (last 6 months) for chart
        $revenueByMonth = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $amount = Order::whereIn('status', ['shipped', 'completed', 'delivered'])
                ->whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->sum('total_amount');
            $revenueByMonth[] = [
                'label' => $month->format('m/Y'),
                'amount' => (float) $amount
            ];
        }

        return response()->json([
            // Summary cards
            'productsCount'  => Product::count(),
            'ordersCount'    => Order::count(),
            'usersCount'     => User::where('role', 'user')->count(),
            'contactsCount'  => Contact::count(),

            // Revenue
            'revenue'        => $revenueTotal,
            'revenueWeek'    => $revenueWeek,
            'revenueMonth'   => $revenueMonth,
            'revenueYear'    => $revenueYear,

            // Order breakdown
            'ordersByStatus' => $ordersByStatus,

            // Top products
            'topProducts'    => $topProducts,

            // Revenue chart data
            'revenueByMonth' => $revenueByMonth,

            // Recent orders
            'recentOrders'   => Order::with('items')->orderBy('created_at', 'desc')->take(8)->get(),
        ]);
    }
}
