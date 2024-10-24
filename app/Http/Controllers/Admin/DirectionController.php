<?php

namespace App\Http\Controllers\Admin;

use App\Models\Direction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Direction::all();

        return view('direction.listing', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('direction.addForm');
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
            'nom' => 'required',
            'sigle' => 'required'
        ]);

        if ($validate->fails()) {
            notify()->error('Tous les champs sont obligatoire');
            return back()->withErrors($validate)->withInput();
        }

        $newData = new Direction();

        $newData->name = $request->nom;
        $newData->sigle = $request->sigle;

        if ($newData->save()) {

            /********* Historique utilisateur *********/
            // History::create([
            //     'names' => Session::get('names'),
            //     'operations' => 'Enregistrement Production ==> '.$request->libele,
            //     'users_id' => Session::get('users_id'),
            // ]);

            notify()->success('Enregistrement effectué avec succès !');
            return redirect()->route('direction.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function show(Direction $direction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $singleData = Direction::findOrFail($id);

        return view('direction.editForm', compact('singleData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate =  Validator::make($request->all(), [
            'nom' => 'required',
            'sigle' => 'required'
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $singleData = Direction::findOrFail($id);

        $singleData->name = $request->nom;
        $singleData->sigle = $request->sigle;

        if ($singleData->save()) {
            notify()->success('Modification effectuée avec succès !');
            return redirect()->route('direction.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Direction::destroy($id);

        notify()->success('Suppression effectuée avec succès !');
        return redirect()->route('direction.index');
    }
}
