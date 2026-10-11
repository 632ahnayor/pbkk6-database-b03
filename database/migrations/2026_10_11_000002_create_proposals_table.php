<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('proposals')) {
            Schema::create('proposals', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->string('title');
                $table->text('description')->nullable();
                $table->decimal('grade', 5, 2)->nullable();
                $table->timestamps();
            });
        } elseif (! Schema::hasColumn('proposals', 'grade')) {
            Schema::table('proposals', function (Blueprint $table) {
                $table->decimal('grade', 5, 2)->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
