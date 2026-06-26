<?php

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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->timestamp('date_opened');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('date_closed')->nullable();
            $table->string('description', 255);
            $table->enum('status', ['open', 'in_progress', 'closed', 'canceled'])->default('open');
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('feedback')->nullable();
            $table->string('feedback_comment', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
