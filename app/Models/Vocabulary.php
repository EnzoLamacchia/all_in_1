<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Vocabulary extends Model
{
    protected $table = 'vocabularies';

    protected $fillable = ['name', 'description'];

    /**
     * 1-m - restituisce la lista delle voci
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function voices() {
        return $this->hasMany('App\Models\Voice','vocabulary_id');
    }

    /**
     * 1-m - restituisce la lista delle voci
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function voicesnotchildren() {
        $vnc = $this->hasMany('App\Models\Voice','vocabulary_id');
        return $vnc->where('parent_id', null);
    }

    /**
     * m-m rest. la lista dei servizi
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
//    public function services() {
//        return $this->belongsToMany('App\Models\Content\Service','vocabularies_services')
//            ->withPivot('type_order','type_dir','required')
//            ->withTimestamps();
//    }

    public static $baseRules = array(
        'name' => 'required|min:2|max:20|unique:vocabularies' ,
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
        $createRule = static::$baseRules;
        $createMessages = static::$baseMessages;
        return Validator::make($data, $createRule, $createMessages);
    }

    public static function validateOnUpdate($data)
    {
        $updateRule = static::$baseRules;
        unset($updateRule['name']);
        $updateRule['name'] = 'required|min:2|max:20|unique:vocabularies,name,' . $data['vocabolario_id'];
        $updateMessages = static::$baseMessages;
        return Validator::make($data, $updateRule, $updateMessages);
    }

}
