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
        Schema::create('activity_by_companies', function (Blueprint $table) {
            $table->unsignedBigInteger('id_company');
            $table->foreign('id_company')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('id_activity');
            $table->foreign('id_activity')->references('id')->on('type_activities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_by_companies');
    }
};
