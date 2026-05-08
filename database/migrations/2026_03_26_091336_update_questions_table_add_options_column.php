<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            if (!Schema::hasColumn('questions', 'options')) {
                $table->json('options')->nullable()->after('question_type');
            }
            if (!Schema::hasColumn('questions', 'correct_answer')) {
                $table->text('correct_answer')->nullable()->after('options');
            }
            if (!Schema::hasColumn('questions', 'points')) {
                $table->integer('points')->default(1)->after('correct_answer');
            }
        });
    }

    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn(['options', 'correct_answer', 'points']);
        });
    }
};