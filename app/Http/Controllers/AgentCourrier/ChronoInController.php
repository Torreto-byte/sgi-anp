<?php

namespace App\Http\Controllers\AgentCourrier;

use App\Models\ChronoIn;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ChronoInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DB::table('chrono_ins')->where('statut', 1)->orderByDesc('id')->get();

        return view('service-courrier.chrono.chrono', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service-courrier.chrono.addForm');
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
            'numero' => 'required',
            'debut' => 'required'
        ]);

        if ($validate->fails()) {
            notify()->error('Tous les champs sont obligatoire');
            return back()->withErrors($validate)->withInput();
        }

        if (ChronoIn::where('numero', $request->numero.'-'.date('Y'))->exists()) {
            notify()->error('Ce numéro de chrono existe déjà !');
            return back()->withErrors($validate)->withInput();
        }

        $newData = new ChronoIn();

        $newData->numero        = $request->numero.'-'.date('Y');
        $newData->num_debut     = $request->debut;

        if ($newData->save()) {

            /********* Historique utilisateur *********/
            UserHistory::create([
                'names' => Session::get('names'),
                'operations' => 'Création du chrono N° ==> '.$request->numero.'-'.date('Y'),
                'user_id' => Session::get('user_id'),
            ]);

            notify()->success('Enregistrement effectué avec succès !');
            return redirect()->route('chrono-arrive.index');
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
        $singleData = ChronoIn::findOrFail($id);

        return view('service-courrier.chrono.editForm', compact('singleData'));
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
            'numero' => 'required',
            'fin' => 'required'
        ]);

        if ($validate->fails()) {
            notify()->error('Tous les champs sont obligatoire');
            return back()->withErrors($validate)->withInput();
        }

        $singleData = ChronoIn::findOrFail($id);

        $singleData->num_fin    = $request->fin;
        $singleData->statut     = 0;

        if ($singleData->save()) {

            /********* Historique utilisateur *********/
            UserHistory::create([
                'names' => Session::get('names'),
                'operations' => 'Fermeture du chrono N° ==> '.$request->numero.'-'.date('Y'),
                'user_id' => Session::get('user_id'),
            ]);

            notify()->success('Chrono fermé avec succès !');
            return redirect()->route('chrono-arrive.index');
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
        ChronoIn::destroy($id);

        UserHistory::create([
            'names' => Session::get('names'),
            'operations' => 'Suppression du chrono N° ==> '.$id,
            'user_id' => Session::get('user_id'),
        ]);

        notify()->success('Suppression effectuée avec succès !');
        return redirect()->route('chrono-arrive.index');
    }
}