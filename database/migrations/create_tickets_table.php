<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['customer', 'premium_customer', 'admin'])->default('customer');
            $table->timestamps();
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('subject');
            $table->text('description');
            $table->enum('type', ['standard', 'priority']);
            $table->enum('status', ['open', 'in_progress', 'resolved'])->default('open');
            $table->integer('sla_hours');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('users');
    }
};