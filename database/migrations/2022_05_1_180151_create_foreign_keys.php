<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classroom', function (Blueprint $table) {
            $table->foreign('grades_id')->references('id')->on('grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('my__parents', function (Blueprint $table) {
            $table->foreign('Nationality_Father_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Father_id')->references('id')->on('bloods');
            $table->foreign('Religion_Father_id')->references('id')->on('religions');
            $table->foreign('Nationality_Mother_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Mother_id')->references('id')->on('bloods');
            $table->foreign('Religion_Mother_id')->references('id')->on('religions');
        });
        //    parent_attachments ///
        Schema::table('parent_attachments', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('my__parents')
            ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_keys');
    }
}
