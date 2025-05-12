<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function btnApropos(){
        //dd(bcrypt('123456'));
       return view('about.apropos', [
            'company' => [
                'name' => 'Sunu-Kalpe',
                'founded' => '2025',
                'mission' => 'Faciliter l’épargne et l’entraide financière grâce aux tontines modernes et sécurisées.',
                'vision' => 'Devenir la référence de la gestion des tontines digitales en Afrique et dans le monde.',
                'values' => ['Confiance', 'Solidarité', 'Transparence', 'Innovation'],
                'team' => [
                    ['name' => 'Aissatou Diagne', 'role' => 'Fondateur & CEO', 'photo' => 'aicha.jpg'],
                    ['name' => 'Amina Diallo', 'role' => 'Directrice financière', 'photo' => 'amina.jpg'],
                    ['name' => 'Mohamed Koné', 'role' => 'Responsable technique', 'photo' => 'mohamed.jpg'],
                ],
                'stats' => [
                    'clients' => 5000,
                    'tontines' => 350,
                    'transactions' => number_format(1000000, 0, ',', ' ') . ' FCFA',

                ]
            ]
        ]);
    }
}
