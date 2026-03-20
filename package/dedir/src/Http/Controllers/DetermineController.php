<?php

namespace Elamacchia\Dedir\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vocabulary;

use Elamacchia\Dedir\Exports\ReportDetermineExport;
use Elamacchia\Dedir\Requests\determineRequest;
use Elamacchia\Dedir\Models\Competenze;
use Elamacchia\Dedir\Models\Determine;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
//
// libreria per l'export in excel
use Maatwebsite\Excel\Facades\Excel;
// libreria per creazione pdf
use Barryvdh\DomPDF\Facade\Pdf;



class DetermineController extends Controller
{
    //
    private $anniRicerca = ['2024','2023','2022','2021','2020','2019','2018','2017','2016','2015','2014','2013','2012','2011','2010','2009'];
    private $nomeEnte, $nomeVocabolario;

    public function __construct(){
        $this->nomeVocabolario = Vocabulary::where('name','Ente')->first();
        $this->nomeEnte = $this->nomeVocabolario->voices->first() ? $this->nomeVocabolario->voices->first()->name : 'Ente utilizzatore DetDir';
//        Session::flash('nomeEnte', $this->nomeEnte);
    }

    public function index(Request $request)
    {
//dd($this->nomeVocabolario, $this->nomeEnte);
        $determine = Determine::orderBy('id', 'DESC')->paginate(config('view.LINE_PER_VIEW', 30));
        $competenze = Competenze::get();

        $tit = 'Determinazioni dirigenziali';
        $vista = ($request->tipoVista == 'elenco' || $request->tipoVista == '') ? 'dedir::admin.DD.dd' : 'dedir::admin.DD.ddCard';
        return view($vista, ['tit'=>$tit,
            'nomeEnte' => $this->nomeEnte,
            'dds' => $determine,
            'competenze' => $competenze,
            'tipoVista' => $request->tipoVista,
            'anniRicerca' => $this->anniRicerca]);
    }

    public function show(Request $request)
    {
       //dd($this->qB2Find($request)[0]);
        $sez = $request->input('ddCompetenza');

        $determine = $this->qB2Find($request)[0]
            ->paginate(config('view.LINE_PER_VIEW', 30))
            ->withQueryString();
        //withQueryString() serve ad allegare la query-string alla paginazione in modo che navigando le pagine
        //non si perdano i criteri di ricerca effettuati

        $competenze = Competenze::get();
        $competenzaText = $sez ? Competenze::find($sez)->competenzaComp : Null;

        $tit = 'Determinazioni dirigenziali';
        $vista = ($request->tipoVista == 'elenco' || $request->tipoVista == '') ? 'dedir::admin.DD.dd' : 'dedir::admin.DD.ddCard';
        return view($vista, [
            'tit'=>$tit,
            'nomeEnte' => $this->nomeEnte,
            'dds' => $determine,
            'competenze' => $competenze,
            'selCompetenza' => $competenzaText,
            'tipoVista' => $request->tipoVista,
            'anniRicerca' => $this->anniRicerca]);
    }

    public function edit($id){
        $determina = Determine::find($id);
        //dd($determina->sezione);
        $competenze = Competenze::where('attivo','=','1')->get(); //stato attivo
//        dd($determina);
        $tit = 'Aggiornamento determinazione';
        return view('dedir::admin.DD.editDD', ['tit'=>$tit,
            'nomeEnte' => $this->nomeEnte,
            'dd' => $determina,
            'competenze' => $competenze]);
    }

    public function create(){
//        dd('Creo');
        $determina = new Determine();  // variabile fittizia per passare il parametro determina al form create
        $annoCorrente =  now()->year;
        $startDate = $annoCorrente.'-01-01';
        $endDate = $annoCorrente.'-12-31';
//        $startDate = '2022-01-01';
//        $endDate = '2022-12-31';
        //dd([$sez, $year]);
        $maxDet = Determine::where('DataDetD','>=',$startDate)->where('DataDetD','<=',$endDate)->get();
        if($maxDet->count()){
            $maxNrProgr = Determine::where('DataDetD','>=',$startDate)->where('DataDetD','<=',$endDate)->get('NrProgr')->max()->NrProgr;
        }else{
            $maxNrProgr = 0;
        }
        $competenze = Competenze::where('attivo','=','1')->get();
        return view('dedir::admin.DD.creaDD',
            ['tit'=>'Creazione determinazione CRP',
             'nomeEnte' => $this->nomeEnte,
             'dd' => $determina,
             'competenze' => $competenze,
             'newProgressivo' => $maxNrProgr+1]);
    }

