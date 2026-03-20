<?php

namespace Elamacchia\Dedir\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competenze extends Model
{
    //use HasFactory;
    protected $table='competenze';

    public function determine(){
        return $this->hasMany(Determine::class, 'Competenza_Id', 'id');
    }
}
