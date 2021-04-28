<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('last_name', 150)->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->unsignedBigInteger('country_id')->nullable()->change();
            $table->unsignedBigInteger('state_id')->nullable()->change();
            $table->unsignedBigInteger('city_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
}
