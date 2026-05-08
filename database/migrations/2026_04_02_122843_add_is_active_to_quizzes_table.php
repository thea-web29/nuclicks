<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            if (!Schema::hasColumn('quizzes', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('total_points');
            }
        });
    }

    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            if (Schema::hasColumn('quizzes', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};