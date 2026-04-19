<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('magazines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('cover');
            $table->string('file');
            $table->text('description'); // NOT NULL
            $table->timestamps();

            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('magazines');
    }
};
