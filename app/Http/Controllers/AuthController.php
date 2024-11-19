<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }


    public function authenticate(Request $request)
    {
        $validate =  Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);


        if ($validate->fails()) {
            notify()->error('Tous les champs sont obligatoire');
            return back();
        }

        $credentials = $request->only('username', 'password');
        $userNotFound = Auth::attempt($credentials);

        if (!$userNotFound) {

            notify()->warning("Nom utilisateur ou mot de Passe incorrect !!!");
            return back();

        }else {

            $userExist = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.name')
            ->where('users.username', $request->username)
            ->first();

            if($userExist->statut == 0) {
                notify()->warning("Vos accès ont été bloqués, veuillez contacter l'administrateur svp !");
                return back();

            }else{

                $request->session()->regenerate();

                session([
                    'role' => $userExist->name,
                    'names' => $userExist->full_name,
                    'last_login_at' => $userExist->last_login_at,
                    'role_id' => $userExist->role_id,
                    'user_id' => $userExist->id,
                    'agent_absent' => $userExist->letter_option
                ]);

                //Fetch user #Id
                $user = User::findOrFail($userExist->id);

                $user->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'last_login_ip' => $request->getClientIp()
                ]);

                /********* Historique utilisateur *********/
                UserHistory::create([
                    'names' => $userExist->full_name,
                    'operations' => 'Connexion utilisateur',
                    'user_id' => $userExist->id,
                ]);

                switch ($userExist->role_id) {
                    case 2:
                    case 3:
                        smilify("success", "Bienvenue ".$userExist->full_name.", votre session est ouverte !!!");
                        return redirect()->route('courrierHomePage');

                        break;

                    case 4:
                        smilify("success", "Bienvenue ".$userExist->full_name.", votre session est ouverte !!!");
                        return redirect()->route('courrierHomePage');

                        break;

                    default:
                        smilify("success", "Bienvenue ".$userExist->full_name.", votre session est ouverte !!!");
                        return redirect()->route('adminHomePage');

                        break;
                }
            }

        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        /********* Historique utilisateur *********/
        UserHistory::create([
            'names' => Session::get('names'),
            'operations' => 'Déconnexion utilisateur',
            'user_id' => Session::get('user_id'),
        ]);

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