    public function update($id, determineRequest $request){
        //dd($request);
        $determina = Determine::find($id);
        //$this->authorize('update',$determina);
        $competenzaComp = Competenze::where('id', '=', $request->input('ddCompetenza'))->get();
        if($request->hasFile('ddAllegato')){
            $file = $request->file('ddAllegato');
            //$filename = 'DD-0.'$id . '.' .$file->extension();
            $filename = 'DD-'.$id . '.' .$request->file('ddAllegato')->getClientOriginalName();
            $file->storeAs(env('DD_DIR'), $filename, 'public');
            $pathFile = env('DD_DIR').$filename;
            $determina->nomeFilePDF_1 = $pathFile;
            $determina->nomeFileT_1 = $pathFile ? 'localDocs.'.'DD-'.$id : '';
        }
            $determina->NrDet = $request->input('ddNrDet');
            $determina->DataDetD = $request->input('ddDataDet');
            $determina->NrProgr = $request->input('ddNrProgr');
            $determina->Competenza = $competenzaComp[0]->competenzaComp;
            $determina->Competenza_Id = $request->input('ddCompetenza');
            $determina->Oggetto = $request->input('ddOggetto');
            $determina->PubbDAD = $request->input('ddPubbDA');
            $determina->PubbAD = $request->input('ddPubbA');

            $determina->Impegno = $request->input('ddImpegno');
            $determina->DataImpegnoD = $request->input('ddDataImpegno');
            $determina->Note = $request->input('ddNote');
        $res = $determina->save();
        //$messaggio = $res ? 'Album con id='.$id. ' aggiornato!' : 'Album '.$id.' non aggiornato!!!';
        //session()->flash('messaggio',$messaggio);
        return redirect()->route('editDetermina',[$id]);
    }

    public function save(determineRequest $request){
//        $this->authorize('create',Determine::class);
        $nrLastID = DB::Table('determine')->get('id');
        $id = $nrLastID->max()->id+1;

        $competenzaComp = Competenze::where('id', '=', $request->input('ddCompetenza'))->get();
        if($request->hasFile('ddAllegato')){
            $file = $request->file('ddAllegato');
            //$filename = 'DD-0.'$id . '.' .$file->extension();
            $filename = 'DD-'.$id . '.' .$request->file('ddAllegato')->getClientOriginalName();
            $file->storeAs(env('DD_DIR'), $filename, 'public');
            $pathFile = env('DD_DIR').$filename;
        }else{
            $pathFile = "";
        }

        $res = Determine::insert([
            'NrDet' => $request->input('ddNrDet'),
            'DataDetD' => $request->input('ddDataDet'),
            'NrProgr'=> $request->input('ddNrProgr'),
            'Competenza'=> $competenzaComp[0]->competenzaComp,
            'Competenza_Id'=> $request->input('ddCompetenza'),
            'Oggetto' => $request->input('ddOggetto'),
            'PubbDAD' => $request->input('ddPubbDA'),
            'PubbAD' => $request->input('ddPubbA'),
            'nomeFilePDF_1' => $pathFile,
            'nomeFileT_1' => $pathFile ? 'localDocs.'.'DD-'.$id : '',
            'Impegno' => $request->input('ddImpegno'),
            'DataImpegnoD' => $request->input('ddDataImpegno'),
            'Note' => $request->input('ddNote')
        ]);
        //$messaggio = $res ? 'Album '.$request->input('nomeAlbum').' creato!' : 'Album non creato!!!';
        //session()->flash('messaggio',$messaggio);
        return redirect()->route('determine');

    }

    public function delete($id){
        $determina = Determine::find($id);
        //$detColl = DB::Table('determine')->where('id',$id)->get();
        //$det = Determine::where('id',$id)->get();

        //dd([$determina, $det, $detColl]);
        //$allegato = $determina->NomeFilePDF_1;
        $allDel = $determina->NomeFilePDF_1;
        $res = $determina->forceDelete();
        if ($res && $allDel && Storage::exists($allDel)) {
            $allDel = Storage::delete($allDel);
        }
        return $res;
    }

