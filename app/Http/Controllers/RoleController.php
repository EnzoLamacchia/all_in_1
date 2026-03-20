<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
//use Spatie\Permission\Traits\Role;


class RoleController extends Controller
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
        $perPage = Session::get('perPage') ? Session::get('perPage') : 10;
        $roles = Role::orderBy('id', 'ASC')->paginate($perPage);
        return view('gestione.ruoli.index', ['roles' => $roles]);
    }

    /**
     * Show the list after filtering.
     *
     */
    public function show(Request $request)
    {
        $perPage = Session::get('perPage') ? Session::get('perPage') : 10;
        $roles = $this->qB2Find($request)
            ->paginate($perPage)
            ->withQueryString();
        //withQueryString() serve ad allegare la query-string alla paginazione in modo che navigando le pagine
        //non si perdano i criteri di ricerca effettuati

        return view('gestione.ruoli.index', ['roles' => $roles]);
    }

    public function qB2Find($request){
        $key = $request->input('searchkey');
        //        dd([$sez, $year]);
        $qbPartial = Role::orderBy('id', 'ASC')
            ->orwhere('name', 'LIKE', '%'.$key.'%')
            ->orwhere('description', 'LIKE', '%'.$key.'%');
        return $qbPartial;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
//        $roles = Role::get();
        return view('gestione.ruoli.newrole');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Role::validateOnCreation($request->all())->validate();
        $ruolo = Role::create([
            'name' => $request->input('name'),
            'guard_name'=> "web",
            'description'=> $request->input('description'),
            ]);
//        return view('gestione.ruoli.editrole', ['ruolo'=>$ruolo]);
        return redirect(route('editruolo', ['id'=>$ruolo['id']]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $ruolo = Role::find($id);
        return view('gestione.ruoli.editrole', ['ruolo'=>$ruolo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Role::validateOnUpdate($request->all())->validate();
        $ruolo = Role::find($id);
        $ruolo->name = $request->input('name');
        $ruolo->guard_name = "web";
        $ruolo->description = $request->input('description');

        $res = $ruolo->save();
        if ($res) session()->flash('messaggio','Salvato!');
//        return view('gestione.ruoli.editrole', ['ruolo'=>$ruolo]);
        return redirect(route('editruolo', ['id'=>$ruolo['id']]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $ruolo = Role::find($id);
        $res = $ruolo->forceDelete();
        return $res;
    }

    public function users2Role($id)
    {
        $actualRole = Role::find($id);
        $all_user = User::get();
        //cerco gli utenti aventi il ruolo selezionato ($actualRole)
        $all_users_with_actualRole = User::role($actualRole->name)->get(); //pagino la collection (vd. AppServiceProvider)
        //adesso colleziono gli utenti che non hanno $actualRole come differenza da $all_user
        $all_users_without_actualRole = $all_user->diff($all_users_with_actualRole);

        $paginate_users_without_actualRole = $all_users_without_actualRole->paginate(Session::get('perPage'),null,null,'uNo');
        $paginate_users_with_actualRole = $all_users_with_actualRole->paginate(Session::get('perPage'),null,null,'uYes');

        return view('gestione.ruoli.user2role', ['ruolo'=>$actualRole, 'usersWithoutActualRole' => $paginate_users_without_actualRole, 'usersWithActualRole' => $paginate_users_with_actualRole]);
    }

    public function users2RoleOLD($id)
    {
        $actualRole = Role::find($id);
        //cerco gli utenti aventi il ruolo selezionato ($actualRole)
        $all_users_with_actualRole = User::role($actualRole->name)->get()->paginate(Session::get('perPage'),null,null,'uYes'); //pagino la collection (vd. AppServiceProvider)
        //adesso colleziono gli utenti che non hanno $actualRole (non mi rileva gli utenti senza alcun ruolo):
        $all_users_without_actualRole = User::notRole($actualRole->name)->get();
        //tuttavia l'istruzione precedente non funziona benissimo nel senso che mi restituisce tutti gli utenti che hanno
        //altri ruoli diversi da $actualrole, pertanto per ottente ciò che voglio devo sottrarre a questa collection
        //  (tramite: ->diff) gli utenti aventi $actualrole
        $all_users_without_actualRole = $all_users_without_actualRole->diff($all_users_with_actualRole);
        //cerco ora gli utenti senza alcun ruolo:
        $users_without_any_roles = User::doesntHave('roles')->get(); //utenti senza alcun ruolo
        //e li unisco a quelli che non hanno l'$actualrole'
        $users_without = $users_without_any_roles->merge($all_users_without_actualRole)->sort()->paginate(Session::get('perPage'),null,null,'uNo'); //unione collection e pagino la collection (vd. AppServiceProvider)
//        $users = User::notRole(['Admin', 'Super Admin'])->get();
        return view('gestione.ruoli.user2role', ['ruolo'=>$actualRole, 'usersWithoutActualRole' => $users_without, 'usersWithActualRole' => $all_users_with_actualRole]);
    }

    public function setUser2Role($rid, $uid) // assegna l'utente al ruolo
    {
        $user = User::find($uid);
        $role2assign = Role::find($rid)->name;
        $res = $user->assignRole($role2assign);
        return $res;
    }

    public function delUserFromRole($rid, $uid)  // rimuove l'utente dal ruolo
    {
        $user = User::find($uid);
        $role2revoke = Role::find($rid)->name;
        $res = $user->removeRole($role2revoke);
        return $res;
    }

    public function permissions2Role($id)
    {
        $actualRole = Role::find($id);
        $all_Permission = Permission::get();
        //cerco i permessi assegnati al ruolo selezionato ($actualRole)
        $all_permissions_assigned2_actualRole = $actualRole->permissions ? $actualRole->permissions : collect([]);
//        dd($all_Permission, $actualRole, $all_permissions_assigned2_actualRole);
        $paginate_permissions_assigned2_actualRole = $actualRole->permissions ? $all_permissions_assigned2_actualRole->paginate(Session::get('perPage'),null,null,'uYes') : collect([])->paginate(Session::get('perPage'),null,null,'uYes'); //pagino la collection (vd. AppServiceProvider)

        //adesso colleziono i permessi nonn assegnati a $actualRole (non mi rileva gli utenti senza alcun ruolo):
        $all_permissions_NOTassigned2_actualRole = $all_Permission->diff($all_permissions_assigned2_actualRole)->sort()->paginate(Session::get('perPage'),null,null,'uNo');
//        dd($all_Permission, $all_permissions_NOTassigned2_actualRole);
        return view('gestione.ruoli.permission2role',
            ['ruolo'=>$actualRole,
                'permissionNOTAssigned2ActualRole' => $all_permissions_NOTassigned2_actualRole,
                'permissionAssigned2ActualRole' => $paginate_permissions_assigned2_actualRole
            ]);
    }

    public function setPermission2Role($rid, $uid) // assegna il permesso al ruolo
    {
        $permission = Permission::find($uid)->name;
        $role2assign = Role::find($rid);
//        dd($permission, $role2assign);
        $id = DB::table('role_has_permissions')->insertGetId(['permission_id' => $uid, 'role_id' => $rid]);
        $res = $role2assign->givePermissionTo($permission);
//        dd(res);
        return $res;
    }

    public function delPermissionFromRole($rid, $uid)  // rimuove il permesso dal ruolo
    {
        $permission = Permission::find($uid)->name;
        $role2revoke = Role::find($rid);
        $res = $role2revoke->revokePermissionTo($permission);
        $id = DB::table('role_has_permissions')
            ->where('permission_id',$uid)
            ->where('role_id',$rid)
            ->delete();
        return $res;
    }

}
