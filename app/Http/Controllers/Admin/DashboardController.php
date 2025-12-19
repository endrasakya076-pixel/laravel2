<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Ebook;
use App\Models\Message;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Order::where('status', 'completed')->sum('total_amount');
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $totalEbooks = Ebook::count();
        $unreadMessages = Message::where('is_read', false)->count();
        
        // Sales chart data (last 7 days)
        $salesData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $sales = Order::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->sum('total_amount');
            $salesData[] = [
                'date' => Carbon::parse($date)->format('d M'),
                'sales' => $sales
            ];
        }
        
        // Recent orders
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Top selling ebooks
        $topEbooks = Ebook::withCount(['orderItems as sales_count' => function($query) {
                $query->whereHas('order', function($q) {
                    $q->where('status', 'completed');
                });
            }])
            ->orderBy('sales_count', 'desc')
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalSales',
            'totalOrders',
            'totalUsers',
            'totalEbooks',
            'unreadMessages',
            'salesData',
            'recentOrders',
            'topEbooks'
        ));
    }
}
