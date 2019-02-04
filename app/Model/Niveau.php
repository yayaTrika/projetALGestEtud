<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    protected $fillable = [
    	'id','codeNiveau','libelleNiveau' 
    ];
}
