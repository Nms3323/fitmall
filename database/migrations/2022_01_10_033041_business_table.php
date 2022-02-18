<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BusinessTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('network_id')->nullable();
			$table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
			$table->string('brand_name')->nullable();
			$table->string('legal_name')->nullable();
			$table->string('slug')->nullable();
			$table->string('brand_logo')->nullable();
			$table->date('incorporation_dt')->nullable();
			$table->text('web_site')->nullable();
			$table->foreignId('currency_id')->constrained('currency')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('country_id')->constrained('country')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('state_id')->constrained('state')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('city_id')->constrained('city')->onUpdate('cascade')->onDelete('cascade');
			$table->tinyInteger('terms_condition')->comment('0-Not Checked, 1-Checked')->default('1');
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
		Schema::dropIfExists('business');
	}
}
