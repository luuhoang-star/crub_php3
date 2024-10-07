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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('code',255)->nullable();
            $table->string('name',255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phone',255)->nullable();
           $table->string('image',255)->nullable();
//         $table->string('image', 255)->change();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
