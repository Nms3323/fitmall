<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoinVia extends Model
{
	use SoftDeletes;
	protected $table = 'coin_via';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];
}
