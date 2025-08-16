<?php

namespace App\Services;

use App\Models\Nota;
use Carbon\Carbon;

class AnuncioNotaService
{
    public function store_nota_anuncio($anuncioId, $titulo, $texto)
    {
        $nota = Nota::create([
            'anuncio_id' => $anuncioId,
            'titulo' => $titulo,
            'nota' => $texto,
        ]);

        return $nota;
    }
}