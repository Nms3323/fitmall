<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubServices extends Model
{
	use SoftDeletes;
	protected $table = 'sub_services';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];

	public function getServices() {
		return $this->belongsTo(Services::class);
	}
}
