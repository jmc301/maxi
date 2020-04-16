<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

Class Condpagamento extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'descricao',
		'dias1',
		'dias2',
		'dias3',
		'dias4',
		'dias5',
		'dias6',
		'dias7',
		'dias8',
		'dias9',
		'dias10'
	];
}
