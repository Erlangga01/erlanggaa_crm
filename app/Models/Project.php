<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'product_id',
        'sales_id',
        'surveyor_name',
        'installation_date',
        'status',
        'is_manager_approved',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'installation_date' => 'date',
        'approved_at' => 'datetime',
        'is_manager_approved' => 'boolean',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sales()
    {
        return $this->belongsTo(User::class, 'sales_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
}
