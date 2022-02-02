<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('address');
            $table->string('country');
            $table->string('city');
            $table->text('overview')->nullable();
            $table->text('desc')->nullable();
            $table->text('qual')->nullable();
            $table->text('resp')->nullable();
            $table->Integer('min_salary')->nullable();
            $table->Integer('salary')->nullable();
            $table->Integer('max_salary')->nullable();
            $table->tinyInteger('gender')->nullable(); // 1 => male, 2 => female, 3 => other
            $table->tinyInteger('experience')->default(0); // 0 => all, 1 => 1 year, 2 => 2 year
            $table->string('docs')->nullable();
            $table->Integer('category_id')->nullable();
            $table->Integer('employer_id')->nullable();
            $table->tinyInteger('type')->default(0); // 0 => Full Time, 1 => Part Time
            $table->tinyInteger('sponsored')->default(0); // 0 => Not sponsored , 1 => Sponsored
            $table->tinyInteger('state')->default(0); // 0 => Open , 1 => closed
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
        Schema::dropIfExists('jobs');
    }
}
