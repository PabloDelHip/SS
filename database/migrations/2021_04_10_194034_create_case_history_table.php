<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases_history', function (Blueprint $table) {
            $table->id();
            $table->longText('information');
            $table->boolean('status')->nullable()->default(true);
            $table->unsignedBigInteger('case_id');
            $table->timestamps();
        });

        Schema::table('cases_history', function($table) {
            $table->foreign('case_id')
                    ->references('id')
                    ->on('cases')
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
        Schema::dropIfExists('cases_history');
    }
}
