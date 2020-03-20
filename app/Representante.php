<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

Class Representante extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'nome'
	];
}
