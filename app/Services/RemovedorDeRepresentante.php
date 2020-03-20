<?php
namespace App\Services;

use App\{Representante};
use Illuminate\Support\Facades\DB;

class RemovedorDeRepresentante
{    
    public function removerRepresentante(int $representanteId): string
    {
        $nomeRepresentante = '';
        DB::transaction(function () use ($representanteId, &$nomeRepresentante) {
            $representante = Representante::find($representanteId);
            $nomeRepresentante = $representante->nome;

            $representante->delete();
        });

        return $nomeRepresentante;
    }
}
