<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChronoIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        $items = DB::table('chrono_ins')->orderByDesc('id')->get();

        return view('courrier-arrive.chrono.chrono', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courrier-arrive.chrono.addForm');
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

        $newData = new ChronoIn();

        $newData->numero        = $request->numero;
        $newData->num_debut     = $request->debut;
        $newData->num_fin       = $request->fin;

        if ($newData->save()) {

            /********* Historique utilisateur *********/
            // History::create([
            //     'names' => Session::get('names'),
            //     'operations' => 'Enregistrement Production ==> '.$request->libele,
            //     'users_id' => Session::get('users_id'),
            // ]);

            notify()->success('Enregistrement effectué avec succès !');
            return redirect()->route('chrono-arrive.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        return view('courrier-arrive.chrono.editForm', compact('singleData'));
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
            // History::create([
            //     'names' => Session::get('names'),
            //     'operations' => 'Enregistrement Production ==> '.$request->libele,
            //     'users_id' => Session::get('users_id'),
            // ]);

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

        notify()->success('Suppression effectuée avec succès !');
        return redirect()->route('chrono-arrive.index');
    }
}
