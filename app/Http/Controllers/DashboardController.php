<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Fonds;
use Illuminate\Http\Request;
use App\Models\Tontine;
use App\Models\Tirage;
class DashboardController extends Controller
{

public function index()
{
    $nombreParticipants = Participant::count();
    //$montantTotalFonds = Fonds::sum('montant');
    $nombreTontinesActives = Tontine::where('dateFin', '>=', now())->count();
    $nombreTirages = Tirage::count();
//'montantTotalFonds',
    // Pour le graphique
    $participantsParTontine = Tontine::withCount('participants')->get();

    return view('dashboard/dashboard', compact(
        'nombreParticipants',

        'nombreTontinesActives',
        'nombreTirages',
        'participantsParTontine'
    ));
}



}
