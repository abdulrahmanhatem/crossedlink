<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCobonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->tinyInteger('percentage');
            $table->tinyInteger('state')->default(0);
            $table->Integer('user-id');
            $table->Integer('package-id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cobones');
    }
}
