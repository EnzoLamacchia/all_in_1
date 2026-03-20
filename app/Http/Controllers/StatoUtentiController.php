<?php

namespace App\Http\Controllers;

use App\Models\UserStatus;
use Illuminate\Http\Request;

class StatoUtentiController extends Controller
{
    public function index()
    {
        $stati = UserStatus::all();
        return view('gestione.stati.index', ['stati'=>$stati]);
    }

    public function create()
    {
        return view('gestione.stati.newstato');
    }

    public function store(Request $request)
    {
//        $validation = Role::validateOnCreation($request->all())->validate();
//        dd($request);
        $stato = UserStatus::create([
            'user_status' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
//        return view('gestione.stati.editstato', ['stato'=>$stato]);
        return redirect(route('editstato', ['id'=>$stato['id']]));
    }

    public function edit($id)
    {
        $stato = UserStatus::find($id);
        return view('gestione.stati.editstato', ['stato'=>$stato]);
    }

    public function update(Request $request, $id)
    {
//        $validation = Role::validateOnUpdate($request->all())->validate();
        $stato = UserStatus::find($id);
        $stato->user_status = $request->input('name');
        $stato->description = $request->input('description');

        $res = $stato->save();
        if ($res) session()->flash('messaggio','Salvato!');
//        return view('gestione.stati.editstato', ['stato'=>$stato]);
        return redirect(route('editstato', ['id'=>$stato['id']]));
    }

    public function destroy($id)
    {
        $stati = UserStatus::find($id);
        $res = $stati->forceDelete();
        return $res;
    }
}
