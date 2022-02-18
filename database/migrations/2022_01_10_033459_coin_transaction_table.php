<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CoinTransactionTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coin_transaction', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('coin_via_id')->constrained('coin_via')->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('currency_id')->constrained('currency')->onUpdate('cascade')->onDelete('cascade');
			$table->float('amount', 8, 2)->nullable();
			$table->bigInteger('total_coin')->nullable();
			$table->bigInteger('credit_coin')->nullable();
			$table->bigInteger('debit_coin')->nullable();
			$table->tinyInteger('trans_status')->comment('0-Credit, 1-Debit')->default('1');
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
		Schema::dropIfExists('coin_transaction');
	}
}
