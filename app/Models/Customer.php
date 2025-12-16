<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_account_number',
        'project_id',
        'name',
        'billing_address',
        'subscription_start_date',
        'status',
    ];

    protected $casts = [
        'subscription_start_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
