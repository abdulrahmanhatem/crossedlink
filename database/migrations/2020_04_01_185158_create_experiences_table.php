<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* job_title	company_name	company_website	company_address	company_logo	user_id */
        Schema::create('experiences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_title');
            $table->string('company_name');
            $table->string('company_logo')->nullable();
            $table->string('ref');
            $table->date('from')->nullable();
            $table->date('to');
            $table->Integer('user_id');
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
        Schema::dropIfExists('experiences');
    }
}
