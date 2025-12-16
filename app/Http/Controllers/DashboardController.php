<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $querySalesName = $request->input('sales_name');
        $querySurveyorName = $request->input('surveyor_name');

        $stats = [
            'leads' => \App\Models\Lead::count(),
            'projects' => \App\Models\Project::whereIn('status', ['Survey', 'Pending Approval', 'Installation'])->count(),
            'customers' => \App\Models\Customer::where('status', 'Active')->count(),
            'products' => \App\Models\Product::where('is_active', true)->count(),
        ];

        $recentLeads = \App\Models\Lead::with('product')->latest()->take(5)->get();

        // 1. Sales Performance (Projects created by Sales)
        // Group by Sales User -> Count Projects
        $salesPerformance = \App\Models\User::where('role', 'sales')
            ->withCount('projects')
            ->when($querySalesName, function ($q) use ($querySalesName) {
                $q->where('name', 'like', "%{$querySalesName}%");
            })
            ->get()
            ->map(function ($user) {
                return [
                    'name' => $user->name,
                    'count' => $user->projects_count,
                ];
            });

        // 2. Installation Performance (Projects by Surveyor)
        // Group by Surveyor Name -> Count Projects
        // Note: surveyor_name is a string column in projects table
        $surveyorPerformance = \App\Models\Project::select('surveyor_name', \DB::raw('count(*) as total'))
            ->whereNotNull('surveyor_name')
            ->groupBy('surveyor_name')
            ->when($querySurveyorName, function ($q) use ($querySurveyorName) {
                $q->where('surveyor_name', 'like', "%{$querySurveyorName}%");
            })
            ->get()
            ->map(function ($row) {
                return [
                    'name' => $row->surveyor_name,
                    'count' => $row->total,
                ];
            });

        return view('dashboard.index', compact('stats', 'recentLeads', 'salesPerformance', 'surveyorPerformance'));
    }
}
