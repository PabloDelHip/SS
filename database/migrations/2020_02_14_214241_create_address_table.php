<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('postal_code', 20)->nullable();
            $table->text('street')->nullable();
            $table->text('street_one')->nullable();
            $table->text('street_two')->nullable();
            $table->text('references')->nullable();
            $table->text('suburb')->nullable();
            $table->string('interior_num', 20);
            $table->string('exterior_num', 20);
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->timestamps();
        });
        
        Schema::table('address', function($table) {
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
        Schema::dropIfExists('address');
    }
}
