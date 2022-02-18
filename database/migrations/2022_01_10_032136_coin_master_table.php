<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CoinMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_master', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currency_id')->constrained('currency')->onUpdate('cascade')->onDelete('cascade');
            $table->float('amount', 8, 2)->nullable();
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
        Schema::dropIfExists('coin_master');
    }
}
