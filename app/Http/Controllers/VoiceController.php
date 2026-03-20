<?php

namespace App\Http\Controllers;

use App\Models\Voice;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Vocabulary;
use Illuminate\Support\Collection;


/**
 * Class VocabularyController
 * @package App\Http\Controllers
 */
class VoiceController extends Controller
{

    /**
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
//    private function validator(array $data)   {
//        return Validator::make($data, [
//            'name' => 'required|min:2|max:255|unique:vocabularies,name,' . $data['vocabolario_id'],
//            'description' => 'nullable|min:2|max:255'
//        ]);
//    }

    /**
     * Visualizza la lista delle vocabolari, eventualmente filtrata
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index()   {
        $voci = Voice::all();
        return view('gestione.vocabolario.indexvoci', ['voci'=>$voci]);    }

    /**
     * Mostra il form per la creazione di un nuovo vocabolario
     * @return \Illuminate\Contracts\View\View
     */
    public function create($id) {
        $vocabolario = Vocabulary::find($id);
//        $vociPadre = Voice::where('parent_id', null)->get();
        return view('gestione.vocabolario.newvoice', ['vocabolario'=>$vocabolario]);
    }

    /**
     * Salva il vocabolario nel database dopo aver validato i dati
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)   {
        $validation = Voice::validateOnCreation($request->all())->validate();
        $voice = Voice::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'vocabulary_id'=> $request->input('vocabulary_id'),
            'parent_id'=> $request->input('father_id') ? $request->input('father_id') : null,
        ]);

        if ($voice) session()->flash('messaggio','Salvato!');
//        return view('gestione.vocabolario.editvoice', ['voice'=>$voice]);
        return redirect(route('showvocabolario', ['id'=>$voice['vocabulary_id']]));
    }

    /**
     * Mostra il form per l'aggiornamento
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($idvoice) {
        $voice = Voice::find($idvoice);
//        dd($voice);
//        $vocabolario = Vocabulary::find($voice->vocabulary_id);
        return view('gestione.vocabolario.editvoice', ['voice'=>$voice]);    }

    /**
     * Aggiorna i dati nel DB
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($idvoice, Request $request)  {
        $voice = Voice::find($idvoice);
//        dd($request);
        $validation = Voice::validateOnUpdate($request->all())->validate();
//        dd($validation);
        $voice->name = $request->input('name');
        $voice->description = $request->input('description');
        $voice->parent_id = $request->input('father_id') ? $request->input('father_id') : null;

        $res = $voice->save();
        if ($res) session()->flash('messaggio','Salvato!');
        return redirect(route('showvocabolario', ['id'=>$voice['vocabulary_id']]));
    }

    /**
     * Cancella la riga - chiede conferma prima della cancellazione
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)  {
        $voice = Voice::find($id);
        $res = $voice->forceDelete();
        return $res;
    }

}
