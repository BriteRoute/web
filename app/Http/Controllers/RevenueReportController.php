<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PendingPayout;
use App\Order;
use Session;
use Auth;

class RevenueReportController extends Controller
{
    public function report()
    {
        $orders = Order::where('status', '1')->whereNotNull('total_amount')->get();
    	// $revenue = PendingPayout::where('status', '1')->get();
    	return view('admin.revenue.report.admin', compact('orders'));

    }

    public function instructorReport()
    {
    	$revenue = PendingPayout::get();
    	return view('admin.revenue.report.instructor', compact('revenue'));
    	
    }
}
