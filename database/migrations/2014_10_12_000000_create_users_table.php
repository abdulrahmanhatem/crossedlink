<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function ( $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
			$table->string('email_verify_token')->nullable();
            $table->string('password');
            $table->string('profile_image')->nullable();
            $table->string('phone')->nullable();
            $table->integer('phone_2')->nullable();
			$table->tinyInteger('IsPhoneVerified')->default(0);
            $table->string('website')->nullable();
            $table->Integer('role')->default(0); // 0 => worker, 1 => person, 2 => company, 3 => Admins 
            $table->string('address')->nullable();
            $table->integer('experience')->nullable();
            $table->integer('employers')->nullable();
            $table->text('overview')->nullable();
            $table->text('services')->nullable();
            $table->string('sa')->nullable();
            $table->string('su')->nullable();
            $table->string('mo')->nullable();
            $table->string('tu')->nullable();
            $table->string('we')->nullable();
            $table->string('th')->nullable();
            $table->string('fr')->nullable();
            $table->tinyInteger('package_id')->default(0); // 0 => No Package
            $table->tinyInteger('verified')->default(0); // 0 => Not Verified
            $table->integer('credit')->default(0);
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('company_name')->nullable();
            $table->date('birth')->nullable();
            $table->tinyInteger('gender')->nullable(); // 1 => male, 2 => female, 3 => other
            $table->tinyInteger('married')->nullable(); // 1 => married, 2 => single
            $table->integer('minimum_salary')->nullable();
            $table->integer('average_salary')->nullable();
            $table->string('cv')->nullable();
            $table->tinyInteger('nationality')->nullable();
            $table->integer('maximum_salary')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('school')->nullable();
            $table->text('about')->nullable();
            $table->string('portfolio_images')->nullable();
            $table->string('portfolio_videos')->nullable();
            $table->string('gov_id')->nullable();
            $table->tinyInteger('salary_hide')->default(0); // 0 => Public, 1 => Confidential
            $table->tinyInteger('rating')->nullable(); // From 1 To 5
            $table->string('category_id')->nullable();
            $table->tinyInteger('category_id')->nullable();
            $table->string('lang')->nullable();
            $table->tinyInteger('religion')->nullable();
            $table->string('map_long')->nullable();
            $table->string('map_lat')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
