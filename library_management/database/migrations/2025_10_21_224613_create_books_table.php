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
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->string('title'); // Tên sách
            $table->string('author'); // Tác giả
            $table->string('publisher')->nullable(); // Nhà xuất bản (có thể để trống)
            $table->integer('year')->nullable(); // Năm xuất bản
            $table->string('cover_image')->nullable(); // Ảnh bìa (đường dẫn)
            $table->text('description')->nullable(); // Mô tả sách
            $table->timestamps(); // created_at, updated_at
            $table->string('category')->nullable(); // Danh mục: "Giáo trình", "Khóa luận", ...
    $table->unsignedBigInteger('views')->default(0); // Số lượt xem
    $table->unsignedBigInteger('downloads')->default(0); // Số lượt tải

        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
