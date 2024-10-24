<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TypeInstruction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TypeInstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = TypeInstruction::all();

        return view('courrier-arrive.instruction.listing', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courrier-arrive.instruction.addForm');
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
            'code' => 'required',
            'libelle' => 'required',
        ]);

        if ($validate->fails()) {
            notify()->error('Tous les champs sont obligatoire');
            return back()->withErrors($validate)->withInput();
        }

        $newData = new TypeInstruction();

        $newData->code        = $request->code;
        $newData->name     = $request->libelle;

        if ($newData->save()) {

            /********* Historique utilisateur *********/
            // History::create([
            //     'names' => Session::get('names'),
            //     'operations' => 'Enregistrement Production ==> '.$request->libele,
            //     'users_id' => Session::get('users_id'),
            // ]);

            notify()->success('Enregistrement effectué avec succès !');
            return redirect()->route('type-instruction.index');
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
        $singleData = TypeInstruction::findOrFail($id);

        return view('courrier-arrive.instruction.editForm', compact('singleData'));
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
            'libelle' => 'required'
        ]);

        if ($validate->fails()) {
            notify()->error('Tous les champs sont obligatoire');
            return back()->withErrors($validate)->withInput();
        }

        $singleData = TypeInstruction::findOrFail($id);

        $singleData->name        = $request->libelle;

        if ($singleData->save()) {

            /********* Historique utilisateur *********/
            // History::create([
            //     'names' => Session::get('names'),
            //     'operations' => 'Enregistrement Production ==> '.$request->libele,
            //     'users_id' => Session::get('users_id'),
            // ]);

            notify()->success('Modification effectuée avec succès !');
            return redirect()->route('type-instruction.index');
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
        TypeInstruction::destroy($id);

        notify()->success('Suppression effectuée avec succès !');
        return redirect()->route('type-instruction.index');
    }
}
