<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'guard_name',
    ];

    public static $baseRules = array(
        'name' => 'required|string|max:125|min:3|unique:permissions',
        'description' => 'string|max:255|min:3',
    );

    public static $baseMessages = array(
        'name.min'=>'denominazione -> minimo 3 caratteri',
        'name.max'=>'denominazione -> massimo 125 caratteri',
        'name.required'=>'il nome del permesso è un elemento obbligatorio',
        'name.unique'=>'il nome del permesso dev\'essere unico',
        'description.min'=>'descrizione -> minimo 3 caratteri',
        'description.max'=>'descrizione -> massimo 255 caratteri',
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
        $updateRule['name'] = 'required | unique:permissions,name,' . $data['permission_id'];
        $updateMessages = static::$baseMessages;
        return Validator::make($data, $updateRule, $updateMessages);
    }
}