    public function setData($dataDet, $tipo)
    {
        $mesiAnno = ['gennaio','febbraio','marzo','aprile','maggio','giugno','luglio','agosto','settembre','ottobre','novembre','dicembre'];
        $posSlashMese=strpos($dataDet, '/', 0);
        $posSlashAnno=strpos($dataDet, '/', $posSlashMese+1);
        $distanza=$posSlashAnno-$posSlashMese-1;
        $giorno=substr($dataDet, $posSlashMese+1, $distanza);
        $giornoOK = strlen($giorno) != 2 ? '0'.$giorno : $giorno;
        $mese=substr($dataDet, 0, $posSlashMese);
        $meseOK = strlen($mese) != 2 ? '0'.$mese : $mese;
        $meseLetterale = $mesiAnno[$mese-1];
        $anno=substr($dataDet, $posSlashAnno+1, 2);
        $annoOK = '20'.$anno;
        $dataOK=$giornoOK."/".$meseOK."/".$annoOK;
        $dataLT=$giorno." ".$meseLetterale." ".$annoOK;
        return $tipo == 'LT' ? $dataLT : $dataOK;
    }

    //genera la vista propedeutica alla generazione del file pdf (vd. public function downloadPDF(Request $request))
    public function createReportPDF(Request $request){
        //$sez = $request->input('ddCompetenza');
        //dd($request->getQueryString());
        $determine = $this->qB2Find($request)[0]->get();
//        dd($determine->toArray());
        $tit = 'Determinazioni dirigenziali - Reportistica PDF';
        $vista = 'dedir::admin.DD.report2PDF';
        return view($vista, [
            'tit'=>$tit,
            'nomeEnte' => $this->nomeEnte,
            'dds'=> $determine,
            'req'=> $request->getQueryString()
        ]);
    }

    //genera effettivamente il file pdf
    public function downloadPDF(Request $request) {
        $determine = $this->qB2Find($request)[0]->get();
        $pdf = PDF::loadView('dedir::admin.DD.report2PDF',['dds' => $determine, 'req'=>$request->getQueryString()])
            ->setPaper('a4', 'landscape')
            ->setOptions(['dpi' => 150,'defaultFont' => 'sans-serif']);
        return $pdf->download('reportDetermine.pdf');
    }

//    public function downloadPDF2(Request $request) {
//        $determine = $this->qB2Find($request)[0]->get();
//        view()->share('dds',$determine);
//        $pdf = PDF::loadView('dedir::admin.DD.report2PDF', $determine);
////        $pdf = PDF::loadView('admin.DD.report2PDF',['dds' => $determine, 'req'=>$request->getQueryString()])
////            ->setPaper('a4', 'landscape')
////            ->setOptions(['dpi' => 150,'defaultFont' => 'sans-serif']);
//        return $pdf->download('reportDetermine.pdf');
//    }

    public function qB2Find($request){
        $sez = $request->input('ddCompetenza');
        $oggetto = str_replace('%', '\\%', $request->input('ddOggetto'));
        $nr = $request->input('ddNrDet');
        $year = $request->input('ddAnno');
//        $startDate = DateTime::createFromFormat('j-m-Y', '01-01-'.$year);'';
//        $endDate = DateTime::createFromFormat('j-m-Y', '31-12-'.$year);'';
        $startDate = $year.'-01-01';
        $endDate = $year.'-12-31';
        //dd([$sez, $year]);
        $qbPartial = Determine::orderBy('id', 'DESC');
        if ($sez!=null) $qbPartial = $qbPartial->where('Competenza_Id', '=', $sez);
        if ($year!=null) $qbPartial = $qbPartial->where('DataDetD','>=',$startDate)->where('DataDetD','<=',$endDate);
        if ($oggetto!=null) $qbPartial = $qbPartial->where('Oggetto', 'LIKE', '%'.$oggetto.'%');
        if ($nr!=null) $qbPartial = $qbPartial->where('NrDet', '=', $nr);

        return [$qbPartial, $sez];
    }

//    public function exportToExcel(){
//        return Excel::download(new DetermineExportNotused, 'determine.xlsx');
//    }

    public function exportReportToExcel(Request $request){
        //return (new ReportDetermineExport($request))->download('report-determine.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        return Excel::download(new ReportDetermineExport($request), 'report-determine.xlsx');
    }

//    public function exportToCSV(){
//        return Excel::download(new DetermineExportNotused, 'determineCSV.csv');
//    }

    public function exportReportToCSV(Request $request){
        return Excel::download(new ReportDetermineExport($request), 'determineCSV.csv');
    }

    public function createReportPage(){  //setta i campi per la pagina di reportistica
        $competenze = Competenze::get();
        $tit = 'Determinazioni dirigenziali - Reportistica';
//        dd($tit);
        $vista = 'dedir::admin.DD.report';
        return view($vista, ['tit'=>$tit,
            'nomeEnte' => $this->nomeEnte,
            'competenze' => $competenze,
            'anniRicerca' => $this->anniRicerca
            ]);
    }


}
