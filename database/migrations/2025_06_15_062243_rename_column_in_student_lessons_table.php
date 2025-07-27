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
        Schema::table('student_lessons', function (Blueprint $table) {
            $table->renameColumn('lesson_id','midd_lesson_id');
            $table->renameColumn('teacher_id','midd_teacher_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_lessons', function (Blueprint $table) {
            //
        });
    }
};
