<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    protected function pass($length)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@$-&";
        return substr(str_shuffle(str_repeat($chars, $length)),0,$length);
    }


    public function index()
    {

        $items = DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->select('users.*', 'roles.name')
                ->get();

        //dd($items);

        return view('user.listing', compact('items'));
    }


    public function create()
    {
        $getDataRole = Role::all();

        return view('user.addForm', compact('getDataRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate =  Validator::make($request->all(), [
            'noms'      => 'required',
            'username'     => 'required',
            'role'      => 'required',
        ]);

        //dd($request);

        if ($validate->fails()) {
            notify()->error('Tous les champs sont obligatoire');
            return back()->withErrors($validate)->withInput();
        }

        $userPassword = $this->pass(15);

        $userName = $request->username;

        $newData = new User();

        $newData->full_name = $request->noms;
        $newData->username = $userName;
        $newData->password = Hash::make($userPassword);
        $newData->role_id = $request->role;


        if ($newData->save()) {

            /********* Historique utilisateur *********/
            UserHistory::create([
                'names' => Session::get('names'),
                'operations' => 'Enregistrement Utilisateur ==> '.$request->noms,
                'user_id' => Session::get('user_id'),
            ]);

            notify()->success('Enregistrement effectué avec succès !');
            return redirect()->route('utilisateurs.index')->with(['username' => $userName, 'userpassword'=> $userPassword ]);
            //view('user.listing', compact('userPassword', 'userName', 'items'));
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $singleData = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->select('users.*', 'roles.name')
        ->where('users.id', $id)
        ->first();

        $getDataRole = Role::all();

        return view('user.editForm', compact('singleData', 'getDataRole'));
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
        $validate =  Validator::make($request->all(), [
            'noms' => 'required',
            'username' => 'required',
            'role' => 'required'
        ]);

        if ($validate->fails()) {
            notify()->error('Tous les champs sont obligatoire');
            return back();
        }


        $singleDataUpdate = User::findOrFail($id);

        $singleDataUpdate->full_name = $request->noms;
        $singleDataUpdate->username = $request->username;
        $singleDataUpdate->role_id = $request->role;

        if ($singleDataUpdate->save()) {

            /********* Historique utilisateur *********/
            UserHistory::create([
                'names' => Session::get('names'),
                'operations' => 'Modification Utilisateur ==> '.$request->noms,
                'user_id' => Session::get('user_id'),
            ]);

            notify()->success('Modification effectuée avec succès !');
            return redirect()->route('utilisateurs.index');
        }
    }


    public function status($id)
    {
        $status_user = DB::table('users')
        ->where('id', $id)
        ->value('statut');

        //dd($status_user);

        if($status_user == 1){
            DB::table('users')
                ->where('id', $id)
                ->update(['statut'=> 0]);

            /********* Historique utilisateur *********/
            UserHistory::create([
                'names' => Session::get('names'),
                'operations' => 'Désactivation de compte utilisateur #ID ==> '.$id,
                'user_id' => Session::get('user_id'),
            ]);

            notify()->error('Utilisateur bloqué avec succès !');
            return redirect()->route('utilisateurs.index');

        }else{
            DB::table('users')
                ->where('id', $id)
                ->update(['statut'=> 1]);

            /********* Historique utilisateur *********/
            UserHistory::create([
                'names' => Session::get('names'),
                'operations' => 'Activation de compte utilisateur #ID ==> '.$id,
                'user_id' => Session::get('user_id'),
            ]);

            notify()->info('Utilisateur débloqué avec succès !');
            return redirect()->route('utilisateurs.index');
        }

    }


    public function resetpassword($id)
    {
        $userName = DB::table('users')
        ->where('id', $id)
        ->value('username');

        $userPassword = $this->pass(15);

        $new_save_password = DB::table('users')
                ->where('id', $id)
                ->update(['password'=> Hash::make($userPassword)]);


        if ($new_save_password) {

            /********* Historique utilisateur *********/
            UserHistory::create([
                'names' => Session::get('names'),
                'operations' => 'Réinitialisation mot de passe utilisateur #ID ==> '.$id,
                'user_id' => Session::get('user_id'),
            ]);

            notify()->success('Réinitialisation du mot de passe éffectuée avec succès !');
            return redirect()->route('utilisateurs.index')->with(['username' => $userName, 'userpassword'=> $userPassword ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = DB::table('users')->select('full_name')->where('id', $id)->first();
        /********* Historique utilisateur *********/
        UserHistory::create([
            'names' => Session::get('names'),
            'operations' => 'Suppression compte utilisateur ==> '.$deleted->full_name,
            'user_id' => Session::get('user_id'),
        ]);

        User::destroy($id);

        notify()->success('Suppression effectuée avec succès !');
        return redirect()->route('utilisateurs.index');
    }
}
