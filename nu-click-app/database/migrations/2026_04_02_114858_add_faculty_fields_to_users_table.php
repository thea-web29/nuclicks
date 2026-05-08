<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'specialization')) {
                $table->string('specialization')->nullable()->after('department');
            }
            if (!Schema::hasColumn('users', 'qualification')) {
                $table->text('qualification')->nullable()->after('specialization');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['specialization', 'qualification']);
        });
    }
};