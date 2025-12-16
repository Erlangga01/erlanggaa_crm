<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::with('product');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $leads = $query->latest()->get();

        return view('leads.index', compact('leads'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)->get();
        return view('leads.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'interested_product_id' => 'nullable|exists:products,id',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'New';

        Lead::create($validated);

        return redirect()->route('leads.index')->with('success', 'Lead berhasil ditambahkan.');
    }

    public function edit(Lead $lead)
    {
        $products = Product::where('is_active', true)->get();
        return view('leads.edit', compact('lead', 'products'));
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'interested_product_id' => 'nullable|exists:products,id',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $lead->update($validated);

        return redirect()->route('leads.index')->with('success', 'Lead berhasil diperbarui.');
    }
}
