<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasPermissions;

class Role extends Model
{
    use HasFactory;
    use HasPermissions;


    protected $fillable = [
        'name',
        'description',
        'guard_name',
    ];

    public static $baseRules = array(
        'name' => 'required|string|max:125|min:3|unique:roles',
        'description' => 'string|max:255|min:3',
    );

    public static $baseMessages = array(
        'name.min'=>'denominazione -> minimo 3 caratteri',
        'name.max'=>'denominazione -> massimo 125 caratteri',
        'name.required'=>'il nome del ruolo è un elemento obbligatorio',
        'name.unique'=>'il nome del ruolo dev\'essere unico',
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
        $updateRule['name'] = 'required | unique:roles,name,' . $data['role_id'];
        $updateMessages = static::$baseMessages;
        return Validator::make($data, $updateRule, $updateMessages);
    }
}
