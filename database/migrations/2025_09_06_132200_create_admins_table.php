<?php

use App\Enums\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('custom_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('device_token')->nullable()->comment('fcm token');
            $table->enum('status', array_map(fn($case) => $case->value, Status::cases()))->default(Status::ACTIVE->value)->comment('1=Active, 0=Inactive');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
