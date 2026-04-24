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
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'note')) {
                $table->text('note')->nullable()->after('status');
            }
            if (!Schema::hasColumn('orders', 'delivery_date')) {
                $table->date('delivery_date')->nullable()->after('note');
            }
            if (!Schema::hasColumn('orders', 'delivery_time')) {
                $table->string('delivery_time')->nullable()->after('delivery_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['note', 'delivery_date', 'delivery_time']);
        });
    }
};
