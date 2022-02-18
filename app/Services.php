<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
	use SoftDeletes;
	protected $table = 'services';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];

	public function subServices() {
		return $this->hasMany(SubServices::class);
	}
}
