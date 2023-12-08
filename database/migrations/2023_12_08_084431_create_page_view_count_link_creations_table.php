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
        Schema::create('page_view_count_link_creations', function (Blueprint $table) {
            $table->string('tracking_no')->primary();
            $table->unsignedBigInteger('user_id');
            $table->string('host');
            $table->unsignedBigInteger('view_count');
            $table->string('remark')->nullable();
            $table->boolean('soft_del')->default(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_view_count_link_creations');
    }
};
