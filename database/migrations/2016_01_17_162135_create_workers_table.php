<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration
{
//        CREATE TABLE `workers` (
//        `registration_number` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
//        `registered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//        `first_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
//        `last_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
//        `father_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
//        `birth_date` date NOT NULL,
//        `id_card` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
//        `phone` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
//        `mobile_phone` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
//        `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
//        `address` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
//        `region` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
//        `city` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
//        `hire_date` date NOT NULL,
//        `insurance_number` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
//        `comment` text COLLATE utf8_unicode_ci NOT NULL,
//        `enterprise_id` int(11) NOT NULL,
//        `specialty_id` int(11) NOT NULL,
//        `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
//        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
//        `deleted_at` timestamp NULL DEFAULT NULL,
//        PRIMARY KEY (`id`)
//        ) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



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
