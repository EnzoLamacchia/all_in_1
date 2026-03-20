<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class DocummaginiController extends Controller
{
    public function __construct()
    {
        Session::put('perPage', 10);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Session::get('perPage') ? Session::get('perPage') : 10;
        $permissions = Permission::orderBy('id', 'ASC')->paginate($perPage);
        return view('gestione.permessi.index', ['permissions' => $permissions]);
    }
}
