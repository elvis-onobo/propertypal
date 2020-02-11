<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('phone');
            $table->string('type');
            $table->string('location');
            $table->string('state');
            $table->string('price');
            $table->string('rentorsale');
            $table->string('water');
            $table->string('light');
            $table->string('security');
            $table->string('road');
            $table->text('additional_info');
            $table->string('picture');
            $table->string('pid');
            $table->string('availability');
            $table->string('slugline');
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
        Schema::dropIfExists('uploads');
    }
}
