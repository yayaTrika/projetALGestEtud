<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\DateNaissance;

class Etudiant extends Model
{
    protected $fillable = [
    	'id','matricule','nom','prenom','tel','email','idDateNaiss' 
    ];

    public function etudiant()
    {
    	return $this->belongsTo(DateNaissance::class);
    }
}
