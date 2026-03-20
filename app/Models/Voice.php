<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Voice extends Model
{
    protected $table = 'voices';

    protected $fillable = array(
        'name', 'description', 'parent_id','vocabulary_id',
    );

    public function parent() {
        return $this->belongsTo('\App\Models\Voice', 'parent_id');
    }

    public function children() {
        return $this->hasMany('\App\Models\Voice', 'parent_id');
    }

//    public function webcontent() {
//        return $this->morphedByMany('App\Models\Content\Content', 'categorized');
//    }

    public function vocabulary() {
        return $this->belongsTo('\App\Models\Vocabulary', 'vocabulary_id');
    }

    public static $baseRules = array(
//        'name' => 'required|min:2|max:20|unique:voices,vocabulary_id' ,
        'description' => 'nullable|min:6|max:255'
    );

    public static $baseMessages = array(
        'name.min'=>'denominazione vocabolario -> minimo 2 caratteri',
        'name.max'=>'denominazione vocabolario -> massimo 20 caratteri',
        'name.required'=>'la denominazione vocabolario è un elemento obbligatorio',
        'name.unique'=>'nome del vocabolario già presente nei nostri database',
        'description.min' => 'descrizione -> minimo 6 caratteri',
        'description.max' => 'descrizione -> massimo 255 caratteri',
    );

    public static function validateOnCreation($data)
    {
//        dd($data);
        $createRule = static::$baseRules;
//        $createRule['name'] = 'required|min:2|max:20|unique:voices,vocabulary_id,' . $data['vocabulary_id'];
        $createRule['name'] = [
        'required','min:2','max:40',
            Rule::unique('voices')->where(fn ($query) => $query->where('vocabulary_id', $data['vocabulary_id']))
    ];
        $createMessages = static::$baseMessages;
        return Validator::make($data, $createRule, $createMessages);
    }

    public static function validateOnUpdate($data)
    {
//        dd($data);
        $updateRule = static::$baseRules;
//        $updateRule['name'] = ['required','min:2','max:40'];
        $updateRule['name'] = [
            'required','min:2','max:40',
            Rule::unique('voices')->where(fn ($query) =>
            $query->where('vocabulary_id', $data['vocabulary_id'])->where('id','!=',$data['voice_id']))
        ];
        $updateMessages = static::$baseMessages;
//        dd($data, $updateRule);
        return Validator::make($data, $updateRule, $updateMessages);
    }
}
