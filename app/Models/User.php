<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'username',
        'email',
        'password',
        'profile_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function stato(){
        return $this->hasOne(UserStatus::class, 'id', 'user_status_id');
    }

    public function getUserStatusAttribute(){
        return $this->hasOne(UserStatus::class, 'id','user_status_id')
            ->get('user_status')->toArray()[0]['user_status'];
    }

    public function getSexAttribute(){
        return $this->hasOne(UserProfile::class, 'user_id','id')
            ->get('sex')->toArray()[0]['sex'];
    }

    public function userprofile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public static $baseRules = array(
        'name' => 'required|string|max:255|min:3',
        'surname' => 'required|string|max:255|min:3',
        'username' => 'required|string|max:255|min:3|unique:users',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required | min:6 | confirmed',
    );

    public static $baseMessages = array(
        'name.min'=>'nome -> minimo 3 caratteri',
        'name.required'=>'il nome è un elemento obbligatorio',
        'surname.min'=>'cognome -> minimo 3 caratteri',
        'surname.required'=>'il cognome è un elemento obbligatorio',
        'username.required'=>'username è un elemento obbligatorio',
        'username.unique'=>'username già presente nei nostri database',
        'email.email'=>'inserire un indirizzo email valido',
        'email.required'=>'l\'indirizzo email è un elemento obbligatorio',
        'email.unique'=>'l\'indirizzo email già presente nei nostri database',
        'password.required' => 'la password è un elemento obbligatorio',
        'password.min' => 'password -> minimo 6 caratteri',
        'password.confirmed' => 'le password digitate non coincidono',
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
        unset($updateRule['password']);
        unset($updateRule['email']);
        unset($updateRule['username']);
        $updateRule['email'] = 'required|email|max:255|unique:users,email,' . $data['user_id'];
        $updateRule['username'] = 'required | unique:users,username,' . $data['user_id'];
        $updateMessages = static::$baseMessages;
        return Validator::make($data, $updateRule, $updateMessages);
    }

    public static function validateOnUpdatePw($data)
    {
        $updatePwRule = static::$baseRules;
        unset($updatePwRule['name']);
        unset($updatePwRule['surname']);
        unset($updatePwRule['email']);
        unset($updatePwRule['username']);
        $updatePwMessages = static::$baseMessages;
        return Validator::make($data, $updatePwRule, $updatePwMessages);
    }

//    public function scopeNotRole(Builder $query, $roles, $guard = 'web'): Builder
//    {
//        if ($roles instanceof Collection) {
//            $roles = $roles->all();
//        }
////dd($roles);
//        if (! is_array($roles)) {
//            $roles = [$roles];
//        }
//
//        $roles = array_map(function ($role) use ($guard) {
//            if ($role instanceof Role) {
//                return $role;
//            }
//
//            $method = is_numeric($role) ? 'findById' : 'findByName';
//            $guard = $guard ?: $this->getDefaultGuardName();
////            $guard = $guard ?: 'web';
//
//            return $this->getRoleClass()->{$method}($role, $guard);
//        }, $roles);
////        dd($roles, $guard);
//        return $query->whereHas('roles', function ($query) use ($roles) {
//            $query->where(function ($query) use ($roles) {
//                foreach ($roles as $role) {
//                    $query->where(config('permission.table_names.roles').'.id', '!=' , $role->id);
//                }
//            });
//        });
//    }
}
