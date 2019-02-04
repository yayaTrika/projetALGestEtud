<?php

use Faker\Generator as Faker;

$factory->define(App\Model\DateNaissance::class, function (Faker $faker) {
    $mois = array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre"
    ,"Octobre","Novembre","Decembre");
    return [
        'jj' => $faker->numberBetween(1,31),
        "mois" => $faker->randomElement($mois),
        'annee' => $faker->numberBetween(1975, 2015)
    ];
});
