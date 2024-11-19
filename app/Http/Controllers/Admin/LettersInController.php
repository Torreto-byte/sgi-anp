<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChronoIn;
use App\Models\LettersIn;
use App\Models\Imputation;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LettersInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $items  = DB::table('imputations')
                    ->join('letters_ins', 'letters_ins.id', '=', 'imputations.letter_id')
                    ->join('chrono_ins', 'chrono_ins.id', '=', 'letters_ins.chrono_id')
                    ->leftJoin('directions', 'directions.id', '=', 'imputations.direction_id')
                    ->select('letters_ins.*', 'chrono_ins.numero', 'directions.sigle')
                    ->whereNull('delete_at')
                    ->get();

        return view('courrier-arrive.courrier.listing', compact('items'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $getDataChrono = DB::table('chrono_ins')
                            ->where('statut', 1)
                            ->get();

        return view('courrier-arrive.courrier.addForm', compact('getDataChrono'));
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
            'numero'        => 'required',
            'date'          => 'required',
            'expediteur'    => 'required',
            'objet'         => 'required',
            'chrono'        => 'required',
            'fichier'       => 'required|mimes:pdf|max:2048',
        ]);

        if ($validate->fails()) {
            notify()->error('Tous les champs sont obligatoire');
            return back()->withErrors($validate)->withInput();
        }

        // récupérer le numéro du chrono
        $numeroChrono = ChronoIn::where('id', $request->chrono)->get();

        $file = $request->file('fichier');

        $folderPath = "courriers-arrive/".$numeroChrono[0]->numero;

        // Vérifier si le dossier existe, sinon le créer
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        $fileName = $request->objet.'-'.$request->expediteur.'_du_'.$request->date.'.'.$file->extension();

        $newData = new LettersIn();

        $newData->files                     = $file->storeAs($folderPath, $fileName, 'public');
        $newData->attachment                = $request->pj;
        $newData->date_add                  = $request->date;
        $newData->date_number_correspond    = $request->date_correspond;
        $newData->expeditor                 = $request->expediteur;
        $newData->object                    = $request->objet;
        $newData->number                    = $request->numero;
        $newData->status                    = $request->statut;
        $newData->chrono_id                 = $request->chrono;
        $newData->user_id                   = Auth::user()->id;

        if ($newData->save()) {

            Imputation::create([
                'letter_id' => $newData->id
            ]);

            /********* Historique utilisateur *********/
            UserHistory::create([
                'names' => Session::get('names'),
                'operations' => 'Enregistrement courrier arrivé N° ==> '.$request->numero,
                'user_id' => Session::get('user_id'),
            ]);

            notify()->success('Enregistrement effectué avec succès !');
            return redirect()->route('courriers-arrives.index');
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
        $item = DB::table('letters_ins')
                ->join('chrono_ins', 'chrono_ins.id', '=', 'letters_ins.chrono_id')
                ->join('users', 'users.id', '=', 'letters_ins.user_id')
                ->select('letters_ins.*', 'chrono_ins.numero', 'users.full_name')
                ->where('letters_ins.id', $id)
                ->first();

        $itemImput = DB::table('imputations')
                    ->join('letters_ins', 'letters_ins.id', '=', 'imputations.letter_id')
                    ->join('directions', 'directions.id', '=', 'imputations.direction_id')
                    ->select('imputations.name_agent', 'imputations.date_reception', 'directions.sigle')
                    ->where('letter_id', $id)
                    ->first();

        return view('courrier-arrive.courrier.showForm', compact('item', 'itemImput'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $singleData = DB::table('letters_ins')
                ->join('chrono_ins', 'chrono_ins.id', '=', 'letters_ins.chrono_id')
                ->select('letters_ins.*', 'chrono_ins.numero')
                ->where('letters_ins.id', $id)
                ->first();

        $getDataChrono = DB::table('chrono_ins')
                ->where('statut', 1)
                ->get();

        return view('courrier-arrive.courrier.editForm', compact('singleData', 'getDataChrono'));
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
            'numero'        => 'required',
            'date'          => 'required',
            'expediteur'    => 'required',
            'objet'         => 'required',
            'chrono'        => 'required',
            //'fichier'       => 'required|mimes:pdf|max:2048',
        ]);

        if ($validate->fails()) {
            notify()->error('Tous les champs sont obligatoire');
            return back()->withErrors($validate)->withInput();
        }

        if (empty($request->file('fichier'))) {

            $singleData = LettersIn::findOrFail($id);

            $singleData->date_add                  = $request->date;
            $singleData->date_number_correspond    = $request->date_correspond;
            $singleData->expeditor                 = $request->expediteur;
            $singleData->object                    = $request->objet;
            $singleData->number                    = $request->numero;
            //$singleData->status                    = $request->statut;
            $singleData->chrono_id                 = $request->chrono;

        } else {

            $singleData = LettersIn::findOrFail($id);

            // récupérer le numéro du chrono
            $numeroChrono = ChronoIn::where('id', $request->chrono)->get();

            $folderPath = "courriers-arrive/".$numeroChrono[0]->numero;

            // Vérifier si le dossier existe, sinon le créer
            if (!Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->makeDirectory($folderPath);
            }

            if ($singleData->files && Storage::disk('public')->exists($singleData->files)) {
                Storage::disk('public')->delete($singleData->files);
            }

            $file = $request->file('fichier');

            $fileName = $request->objet.'-'.$request->expediteur.'_du_'.$request->date.'.'.$file->extension();

            $singleData->files                     = $file->storeAs($folderPath, $fileName, 'public');
            $singleData->date_add                  = $request->date;
            $singleData->date_number_correspond    = $request->date_correspond;
            $singleData->expeditor                 = $request->expediteur;
            $singleData->object                    = $request->objet;
            $singleData->number                    = $request->numero;
            //$singleData->status                    = $request->statut;
            $singleData->chrono_id                 = $request->chrono;

        }

        $singleData->save();

        /********* Historique utilisateur *********/
        UserHistory::create([
            'names' => Session::get('names'),
            'operations' => 'Modification courrier arrivé N° ==> '.$request->numero,
            'user_id' => Session::get('user_id'),
        ]);

        notify()->success('Modification effectuée avec succès !');
        return redirect()->route('courriers-arrives.index');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        // $deletedFile = LettersIn::findOrFail($id);

        // Storage::disk('public')->delete($deletedFile->files);

        // DB::table('imputations')->where('letter_id', $id)->delete();

        DB::table('letters_ins')
            ->where('id', $id)
            ->update(['delete_at' => Carbon::now()]);

        /********* Historique utilisateur *********/
        UserHistory::create([
            'names' => Session::get('names'),
            'operations' => 'Mise en corbeille courrier arrivé N° ==> '.$id,
            'user_id' => Session::get('user_id'),
        ]);

        //$deletedFile->delete();

        notify()->success('Suppression effectuée avec succès !');
        return redirect()->route('courriers-arrives.index');
    }


    /**
     *
     * Imputation for letters
     *
    */
    public function imputation($id)
    {

        $singleData = DB::table('letters_ins')
                ->join('chrono_ins', 'chrono_ins.id', '=', 'letters_ins.chrono_id')
                ->select('letters_ins.*', 'chrono_ins.numero')
                ->where('letters_ins.id', $id)
                ->first();

        $getDataInstruction = DB::table('type_instructions')->get();

        $getDataDirection = DB::table('directions')->get();

        return view('courrier-arrive.courrier.imputForm', compact('singleData', 'getDataInstruction', 'getDataDirection'));
    }


    /**
     *
     * Save imputation for letters
     *
    */
    public function saveImputation(Request $request)
    {

        $validate =  Validator::make($request->all(), [
            'direction'     => 'required',
            'instruction'   => 'required'
        ]);

        if ($validate->fails()){
            notify()->error('Tous les champs sont obligatoire');
            return back()->withErrors($validate)->withInput();
        }

        $getData = DB::table('letters_ins')->where('id', $request->courrierID)->get();

        DB::table('imputations')
        ->where('letter_id', $request->courrierID)
        ->update([
            'direction_id' => $request->direction
        ]);

        DB::table('letters_ins')
            ->where('id', $request->courrierID)
            ->update(['code_instruction' => $request->instruction]);

        /********* Historique utilisateur *********/
        UserHistory::create([
            'names' => Session::get('names'),
            'operations' => 'Imputation courrier arrivé ID ==> '.$getData[0]->number,
            'user_id' => Session::get('user_id'),
        ]);

        notify()->success('Imputation effectuée avec succès !');
        return redirect()->route('courriers-arrives.index');

    }


    /**
     *
     * Edit imputation for letters
     *
    **/
    public function editImputation(Request $request, $id)
    {

        $singleData = DB::table('letters_ins')
                ->join('chrono_ins', 'chrono_ins.id', '=', 'letters_ins.chrono_id')
                ->join('type_instructions', 'type_instructions.code', '=', 'letters_ins.code_instruction')
                ->select('letters_ins.*', 'chrono_ins.numero', 'type_instructions.name')
                ->where('letters_ins.id', $id)
                ->first();


        $getDataInstruction = DB::table('type_instructions')->get();

        $getDataDirection = DB::table('directions')->get();

        $getDataImputation = DB::table('imputations')
                            ->join('letters_ins', 'letters_ins.id', '=', 'imputations.letter_id')
                            ->select('direction_id')
                            ->where('letter_id', $id)
                            ->get();


        foreach ($getDataImputation->toArray() as $row) {
            $dataItems[] = $row->direction_id;
        }

        return view('courrier-arrive.courrier.editImputForm', compact('singleData', 'getDataInstruction', 'getDataDirection', 'dataItems'));

    }


    /**
     *
     * Update imputation for letters
     *
    **/
    public function updateImputation(Request $request, $id)
    {

        $validate =  Validator::make($request->all(), [
            'direction'     => 'required',
            'instruction'   => 'required'
        ]);

        $getData = DB::table('letters_ins')->where('id', $id)->get();

        if ($validate->fails()){
            notify()->error('Tous les champs sont obligatoire');
            return back()->withErrors($validate)->withInput();
        }

        DB::table('imputations')
            ->where('letter_id', $id)
            ->update(['direction_id' => $request->direction]);

        DB::table('letters_ins')
            ->where('id', $id)
            ->update(['code_instruction' => $request->instruction]);

        /********* Historique utilisateur *********/
        UserHistory::create([
            'names' => Session::get('names'),
            'operations' => 'Modification imputation courrier arrivé ID ==> '.$getData[0]->number,
            'user_id' => Session::get('user_id'),
        ]);

        notify()->success('Imputation modifié avec succès !');
        return redirect()->route('courriers-arrives.index');
    }


    /**
     *
     * Decharge imputation for letters
     *
    */
    public function editDechargeImputation(Request $request, $id)
    {

        $singleData = DB::table('letters_ins')
                ->join('chrono_ins', 'chrono_ins.id', '=', 'letters_ins.chrono_id')
                ->join('type_instructions', 'type_instructions.code', '=', 'letters_ins.code_instruction')
                ->select('letters_ins.*', 'chrono_ins.numero', 'type_instructions.name')
                ->where('letters_ins.id', $id)
                ->first();


        return view('courrier-arrive.courrier.dechargImputForm', compact('singleData'));
    }


    /**
     *
     * Save decharge imputation
     *
     */
    public function saveDechargeImputation(Request $request, $id)
    {

        $validate =  Validator::make($request->all(), [
            'date_reception'     => 'required',
            'nom_agent'   => 'required'
        ]);

        if ($validate->fails()){
            notify()->error('Tous les champs sont obligatoire');
            return back()->withErrors($validate)->withInput();
        }

        $getData = DB::table('letters_ins')->where('id', $id)->get();

        DB::table('imputations')
            ->where('letter_id', $id)
            ->update([
                'date_reception' => $request->date_reception,
                'name_agent'     => $request->nom_agent
        ]);

        if($request->code == 'classer')
        {
            DB::table('letters_ins')
            ->where('id', $id)
            ->update([
                'etat' => 'close'
            ]);
        }

        /********* Historique utilisateur *********/
        UserHistory::create([
            'names' => Session::get('names'),
            'operations' => 'Décharge courrier arrivé ID ==> '.$getData[0]->number,
            'user_id' => Session::get('user_id'),
        ]);

        notify()->success('Décharge éffectuée avec succès !');
        return redirect()->route('courriers-arrives.index');
    }


    /***
     *
     * Classer courrier
     *
     */
    public function classerLetter($id)
    {
        if($id)
        {
            DB::table('letters_ins')
            ->where('id', $id)
            ->update([
                'code_instruction' => 'classer',
                'etat' => 'close'
            ]);

            $getData = DB::table('letters_ins')->where('id', $id)->get();

            /********* Historique utilisateur *********/
            UserHistory::create([
                'names' => Session::get('names'),
                'operations' => 'Classification courrier arrivé ID ==> '.$getData[0]->number,
                'user_id' => Session::get('user_id'),
            ]);
        }

        notify()->success('Décharge éffectuée avec succès !');
        return redirect()->route('courriers-arrives.index');
    }

}
