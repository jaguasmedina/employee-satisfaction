<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'nombre_completo', 
        'fecha', 
        'correo', 
        'area', 
        'categoria', 
        'nivel_de_satisfaccion', 
        'company_id'
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
