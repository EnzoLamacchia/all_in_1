<?php

namespace Elamacchia\Dedir\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vocabulary;
use Elamacchia\Dedir\Models\Competenze;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompetenzeController extends Controller
{
    private $nomeEnte, $nomeVocabolario;

    public function __construct(){
    $this->nomeVocabolario = Vocabulary::where('name','Ente')->first();
    $this->nomeEnte = $this->nomeVocabolario->voices->first() ? $this->nomeVocabolario->voices->first()->name : 'Ente utilizzatore DetDir';
//    Session::put('nomeEnte', $this->nomeEnte);
}

    public function index2()
    {
        //
        return view('dedir::index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $competenze = Competenze::orderBy('ID', 'DESC')->paginate(config('view.LINE_PER_VIEW', 15));
        $tit = 'Sezioni/Servizi del Consiglio';
//        dd($tit, $competenze);
        return view('dedir::admin.competenze.competenze', [
            'tit'=>$tit,
            'nomeEnte' => $this->nomeEnte,
            'competenze' => $competenze]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $competenza = new Competenze();  // variabile fittizia per passare il parametro determina al form create
        //dd($competenza);
        return view('dedir::admin.competenze.creaCompetenze',['tit'=>'Creazione nuova Sezione/Servizio di competenza', 'dd' => $competenza]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $res = Competenze::insert([
            'competenzaComp' => $request->input('ddCompetenza'),
            'competenzaAbbr' => $request->input('ddCompetenzaAbbr'),
            'attivo'=> ($request->input('ddAttivo') == 1) ? $request->input('ddAttivo'): 0,
        ]);
        //$messaggio = $res ? 'Album '.$request->input('nomeAlbum').' creato!' : 'Album non creato!!!';
        //session()->flash('messaggio',$messaggio);
        return redirect()->route('competenze');

    }

    /**
     * Display the specified resource.
     *
     * @param  Elamacchia\Dedir\Models\Competenze  $competenze
     * @return \Illuminate\Http\Response
     */
    public function show(Competenze $competenze)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Elamacchia\Dedir\Models\Competenze  $competenze
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $competenze = Competenze::find($id);
//        dd($competenze);
        $tit = 'Aggiornamento competenza';
        return view('dedir::admin.competenze.editCompetenze', [
            'tit'=>$tit,
            'nomeEnte' => $this->nomeEnte,
            'dd' => $competenze]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Elamacchia\Dedir\Models\Competenze  $competenze
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $competenze = Competenze::find($id);
        //dd($competenze, $request);
        $competenze->competenzaComp = $request->input('ddCompetenza');
        $competenze->competenzaAbbr = $request->input('ddCompetenzaAbbr');
        $competenze->attivo = ($request->input('ddAttivo') == 1) ? $request->input('ddAttivo') : 0;
        $res = $competenze->save();
        $messaggio = $res ? 'Competenza aggiornata!' : 'Competenza non aggiornata!!!';
        session()->flash('messaggio',$messaggio);
        return redirect()->route('editCompetenza',$competenze->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Elamacchia\Dedir\Models\Competenze  $competenze
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //dd($competenze);
        $competenze = Competenze::find($id);
        $res = $competenze->forceDelete();
        return $res;
    }
}
