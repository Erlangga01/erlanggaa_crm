<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users'); // Sales user
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->text('address');
            $table->foreignId('interested_product_id')->nullable()->constrained('products');
            $table->string('status')->default('New'); // New, Contacted, Qualified, Converted, Lost
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
