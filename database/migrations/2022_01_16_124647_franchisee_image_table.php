<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FranchiseeImageTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('franchisee_image', function (Blueprint $table) {
			$table->id();
			$table->foreignId('franchisee_id')->constrained('franchisee')->onUpdate('cascade')->onDelete('cascade');
			$table->string('franchisee_image')->nullable();
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
		Schema::dropIfExists('franchisee_image');
	}
}
