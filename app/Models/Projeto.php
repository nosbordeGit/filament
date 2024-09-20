<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $fillable = ['nome', 'descricao', 'status']; // Campos permitidos para mass assignment

    // Definindo o relacionamento "um para muitos"
    public function tarefas()
    {
        return $this->hasMany(Tarefa::class, 'projeto_id'); // Um projeto pode ter muitas tarefas
    }
}


