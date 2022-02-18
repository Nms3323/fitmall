<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoinMaster extends Model
{
	use SoftDeletes;
	protected $table = 'coin_master';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];
}
