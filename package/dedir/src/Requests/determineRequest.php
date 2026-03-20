<?php

namespace Elamacchia\Dedir\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class determineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $dataStart = strtotime("31-12-20");
        $dataPubb = strtotime("31-08-21");
        $regole = [
            'ddCompetenza' => ['required', 'numeric'],
            'ddDataDet' => ['bail','required','date','after:31-12-2020'],
            'ddNrProgr' => ['required', 'numeric'],
            'ddNrDet' => ['required', 'numeric'],
            'ddOggetto' => ['required', 'min:10'],
            //'NrDet' => $request->input('ddNrDet'),
            //            'DataDetD' => $request->input('ddDataDet'),
            //            'NrProgr'=> $request->input('ddNrProgr'),
            //            'Competenza'=> $competenzaComp[0]->competenzaComp,
            //            'Competenza_Id'=> $request->input('ddCompetenza'),
            //            'Oggetto' => $request->input('ddOggetto'),
            //            'PubbDAD' => $request->input('ddPubbDA'),
            //            'PubbAD' => $request->input('ddPubbA'),
            //            'nomeFilePDF_1' => $pathFile,
            //            'nomeFileT_1' => $pathFile ? 'localDocs.'.'DD-'.$id : '',
            //            'Impegno' => $request->input('ddImpegno'),
            //            'DataImpegnoD' => $request->input('ddDataImpegno'),
            //            'Note' => $request->input('ddNote')
        ];
        if($request->input('ddImpegno') || $request->input('ddDataImpegno')){
            $regole['ddDataImpegno'] =  ['required','date', 'after:01-01-2021'];
            $regole['ddImpegno'] =  ['required'];
        }
        if($request->input('ddPubbA') || $request->input('ddPubbDA')){
            $regole['ddPubbA'] =  ['required','date', 'after:ddPubbDA'];
            $regole['ddPubbDA'] =  ['required','date', 'after:01-01-2021'];
        }
//        if($request->get('ddDataImpegno')){
//            $regole['ddImpegno'] =  ['required','numeric'];
//        }
        return $regole;
    }

    public function messages()
    {
        return [
            'ddCompetenza.required' => 'La competenza della determina è un dato obbligatorio',
            //'nomeAlbum.unique' => 'Esiste già un album con lo stesso titolo',
            'ddOggetto.required' => 'L\'oggetto della determina è un dato obbligatorio',
            'ddDataDet.required' => 'La data della determina è un dato obbligatorio',
            'ddDataDet.after' => 'La data della determina dev\'essere successiva al 31/12/2020',
            'ddOggetto.min' => 'L\'oggetto della determina dev\'essere lungo almeno 10 caratteri',
            'ddNrProgr.required' => 'Il numero progressivo della determina è un dato obbligatorio',
            'ddNrProgr.numeric' => 'Campo Numero Progressivo: valore inputato non numerico',
            'ddNrDet.required' => 'Il numero della determina è un dato obbligatorio',
            'ddNrDet.numeric' => 'Campo Numero Determinazione: valore inputato non numerico',
            'ddDataImpegno.required' => 'La data dell\'impegno è obbligatoria essendoci il numero dell\'impegno',
            'ddImpegno.required' => 'Il numero dell\'impegno è obbligatorio essendoci la data dell\'impegno',
            'ddPubbA.required' => 'Il periodo di convocazione dev\'essere definito inserendo entrambe le date',
            'ddPubbDA.required' => 'Il periodo di convocazione dev\'essere definito inserendo entrambe le date',
            'ddPubbA.after' => 'La data di fine della pubblicazione dev\'essere successiva a quella d\'inizio',
            'ddPubbDA.after' => 'La data di inizio della pubblicazione dev\'essere successiva al 31/08/2021',
        ];
    }
}
