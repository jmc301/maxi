<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'produtos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['descricao', 'foto'];

    public function getFotoUrlAttribute() {
        if ($this->foto) {
            return 'http://localhost:8000/storage/' . $this->foto;
        } else {
            return 'http://localhost:8000/storage/produto/sem-imagem.jpg';
        }
    }
    
}
