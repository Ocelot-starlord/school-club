<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // รหัสนักเรียน (Student ID)
            $table->string('name'); // ชื่อนักเรียน
            $table->string('classroom'); // ห้องเรียน เช่น ม.1/1
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

