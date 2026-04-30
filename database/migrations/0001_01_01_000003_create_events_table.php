<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->nullable();
            $table->string('slug')->unique();
            $table->longText('description');
            $table->string('location')->nullable();
            $table->json('excluded_days')->nullable();
            $table->boolean('is_public')->default(false);
            $table->string('qr_code')->nullable();
            $table->integer('num_tickets');

            $table->string('attendance_token', 64)->unique()->nullable();

            $table->date('start_date');
            $table->date('end_date');
            $table->string('image');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('faculty_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
