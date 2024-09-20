<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $fillable = ['titulo', 'descricao', 'status', 'data_entrega', 'projeto_id'];

    // Definindo o relacionamento "muitos para um"
    public function projeto()
    {
        return $this->belongsTo(Projeto::class, 'projeto_id'); // Cada tarefa pertence a um projeto
    }
}

