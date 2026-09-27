<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('market_name')->nullable();
            $table->string('market_address')->nullable();
            $table->decimal('market_latitude', 10, 7)->nullable();
            $table->decimal('market_longitude', 10, 7)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'market_name',
                'market_address',
                'market_latitude',
                'market_longitude',
            ]);
        });
    }
};