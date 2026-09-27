<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('buyer')->change();
        });

        DB::table('users')->where('role', 'customer')->update(['role' => 'buyer']);
        DB::table('users')->where('role', 'farmer')->update(['role' => 'vendor']);
    }

    public function down(): void
    {
        DB::table('users')->where('role', 'buyer')->update(['role' => 'customer']);
        DB::table('users')->where('role', 'vendor')->update(['role' => 'farmer']);

        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'farmer', 'customer'])
                ->default('customer')
                ->change();
        });
    }
};