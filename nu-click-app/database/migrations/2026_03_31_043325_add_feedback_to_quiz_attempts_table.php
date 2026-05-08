<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quiz_attempts', function (Blueprint $table) {
            // Add feedback column after score
            if (!Schema::hasColumn('quiz_attempts', 'feedback')) {
                $table->text('feedback')->nullable()->after('score');
            }
            
            // Optionally, you might want to change the score column to decimal if it's currently float
            // Uncomment if needed:
            // $table->decimal('score', 8, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->dropColumn('feedback');
        });
    }
};