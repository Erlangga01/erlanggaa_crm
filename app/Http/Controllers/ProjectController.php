<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['lead', 'product', 'sales'])->latest()->get();
        return view('projects.index', compact('projects'));
    }

    public function create(Request $request)
    {
        $lead = null;
        if ($request->has('lead_id')) {
            $lead = Lead::find($request->lead_id);
        }
        $products = Product::where('is_active', true)->get();
        return view('projects.create', compact('lead', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'product_id' => 'required|exists:products,id',
            'installation_date' => 'required|date',
            'surveyor_name' => 'required|string',
        ]);

        $project = Project::create([
            'lead_id' => $validated['lead_id'],
            'product_id' => $validated['product_id'],
            'sales_id' => Auth::id(),
            'installation_date' => $validated['installation_date'],
            'surveyor_name' => $validated['surveyor_name'],
            'status' => 'Pending Approval', // Needs manager approval
            'is_manager_approved' => false,
        ]);

        // Update Lead status
        $lead = Lead::find($validated['lead_id']);
        $lead->update(['status' => 'Converted']); // Or 'Processing'

        return redirect()->route('projects.index')->with('success', 'Project created. Waiting for Manager Approval.');
    }

    public function approve(Project $project)
    {
        if (Auth::user()->role !== 'manager') {
            abort(403, 'Only Manager can approve.');
        }

        $project->update([
            'is_manager_approved' => true,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'status' => 'Installation',
        ]);

        return redirect()->back()->with('success', 'Project approved. Ready for Installation.');
    }

    public function finishInstallation(Project $project)
    {
        if ($project->status !== 'Installation') {
            return redirect()->back()->with('error', 'Project not in Installation phase.');
        }

        // Complete Project
        $project->update(['status' => 'Completed']);

        // Create Customer
        $customer = Customer::create([
            'user_account_number' => 'CUST-' . now()->format('Y') . '-' . str_pad($project->id, 4, '0', STR_PAD_LEFT),
            'project_id' => $project->id,
            'name' => $project->lead->name,
            'billing_address' => $project->lead->address,
            'subscription_start_date' => now(), // Assume starts today
            'status' => 'Active',
        ]);

        return redirect()->route('customers.index')->with('success', 'Installation finished. Customer Active.');
    }
}
