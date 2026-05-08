<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('student')->after('email');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->string('status')->default('active')->after('role');
            }
            if (!Schema::hasColumn('users', 'student_id')) {
                $table->string('student_id')->nullable()->unique()->after('status');
            }
            if (!Schema::hasColumn('users', 'year_level')) {
                $table->integer('year_level')->nullable()->after('student_id');
            }
            if (!Schema::hasColumn('users', 'department')) {
                $table->string('department')->nullable()->after('year_level');
            }
            if (!Schema::hasColumn('users', 'specialization')) {
                $table->string('specialization')->nullable()->after('department');
            }
            if (!Schema::hasColumn('users', 'qualification')) {
                $table->text('qualification')->nullable()->after('specialization');
            }
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable()->after('qualification');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'status',
                'student_id',
                'year_level',
                'department',
                'specialization',
                'qualification',
                'bio'
            ]);
        });
    }
};