<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('modul',20)->nullable()->default('products'); 
            $table->integer('idx')->nullable();
            $table->string('nameStatus',200)->nullable();
            $table->string('activeStatus',20)->nullable()->default(1);                
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
        Schema::dropIfExists('system_statuses');
    }
}
