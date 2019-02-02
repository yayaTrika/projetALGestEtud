<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DateNaissance extends Model
{
    protected $fillable = [
    	'id','jj','mois','annee'
    ];
}
