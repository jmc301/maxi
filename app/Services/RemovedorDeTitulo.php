<?php
namespace App\Services;

use App\{Titulo};
use Illuminate\Support\Facades\DB;

class RemovedorDeTitulo
{    
    public function removerTitulo(int $tituloId): string
    {
        $nomeTitulo = '';
        DB::transaction(function () use ($tituloId, &$nomeTitulo) {
            $titulo = Titulo::find($tituloId);
            $nomeTitulo = $titulo->titulo;

            $titulo->delete();
        });

        return $nomeTitulo;
    }
}
