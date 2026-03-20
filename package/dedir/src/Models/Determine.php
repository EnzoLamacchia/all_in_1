<?php

namespace Elamacchia\Dedir\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Determine extends Model
{
    use HasFactory;
    protected $table='determine';

    public function getStorageAttribute(){
        $nomeFile = $this->NomeFilePDF_1;
        $documento = $this->NomeFileT_1;
        //dd($documento);
        $urlStart = 'http://www5.consiglio.puglia.it';
        $urlEnd = '?OpenElement';
        $urlMiddle2 = '/(InLinea)/'.$documento.'/$File/'.$nomeFile;

        $anno = intval(date('Y', strtotime($this->DataDetD)));
        if ($anno <= 2012) {
            $urlMiddle1='/DD/DD2010Archivio.nsf';
        }elseif ($anno <= 2015){
            $urlMiddle1='/DD/DD2010Archivio2.nsf';
        }elseif ($anno <= 2019){
            $urlMiddle1='/DD/DD2010Archivio3.nsf';
        }else{
            $urlMiddle1='/DD/DD2010Archivio4.nsf';
        }

        $url = $urlStart.$urlMiddle1.$urlMiddle2.$urlEnd;

        if (stristr($this->NomeFileT_1, 'localDocs') == true) { //non comincia per http
            //if (!(str_contains($this->album_thumb, 'http'))) { cerca nella stringa
            //ma io voglio verificare se comincia o meno con http, pertanto uso la
            //funzione stristr
            $url = '/storage/'.$nomeFile;
        }
        return $url;
    }

    public function cc(){
        return $this->belongsTo(Competenze::class, 'Competenza_Id', 'id');
    }

    public function getSezioneAttribute(){
        //$sezione = $this->Competenza_Id;
        return $this->cc->competenzaAbbr;
    }

    public static function getDetermine(){
        $records = DB::Table('determine')
            ->select('NrProgr','NrDet','DataDetD','Competenza','Oggetto','Impegno','DataImpegnoD','PubbDAD','PubbAD')
//            ->where('id','<',1000)
            ->get()->toArray();
        return $records;
    }
}
