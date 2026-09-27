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
            $table->boolean('is_active')->default(true);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->default('pending')->change();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('rating');
            $table->text('comment')->nullable();
            $table->text('vendor_response')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
            $table->unique(['product_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        DB::table('orders')->where('status', 'shipped')->update(['status' => 'processing']);
        DB::table('orders')->where('status', 'delivered')->update(['status' => 'completed']);
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])
                ->default('pending')
                ->change();
        });
    }
};