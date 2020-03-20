<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

Class Vendedor extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'name'
	];
}
