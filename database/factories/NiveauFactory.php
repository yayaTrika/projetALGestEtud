<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Niveau::class, function (Faker $faker) {
    $tab = array('L1','L2','L3','M1','M2');
    $tabDetail = array('L1'=>'Licence 1','L2'=>'Licence 2','L3'=>'Licence 3',
    'M1'=>'Master 1','M2'=>'Master 2');
    $code = $faker->randomElements($array = $tab);
    return [
        'codeNiveau' => $code,
        'libelleNiveau' => $tabDetail[$code] 
    ];
});
