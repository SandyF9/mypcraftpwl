<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data dummy untuk grafik
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $revenueData = [12200, 14800, 13100, 16100, 15300, 17800, 19100, 21300, 18800, 22000, 24800, 26200];
        $ordersData = [230, 285, 310, 265, 340, 395, 420, 375, 460, 500, 488, 530];

        return view('dashboard', compact('months', 'revenueData', 'ordersData'));
    }
}