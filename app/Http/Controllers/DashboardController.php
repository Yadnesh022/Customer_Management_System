<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // ✅ Safe user check FIRST
        $user = Auth::user();
        
        if (!$user) {
            // Redirect unauthenticated users to login
            return redirect()->route('login');
        }

        // Common statistics for both roles
        $totalCustomers = Customer::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('amount');
        $recentCustomers = Customer::latest()->take(5)->get();
        
        $ordersByStatus = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        // ✅ Admin gets additional data and different view
        if ($user->role === 'admin') {
            $pendingOrders = Order::where('status', 'pending')->count();
            $completedToday = Order::where('status', 'completed')
                ->whereDate('created_at', today())
                ->count();
            $revenueToday = Order::where('status', 'completed')
                ->whereDate('created_at', today())
                ->sum('amount');
            $recentOrders = Order::with('customer')->latest()->take(5)->get();
            
            return view('dashboard-admin', compact(
                'totalCustomers',
                'totalOrders',
                'totalRevenue',
                'recentCustomers',
                'ordersByStatus',
                'pendingOrders',
                'completedToday',
                'revenueToday',
                'recentOrders'
            ));
        }
        
        // Staff gets simplified dashboard
        return view('dashboard-staff', compact(
            'totalCustomers',
            'totalOrders',
            'totalRevenue',
            'recentCustomers',
            'ordersByStatus'
        ));
    }
}
