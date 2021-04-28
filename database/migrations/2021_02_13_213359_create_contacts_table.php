<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->comment('1: user, 2: proveedor, 3: cliente');
            $table->string('rfc');
            $table->boolean('type_person')->nullable()->comment('1: fisica, 2: moral');
            $table->string('emails', 500)->nullable();
            $table->string('moviles', 300)->nullable();
            $table->string('phones', 300)->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->timestamps();
        });

        Schema::table('contacts', function($table) {
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
        Schema::dropIfExists('contacts');
    }
}
