<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('user_account_number')->unique();
            $table->foreignId('project_id')->constrained('projects');
            $table->string('name');
            $table->text('billing_address');
            $table->date('subscription_start_date');
            $table->string('status')->default('Active'); // Active, Suspended, Churned
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
