<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreignId('Classroom_id')->references('id')->on('classroom')->onDelete('cascade');
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            //$table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('created_by');//id منخزن الايميل بدل ماكنا منخزن ال
            $table->string('meeting_id');
            $table->string('topic');//اسم الحصة
            $table->dateTime('start_at');//وقت البدء
            $table->integer('duration')->comment('minutes');//مدة الحصة
            $table->string('password')->comment('meeting password');
            $table->text('start_url');//رابط البدء
            $table->text('join_url');//رابط العوة للحصة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('online_classes');
    }
}
