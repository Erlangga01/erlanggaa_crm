<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'leads' => \App\Models\Lead::count(),
            'projects' => \App\Models\Project::whereIn('status', ['Survey', 'Pending Approval', 'Installation'])->count(),
            'customers' => \App\Models\Customer::where('status', 'Active')->count(),
            'products' => \App\Models\Product::where('is_active', true)->count(),
        ];

        $recentLeads = \App\Models\Lead::with('product')->latest()->take(5)->get();

        return view('dashboard.index', compact('stats', 'recentLeads'));
    }
}
