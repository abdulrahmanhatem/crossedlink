<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('package_id');
            $table->integer('profiles')->default(0);
            $table->integer('ads')->default(0);
            $table->integer('user_id');
            $table->string('role'); // 0 => companies, 1 => persons, 2 => workers
            $table->tinyInteger('state')->default(0); // 0 => Pending, 1 => Started, 2 => Finished, 3 => deactivate
            $table->date('start_date');
            $table->date('expired_date');
            $table->Integer('cobone_id')->nullable();
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
        Schema::dropIfExists('pricing_requests');
    }
}
