<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->Integer('price');
            $table->Integer('role'); // 1 => companies, 2 => persons, 3 => Ads Extention, 4 => Profiles Extention
            $table->Integer('profiles')->default(0); // 0 => Profiles To Show
            $table->Integer('sponsored')->default(0); // 0 => Not Sponsored, 1 => Sponsored
            $table->Integer('period')->default(0);
            $table->Integer('ads')->default(0); 
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
        Schema::dropIfExists('packages');
    }
}
