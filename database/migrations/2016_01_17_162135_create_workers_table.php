<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('workers');
        Schema::create('workers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('active');
            $table->string('registration_number');
            $table->date('registered_at');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->date('birth_date');
            $table->string('id_card');
            $table->string('phone');
            $table->string('mobile_phone');
            $table->string('email');
            $table->string('address');
            $table->string('region');
            $table->string('city');
            $table->date('hire_date');
            $table->string('insurance_number');
            $table->text('comment');
            $table->integer('enterprise_id');
            $table->integer('specialty_id');
            $table->softDeletes();
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
        Schema::drop('workers');
    }
}
