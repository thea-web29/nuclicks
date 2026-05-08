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
            if (!Schema::hasColumn('quizzes', 'time_limit')) {
                $table->integer('time_limit')->nullable()->after('total_points');
            }
            if (!Schema::hasColumn('quizzes', 'attempts_allowed')) {
                $table->integer('attempts_allowed')->default(1)->after('time_limit');
            }
            if (!Schema::hasColumn('quizzes', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('is_active');
            }
            if (!Schema::hasColumn('quizzes', 'closed_at')) {
                $table->timestamp('closed_at')->nullable()->after('published_at');
            }
        });
    }

    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn([
                'is_active',
                'time_limit',
                'attempts_allowed',
                'published_at',
                'closed_at'
            ]);
        });
    }
};