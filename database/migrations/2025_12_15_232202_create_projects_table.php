<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('sales_id')->constrained('users');
            $table->string('surveyor_name')->nullable();
            $table->date('installation_date')->nullable();
            $table->string('status')->default('Survey'); // Survey, Pending Approval, Installation, Completed, Cancelled
            $table->boolean('is_manager_approved')->default(false);
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
