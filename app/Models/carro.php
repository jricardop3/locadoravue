<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carro extends Model
{
    use HasFactory;
    protected $fillable = ['modelo_id','placa','disponivel','km'];
}
