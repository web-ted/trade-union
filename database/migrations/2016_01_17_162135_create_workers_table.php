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
        // Schema::dropIfExists('workers');
        Schema::create('workers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('active');
            $table->integer('registration_number')->unique();
            $table->dateTime('registered_at')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->string('id_card')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->dateTime('hire_date')->nullable();
            $table->string('insurance_number')->nullable();
            $table->text('comment')->nullable();
            $table->integer('enterprise_id')->nullable();
            $table->integer('specialty_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop('workers');
        Schema::dropIfExists('workers');
    }
}
