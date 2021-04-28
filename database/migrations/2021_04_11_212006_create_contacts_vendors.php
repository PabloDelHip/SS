<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsVendors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts_vendors', function (Blueprint $table) {
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('vendor_id');
        });

        Schema::table('contacts_vendors', function($table) {
            $table->foreign('contact_id')
                    ->references('id')
                    ->on('contacts')
                    ->onDelete('cascade');
            $table->foreign('vendor_id')
                    ->references('id')
                    ->on('vendors')
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
        Schema::dropIfExists('contacts_vendors');
    }
}
