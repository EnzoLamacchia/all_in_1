<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
    protected $fillable = [
        'user_id','birthday','phone','mobile_number','address','sex','country_id','city_id',
        'note','cf'
    ];

    protected $table='userprofile';



}

