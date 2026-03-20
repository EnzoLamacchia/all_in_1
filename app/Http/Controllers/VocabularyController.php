<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Vocabulary;
use Illuminate\Support\Collection;


/**
 * Class VocabularyController
 * @package App\Http\Controllers
 */
class VocabularyController extends Controller
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
        $vocabolari = Vocabulary::all();
        return view('gestione.vocabolario.index', ['vocabolari'=>$vocabolari]);    }


    /**
     * Visualizza i dettagli di un vocabolario
     */
    public function show($id)   {
        $vocabolario = Vocabulary::find($id);
        return view('gestione.vocabolario.showvocabolario', ['vocabolario'=>$vocabolario]);    }


    /**
     * Mostra il form per la creazione di un nuovo vocabolario
     * @return \Illuminate\Contracts\View\View
     */
    public function create() {
        return view('gestione.vocabolario.newvocabolario');
    }

    /**
     * Salva il vocabolario nel database dopo aver validato i dati
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)   {
//        $data = $request->all();
        $validation = Vocabulary::validateOnCreation($request->all())->validate();
//        $this->validator($data)->validate();
        $vocabolario = Vocabulary::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        if ($vocabolario) session()->flash('messaggio','Salvato!');
//        return view('gestione.vocabolario.editvocabolario', ['vocabolario'=>$vocabolario]);
        return redirect(route('editvocabolario',['id'=>$vocabolario->id]));
//        $vocabulary = $this->rp->create($data);
//        $this->insertParamService($data,$vocabulary);
//        return redirect('admin/vocabularies')->withSuccess('Vocabolario creato correttamente.');
    }

    /**
     * Mostra il form per l'aggiornamento
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id) {
        $vocabolario = Vocabulary::find($id);
        return view('gestione.vocabolario.editvocabolario', ['vocabolario'=>$vocabolario]);    }

    /**
     * Aggiorna i dati nel DB
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($id, Request $request)  {
        $vocabolario = Vocabulary::find($id);
        $validation = Vocabulary::validateOnUpdate($request->all())->validate();
        $vocabolario->name = $request->input('name');
        $vocabolario->description = $request->input('description');

        $res = $vocabolario->save();
        if ($res) session()->flash('messaggio','Salvato!');
//        return view('gestione.vocabolario.editvocabolario', ['vocabolario'=>$vocabolario]);
        return redirect(route('editvocabolario',['id'=>$id]));
    }

    /**
     * Cancella la riga - chiede conferma prima della cancellazione
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)  {
        $vocabolario = Vocabulary::find($id);
        $res = $vocabolario->forceDelete();
        return $res;
    }

}
