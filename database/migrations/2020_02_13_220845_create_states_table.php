<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name', 70);
            $table->boolean('status')->default('1');
            $table->unsignedBigInteger('country_id');
            $table->timestamps();
        });
        Schema::table('states', function($table) {
            $table->foreign('country_id')
                    ->references('id')
                    ->on('countrys')
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
        Schema::dropIfExists('state');
    }
}
