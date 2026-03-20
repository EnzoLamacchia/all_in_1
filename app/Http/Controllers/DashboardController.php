<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\CarbonInterval;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $nrutenti = User::all()->count();
        $nuoviutenti = User::where('created_at', '>',today())->get()->count();
        $start = substr(shell_exec('uptime -s'),0,-1);
        $inizio = strtotime ($start);
        $ora = strtotime(now());
        $systemup = CarbonInterval::seconds($ora-$inizio)->cascade()->forHumans();
        $uptime = str_replace ( ['days','hours','minutes','seconds'], ['g','h','m','s'], $systemup);
        return view('gestione.index', ['nrutenti'=>$nrutenti, 'nuoviutenti'=>$nuoviutenti, 'uptime'=>$uptime]);
    }

    public function setPerPage($perPage) {
        Session::put('perPage', $perPage);
        return true;
    }
}
