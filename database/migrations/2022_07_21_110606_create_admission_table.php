<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('fname');
            $table->text('mname')->nullable();
            $table->text('lame');
            $table->bigInteger('phone');
            $table->text('email');
            $table->text('course');
            $table->bigInteger('fees');
            $table->integer('status');
            $table->integer('admission_status');
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('admissions');
    }
}
