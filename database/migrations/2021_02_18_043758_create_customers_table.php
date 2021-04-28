<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('last_name', 150);
            $table->string('email');
            $table->string('phone');
            $table->date('birth_date')->nullable();
            $table->integer('sex')->nullable()->comment('1: masculino, 2: femenino, 3: otro');
            $table->string('additional_information')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->timestamps();
        });

        Schema::table('customers', function($table) {
            $table->foreign('country_id')
                    ->references('id')
                    ->on('countrys')
                    ->onDelete('cascade');
            $table->foreign('state_id')
                    ->references('id')
                    ->on('states')
                    ->onDelete('cascade');
            $table->foreign('city_id')
                    ->references('id')
                    ->on('citys')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
