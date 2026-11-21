<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->boolean('is_custom_priced')->default(false)->after('price');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->boolean('price_is_quote')->default(false)->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('price_is_quote');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('is_custom_priced');
        });
    }
};
