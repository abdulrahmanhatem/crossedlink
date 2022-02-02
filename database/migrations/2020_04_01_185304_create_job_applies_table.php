<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_requsets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('worker_id');
            $table->Integer('job_id');
            $table->tinyInteger('state')->default(0); // 0 => open, 1 => Liked, 2 => approved, 3 => rejected 
            $table->tinyInteger('employer_seen')->default(0); // 0 => Unseen, 1 => Seen
            $table->tinyInteger('worker_seen')->default(0); // 0 => Unseen, 1 => Seen
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
        Schema::dropIfExists('job_requsets');
    }
}
