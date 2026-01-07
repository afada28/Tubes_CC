<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Get visitor data for last 30 days
        $visitorData = Visitor::select(
            DB::raw('DATE(visit_date) as date'),
            DB::raw('COUNT(DISTINCT ip_address) as unique_visitors'),
            DB::raw('COUNT(*) as total_visits')
        )
        ->where('visit_date', '>=', now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        // Today's stats
        $todayVisitors = Visitor::where('visit_date', today())
            ->distinct('ip_address')
            ->count();

        // This week's stats
        $weekVisitors = Visitor::where('visit_date', '>=', now()->startOfWeek())
            ->distinct('ip_address')
            ->count();

        // This month's stats
        $monthVisitors = Visitor::where('visit_date', '>=', now()->startOfMonth())
            ->distinct('ip_address')
            ->count();

        // Total visitors
        $totalVisitors = Visitor::distinct('ip_address')->count();

        // Most visited pages
        $topPages = Visitor::select('page_visited', DB::raw('COUNT(*) as visits'))
            ->where('visit_date', '>=', now()->subDays(30))
            ->whereNotNull('page_visited')
            ->groupBy('page_visited')
            ->orderBy('visits', 'desc')
            ->limit(10)
            ->get();

        return view('admin.analytics.index', compact(
            'visitorData',
            'todayVisitors',
            'weekVisitors',
            'monthVisitors',
            'totalVisitors',
            'topPages'
        ));
    }

    public function getChartData()
    {
        $data = Visitor::select(
            DB::raw('DATE(visit_date) as date'),
            DB::raw('COUNT(DISTINCT ip_address) as visitors')
        )
        ->where('visit_date', '>=', now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        return response()->json($data);
    }
}
