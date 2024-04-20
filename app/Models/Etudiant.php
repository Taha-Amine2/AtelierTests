<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'adresse', 'niveau'];

    protected $primaryKey = 'id'; 

    protected $table = 'etudiants'; 

    public $timestamps = true;
}
