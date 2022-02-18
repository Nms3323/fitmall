<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('parent_id')->nullable();
			$table->string('name')->nullable();
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password')->nullable();
			$table->string('phone_no')->nullable();
			$table->foreignId('city_id')->constrained('city')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('state_id')->constrained('state')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('country_id')->constrained('country')->onUpdate('cascade')->onDelete('cascade');
			$table->date('date_of_birth')->nullable();
			$table->string('profile')->unique();
			$table->rememberToken();
			$table->tinyInteger('is_block')->comment('0-Block, 1-Unblock')->default('1');
			$table->tinyInteger('user_type')->comment('0-Backend User, 1-Front User')->default('1');
			$table->tinyInteger('active')->comment('0-Inactive, 1-Active')->default('1');
			$table->timestamps();
			$table->softDeletes()->nullable();
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
