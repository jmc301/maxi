<?php

namespace App\Services;

use App\Representante;
use Illuminate\Support\Facades\DB;

class CriadorDeRepresentante
{
    public function criarRepresentante(
        string $nomeRepresentante
        ): Representante {
        DB::beginTransaction();
         
        $representante = Representante::create([
            'nome' => $nomeRepresentante,
        ]);
        DB::commit();

        return $representante;
                    
    }
}
