<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChronoOut;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ChronoOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DB::table('chrono_outs')->orderByDesc('id')->get();

        return view('courrier-depart.chrono.chrono', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courrier-depart.chrono.addForm');
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

        $newData = new ChronoOut();

        $newData->numero        = $request->numero.'-'.date('Y');
        $newData->num_debut     = $request->debut;

        if ($newData->save()) {

            UserHistory::create([
                'names' => Session::get('names'),
                'operations' => 'Création du chrono départ N° ==> '.$request->numero.'-'.date('Y'),
                'user_id' => Session::get('user_id'),
            ]);

            notify()->success('Enregistrement effectué avec succès !');
            return redirect()->route('chrono-depart.index');
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
        $singleData = ChronoOut::findOrFail($id);

        return view('courrier-depart.chrono.editForm', compact('singleData'));
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

        $singleData = ChronoOut::findOrFail($id);

        $singleData->num_fin    = $request->fin;
        $singleData->statut     = 0;

        if ($singleData->save()) {

            UserHistory::create([
                'names' => Session::get('names'),
                'operations' => 'Fermeture du chrono départ N° ==> '.$request->numero.'-'.date('Y'),
                'user_id' => Session::get('user_id'),
            ]);

            notify()->success('Modification effectuée avec succès !');
            return redirect()->route('chrono-depart.index');
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
        ChronoOut::destroy($id);

        UserHistory::create([
            'names' => Session::get('names'),
            'operations' => 'Suppression du chrono arrivé ID° ==> '.$id,
            'user_id' => Session::get('user_id'),
        ]);

        notify()->success('Suppression effectuée avec succès !');
        return redirect()->route('chrono-depart.index');
    }
}
