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
        Schema::create('upload_files', function (Blueprint $table) {
            $table->id();
            $table->string('file_path'); // Đường dẫn file
            $table->string('file_type'); // Loại file (image, pdf, doc, ...)
            $table->string('target_type'); // Đối tượng liên quan (user, book, ...)
            $table->unsignedBigInteger('target_id'); // ID của đối tượng liên quan
            $table->unsignedBigInteger('uploaded_by')->nullable(); // ID người tải lên
            $table->timestamps();

            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_files');
    }
};
