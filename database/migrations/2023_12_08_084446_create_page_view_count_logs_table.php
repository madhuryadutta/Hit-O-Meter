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
        Schema::create('page_view_count_logs', function (Blueprint $table) {
            $table->id();
            $table->string('fk_tracking_no');
            $table->string('ip_address');
            $table->string('geolocation')->nullable();
            $table->string('user_agent');
            $table->string('host')->nullable();
            $table->boolean('soft_del')->default(0);
            $table->foreign('fk_tracking_no')->references('tracking_no')->on('page_view_count_link_creations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_view_count_logs');
    }
};
