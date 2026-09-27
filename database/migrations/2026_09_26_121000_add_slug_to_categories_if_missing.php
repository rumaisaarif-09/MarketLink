<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('categories', 'slug')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->string('slug')->nullable()->unique();
            });
        }

        foreach (DB::table('categories')->whereNull('slug')->get(['id', 'name']) as $category) {
            $baseSlug = Str::slug($category->name) ?: 'category';
            $slug = $baseSlug;
            $suffix = 2;

            while (DB::table('categories')->where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $suffix++;
            }

            DB::table('categories')->where('id', $category->id)->update(['slug' => $slug]);
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('categories', 'slug')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropUnique('categories_slug_unique');
                $table->dropColumn('slug');
            });
        }
    }
};