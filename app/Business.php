<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;
	protected $table = 'business';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];
}
