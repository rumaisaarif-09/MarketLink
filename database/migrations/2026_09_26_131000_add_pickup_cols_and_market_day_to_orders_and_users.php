<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('market_day')->nullable()->after('market_name');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->date('pickup_date')->nullable()->after('shipping_address');
            $table->string('pickup_time')->nullable()->after('pickup_date');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['pickup_date', 'pickup_time']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('market_day');
        });
    }
};
