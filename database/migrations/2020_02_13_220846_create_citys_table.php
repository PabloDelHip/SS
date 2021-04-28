<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citys', function (Blueprint $table) {
            $table->id();
            $table->string('city', 100);
            $table->string('lat', 20);
            $table->string('lng', 20);
            $table->boolean('status')->default('1');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->timestamps();
        });

        Schema::table('citys', function($table) {
            $table->foreign('country_id')
                    ->references('id')
                    ->on('countrys')
                    ->onDelete('cascade');
            $table->foreign('state_id')
                    ->references('id')
                    ->on('states')
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
        Schema::dropIfExists('citys');
    }
}
