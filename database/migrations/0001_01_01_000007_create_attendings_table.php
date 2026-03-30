<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('event_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('num_tickets')->default(1);

            $table->string('guest_name')->nullable();
            $table->string('guest_phone')->nullable();
            $table->string('guest_email')->nullable();

            $table->timestamp('attended_at')->nullable()->comment('متى تم تأكيد الحضور فعلياً');
            $table->foreignId('qr_scanned_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('من قام بمسح QR لهذا الحضور');

            $table->string('qr_token')->nullable()->unique();
            $table->string('qr_path')->nullable();
            $table->timestamp('qr_generated_at')->nullable();

            $table->timestamps();
            $table->index(['event_id', 'attended_at']);
            $table->index('user_id');
            $table->index('qr_token');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendings');
    }
};
