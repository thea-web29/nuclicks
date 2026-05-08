<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('admin_files')) {
            Schema::create('admin_files', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('original_name')->nullable();
                $table->enum('type', ['folder', 'file'])->default('file');
                $table->foreignId('parent_id')->nullable()->constrained('admin_files')->nullOnDelete();
                $table->string('path')->nullable();
                $table->string('mime_type')->nullable();
                $table->unsignedBigInteger('size')->nullable();
                $table->text('description')->nullable();
                $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
                $table->foreignId('faculty_id')->nullable()->constrained('users')->nullOnDelete();
                $table->timestamp('archived_at')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_files');
    }
};
