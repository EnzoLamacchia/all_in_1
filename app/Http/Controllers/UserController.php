<?php

namespace App\Http\Controllers;

use App\Models\Data\City;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct() {
        Session::put('perPage', 10);
    }

    public function index()
    {
        //
        $this->perPage = Session::get('perPage') ? Session::get('perPage') : 10;
        $users = User::orderBy('id', 'ASC')->paginate($this->perPage);

        return view('gestione.utenti.index', ['users' => $users, 'ph' => '']);
    }

    /**
     * Show the list after filtering.
     *
     */
    public function show(Request $request)
    {
//        dd($request);
//        dd($this->qB2Find($request));
        $placeholder = $request->input('searchkey');
//        dd($placeholder);
        $this->perPage = Session::get('perPage') ? Session::get('perPage') : 10;
        $users = $this->qB2Find($request)
            ->paginate($this->perPage)
            ->withQueryString();
        //withQueryString() serve ad allegare la query-string alla paginazione in modo che navigando le pagine
        //non si perdano i criteri di ricerca effettuati

        return view('gestione.utenti.index', ['users' => $users, 'ph' => $placeholder]);
    }

    public function qB2Find($request){
//        $sez = $request->input('ddCompetenza');
//        $oggetto = str_replace('%', '\\%', $request->input('ddOggetto'));
//        $nr = $request->input('ddNrDet');
        $key = $request->input('searchkey');
        //        dd([$sez, $year]);
        $qbPartial = User::orderBy('id', 'ASC')
            ->orwhere('name', 'LIKE', '%'.$key.'%')
            ->orwhere('surname', 'LIKE', '%'.$key.'%')
            ->orwhere('username', 'LIKE', '%'.$key.'%')
            ->orwhere('email', 'LIKE', '%'.$key.'%');
        return $qbPartial;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        return view('gestione.utenti.newuser', ['users' => $users]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->validationStep($request);
        $validation = User::validateOnCreation($request->all())->validate();
        $nuovoProfiloutenteID = ++ UserProfile::all()->max()->id ;  //somma 1 al massimo degli id della tabella UserProfile

        $user = new User;
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->email_verified_at = now();
        $user->profile_id = $nuovoProfiloutenteID;
        $user->save();

        $this->creaProfilo($user->id);
        $user=User::find($user->id); //ripesco tutti i parametri dell'oggetto $user
        $stati = UserStatus::all(); //ripesco tutti gli stati possibili

//        return view('gestione.utenti.edituser', ['user'=>$user, 'stati'=>$stati]);
        return redirect(route('editutente', ['id'=>$user['id']]));
//        return redirect('/gestione/utenti');
    }

    /* Creo profilo dell'utente
    */
    public function creaProfilo($id)
    {
        $profiloutente = new UserProfile();
        $profiloutente->user_id = $id;
        $profiloutente->country_id = '110';
        $profiloutente->save();
    }

    /**
     * Mostra il form per la modifica della pw utente nell'interfaccia di gestione
     */
    public function editpw($id)
    {
        $user = User::find($id);
        return view('gestione.utenti.editpw', ['user'=>$user]);
    }

    /**
     * Modifica della pw utente nell'interfaccia di gestione
     */
    public function updatepw(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $validation = User::validateOnUpdatePw($request->all())->validate();

        $user->password = Hash::make($request->input('password'));
        $res = $user->save();
        if ($res) session()->flash('messaggio','Salvato!');
//        return view('gestione.utenti.editpw', ['user'=>$user]);
        return redirect(route('editapassword', ['id'=>$user['id']]));
    }

    /* Attiva/disattiva utente
    */
    public function onoffutente($id)
    {
        $disattivazione = UserStatus::where('user_status','=','disattivo')->get('id');
        $attivazione = UserStatus::where('user_status','=','attivo')->get('id');
        $user=User::find($id);
        $user->user_status_id = ($user->user_status_id == $attivazione[0]->id) ? $disattivazione[0]->id : $attivazione[0]->id;
        $res = $user->save();
        return $res;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $stati = UserStatus::all(); //stato attivo
        return view('gestione.utenti.edituser', ['user'=>$user, 'stati' => $stati]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->input('user_id'));
//        $this->validationStep2($request);
        $validation = User::validateOnUpdate($request->all())->validate();
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->user_status_id = $request->input('user_status');

        $res = $user->save();
        if ($res) session()->flash('messaggio','Salvato!');
        $stati = UserStatus::all();

//        return view('gestione.utenti.edituser', ['user'=>$user, 'stati' => $stati]);
        return redirect(route('editutente', ['id'=>$user['id']]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $res = $user->forceDelete();
        return $res;
    }

    public function editruoli($id)
    {
        $user = User::find($id);
        $userrolesname = $user->getRoleNames();
        $userroles = $user->roles->paginate(Session::get('perPage'),null,null,'uYes'); //pagino la collection (vd. AppServiceProvider)
        $arrRuoliUtente = $userrolesname->toArray();
        $ruoli = Role::whereNotIn('name', $arrRuoliUtente)->get()->paginate(Session::get('perPage'),null,null,'uNo');
        return view('gestione.utenti.editruoliutente', ['user'=>$user, 'ruoli' => $ruoli, 'useroles' => $userroles]);
    }

    public function setruolo($id, $rid) // assegna ruolo all'utente
    {
        $user = User::find($id);
        $role2assign = Role::find($rid)->name;
        $res = $user->assignRole($role2assign);
//        $userrolesname = $user->getRoleNames();
//        $userroles = $user->roles;
//        $arrRuoliUtente = $userrolesname->toArray();
//        $ruoli = Role::whereNotIn('name', $arrRuoliUtente)->get();
//        return view('gestione.utenti.editruoliutente', ['user'=>$user, 'ruoli' => $ruoli, 'useroles' => $userroles]);
        return $res;
    }

    public function delruolo($id, $rid)  // rimuove ruolo dall'utente
    {
        $user = User::find($id);
        $role2assign = Role::find($rid)->name;
        $res = $user->removeRole($role2assign);
//        $userrolesname = $user->getRoleNames();
//        $userroles = $user->roles;
//        $arrRuoliUtente = $userrolesname->toArray();
//        $ruoli = Role::whereNotIn('name', $arrRuoliUtente)->get();
//        return view('gestione.utenti.editruoliutente', ['user'=>$user, 'ruoli' => $ruoli, 'useroles' => $userroles]);
        return $res;
    }

    public function editpermessi($id)
    {
        $user = User::find($id);
        $allPermissions = Permission::get();
        $allUserPermissions = $user->getAllPermissions();
        $availablePermissions = $allPermissions->diff($allUserPermissions);
        $paginatedAvailablePermissions = $availablePermissions->paginate(Session::get('perPage'),null,null,'uNo');

        $userDirectPermissions = $user->getDirectPermissions();
        $paginatedUserDirectPermissions = $userDirectPermissions->paginate(Session::get('perPage'),null,null,'uYes');

        $permissionsViaRole = $user->getPermissionsViaRoles();
        $userrolesname = $user->getRoleNames();
        $userRoles = $user->roles;
        if ($userRoles->count() > 0){
            foreach ($userRoles as $userRole) {
                $userRolesComplete [] = [
                    'id'=> $userRole['id'],
                    'name'=> $userRole['name'],
                    'permViaRole'=> $userRole->permissions,
                ];
        }
        }else {
            $userRolesComplete = [];
        };

//        dd($permissionsViaRole, $userrolesname, $userRolesComplete);
        return view('gestione.utenti.editpermessiutente', ['user'=>$user,
            'permessiNO' => $paginatedAvailablePermissions,
            'permessiSI' => $paginatedUserDirectPermissions,
            'userRoles' => $userRolesComplete]);
    }

    public function setpermesso($id, $rid) // assegna permesso all'utente
    {
        $user = User::find($id);
        $perm2assign = Permission::find($rid)->name;
//        dd($perm2assign);
        $res = $user->givePermissionTo($perm2assign);
        return $res;
    }

    public function delpermesso($id, $rid)  // rimuove permesso dall'utente
    {
        $user = User::find($id);
        $perm2assign = Permission::find($rid)->name;
        $res = $user->revokePermissionTo($perm2assign);
        return $res;
    }

//    public function validationStep ($request, $user = null)
//    {
//        Validator::make($request->all(), [
//            'name' => ['required', 'string', 'max:255', 'min:3'],
//            'surname' => ['required', 'string', 'max:255', 'min:3'],
////            'username' => $user ? ['required', 'string', 'max:255', 'min:3', Rule::unique('users')->ignore($user->id)] :
////                ['required', 'string', 'max:255', 'min:3', Rule::unique('users')],
//            'username' => ['required', 'string', 'max:255', 'min:3', Rule::unique('users')->ignore($request->input('user_id'))],
////            'email' => $user ? ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)] :
////                ['required', 'email', 'max:255', Rule::unique('users')],
//            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($request->input('user_id'))],
//            'password' => 'required | min:6 | confirmed',
////            'stato' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
//        ],['name.min'=>'nome -> minimo 3 caratteri',
//            'name.required'=>'il nome è un elemento obbligatorio',
//            'surname.min'=>'cognome -> minimo 3 caratteri',
//            'surname.required'=>'il cognome è un elemento obbligatorio',
//            'username.required'=>'username è un elemento obbligatorio',
//            'username.unique'=>'username già presente nei nostri database',
//            'email.email'=>'inserire un indirizzo email valido',
//            'email.required'=>'l\'indirizzo email è un elemento obbligatorio',
//            'email.unique'=>'l\'indirizzo email già presente nei nostri database',
//            'password.required' => 'la password è un elemento obbligatorio',
//            'password.min' => 'password -> minimo 6 caratteri',
//            'password.confirmed' => 'le password digitate non coincidono',
//        ])->validate();
//    }



}
