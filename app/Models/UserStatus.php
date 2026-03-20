<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;

    protected $fillable = ['user_status', 'description'];

    public $table = 'stato_utente';

    // verificare il funzionamento...
    public function getUsers(){
        return $this->belongsTo(User::class, 'user_status_id','id')
            ->get();
    }
}
