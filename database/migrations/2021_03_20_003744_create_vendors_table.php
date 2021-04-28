<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            //categorie_id pivot
            $table->id();
            $table->string('code')->nullable();
            $table->string('name', 120);
            $table->string('business_name', 120)->nullable();
            $table->text('description')->nullable();
            $table->string('web', 50)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('phone', 25)->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->timestamps();
        });

        Schema::table('vendors', function($table) {
            $table->foreign('address_id')
                    ->references('id')
                    ->on('address')
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
        Schema::dropIfExists('vendors');
    }
}
