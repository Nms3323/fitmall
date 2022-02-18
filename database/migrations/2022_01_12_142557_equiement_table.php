<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EquiementTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equiement', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('business_id')->constrained('business')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('sub_serv_id')->constrained('sub_services')->onUpdate('cascade')->onDelete('cascade');
			$table->string('equ_name')->nullable();
			$table->text('equ_description')->nullable();
			$table->float('equ_cost', 8, 2);
			$table->text('equ_website')->nullable();
			$table->bigInteger('equ_total_likes')->nullable();
			$table->bigInteger('equ_total_lead')->nullable();
			$table->bigInteger('equ_total_reported')->nullable();
			$table->bigInteger('equ_total_favorite')->nullable();
			$table->bigInteger('equ_total_followers')->nullable();
			$table->tinyInteger('equ_boost_option')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('equ_inquiry_button')->comment('0-Not Available, 1-Available')->default('1');
			$table->tinyInteger('equ_is_published')->comment('0-Not Published, 1-Published')->default('1');
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
		Schema::dropIfExists('equiement');
	}
}
