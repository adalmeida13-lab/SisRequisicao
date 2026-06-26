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
        Schema::create('request_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->onDelete('cascade');
            $table->foreignId('request_id')->onDelete('cascade');
            $table->timestamp('date_actioned');
            $table->foreignId('department_orig_id')->onDelete('cascade');
            $table->foreignId('department_dest_id')->onDelete('cascade');
            $table->foreignId('user_action_id')->onDelete('cascade');
            $table->string('description_action', 255);
            $table->enum('status', ['open', 'attended', 'closed', 'canceled'])->default('open');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_details');
    }
};
