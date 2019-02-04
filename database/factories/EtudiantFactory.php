<?php

use Faker\Generator as Faker;
use App\Model\DateNaissance;

$factory->define(App\Model\Etudiant::class, function (Faker $faker) {
    return [
        'matricule'=> $faker->creditCardNumber,
        'nom'=> $faker->lastName,
        'prenom'=> $faker->firstName,
        'tel'=> $faker->regexify('7[6-7]{1}+[0-9]{7}'),
        'email'=> $faker->email,
        // 'idDateNaiss' => $faker->numberBetween(1,20)
        'idDateNaiss' => function(){
            return DateNaissance::all()->random(); 
        }  
    ];
});
