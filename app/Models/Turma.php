<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;
    protected $visible = ['id', 'classe','descricao', 'periodo', 'anolectivo', 'sala'];

    
    public function matriculas()
{
    return $this->hasMany(Matricula::class, 'turmas_id');
}
}