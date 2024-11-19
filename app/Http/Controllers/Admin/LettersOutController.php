<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\ChronoOut;
use App\Models\LettersOut;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LettersOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DB::table('letters_outs')
                ->join('chrono_outs', 'chrono_outs.id', '=', 'letters_outs.chrono_id')
                ->select('letters_outs.*', 'chrono_outs.numero')
                ->whereNull('delete_at')
                ->get();

        return view('courrier-depart.courrier.listing', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getDataChrono = DB::table('chrono_outs')
                            ->where('statut', 1)
                            ->get();

        return view('courrier-depart.courrier.addForm', compact('getDataChrono'));
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
            'numero'            => 'required',
            'date'              => 'required',
            'destinataire'      => 'required',
            'objet'             => 'required',
            'chrono'            => 'required',
            'fichier'           => 'required|mimes:pdf|max:2048',
        ]);

        if ($validate->fails()) {
            notify()->error('Tous les champs sont obligatoire');
            return back()->withErrors($validate)->withInput();
        }

        // récupérer le numéro du chrono
        $numeroChrono = ChronoOut::where('id', $request->chrono)->get();

        $folderPath = "courriers-depart/".$numeroChrono[0]->numero;

        // Vérifier si le dossier existe, sinon le créer
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        $file = $request->file('fichier');

        $fileName = $request->objet.'-'.$request->destinataire.'_du_'.$request->date.'.'.$file->extension();

        $newData = new LettersOut();

        $newData->files                     = $file->storeAs($folderPath, $fileName, 'public');
        $newData->date_send                 = $request->date;
        $newData->date_number_correspond    = $request->date_correspond;
        $newData->sender                    = $request->destinataire;
        $newData->object                    = $request->objet;
        $newData->number                    = $request->numero;
        $newData->observation               = $request->observation;
        $newData->status                    = $request->statut;
        $newData->chrono_id                 = $request->chrono;
        $newData->user_id                   = Auth::user()->id;

        if ($newData->save()) {

            /********* Historique utilisateur *********/
            UserHistory::create([
                'names' => Session::get('names'),
                'operations' => 'Enregistrement courrier départ N° ==> '.$request->numero,
                'user_id' => Session::get('user_id'),
            ]);

            notify()->success('Enregistrement effectué avec succès !');
            return redirect()->route('courriers-departs.index');
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

        $item = DB::table('letters_outs')
                ->join('chrono_outs', 'chrono_outs.id', '=', 'letters_outs.chrono_id')
                ->join('users', 'users.id', '=', 'letters_outs.user_id')
                ->select('letters_outs.*', 'chrono_outs.numero', 'users.full_name')
                ->where('letters_outs.id', $id)
                ->first();

        return view('courrier-depart.courrier.showForm', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $singleData = DB::table('letters_outs')
        ->join('chrono_outs', 'chrono_outs.id', '=', 'letters_outs.chrono_id')
        ->select('letters_outs.*', 'chrono_outs.numero')
        ->where('letters_outs.id', $id)
        ->first();

        $getDataChrono = DB::table('chrono_outs')
        ->where('statut', 1)
        ->get();

        return view('courrier-depart.courrier.editForm', compact('singleData', 'getDataChrono'));
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
            'numero'          => 'required',
            'date'            => 'required',
            'destinataire'    => 'required',
            'objet'           => 'required',
            'chrono'          => 'required',
        ]);

        if ($validate->fails()) {
            notify()->error('Tous les champs sont obligatoire');
            return back()->withErrors($validate)->withInput();
        }

        if (empty($request->file('fichier'))) {

            $singleData = LettersOut::findOrFail($id);

            $singleData->date_send                  = $request->date;
            $singleData->date_number_correspond     = $request->date_correspond;
            $singleData->sender                     = $request->destinataire;
            $singleData->object                     = $request->objet;
            $singleData->observation                = $request->observation;
            $singleData->date_reception             = $request->date_recep;
            $singleData->number                     = $request->numero;
            $singleData->chrono_id                  = $request->chrono;

        } else {

            $singleData = LettersOut::findOrFail($id);

            // récupérer le numéro du chrono
            $numeroChrono = ChronoOut::where('id', $request->chrono)->get();

            $folderPath = "courriers-depart/".$numeroChrono[0]->numero;

            // Vérifier si le dossier existe, sinon le créer
            if (!Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->makeDirectory($folderPath);
            }

            if ($singleData->files && Storage::disk('public')->exists($singleData->files)) {
                Storage::disk('public')->delete($singleData->files);
            }

            $file = $request->file('fichier');

            $fileName = $request->objet.'-'.$request->destinataire.'_du_'.$request->date.'.'.$file->extension();

            $singleData->files                      = $file->storeAs($folderPath, $fileName, 'public');
            $singleData->date_send                  = $request->date;
            $singleData->date_number_correspond     = $request->date_correspond;
            $singleData->sender                     = $request->destinataire;
            $singleData->object                     = $request->objet;
            $singleData->observation                = $request->observation;
            $singleData->date_reception             = $request->date_recep;
            $singleData->number                     = $request->numero;
            $singleData->chrono_id                  = $request->chrono;

        }

        $singleData->save();

        /********* Historique utilisateur *********/
        UserHistory::create([
            'names' => Session::get('names'),
            'operations' => 'Modification courrier départ N° ==> '.$request->numero,
            'user_id' => Session::get('user_id'),
        ]);

        notify()->success('Modification effectué avec succès !');
        return redirect()->route('courriers-departs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedFile = LettersOut::findOrFail($id);

        //Storage::disk('public')->delete($deletedFile->files);

        DB::table('letters_outs')
            ->where('id', $id)
            ->update(['delete_at' => Carbon::now()]);

        /********* Historique utilisateur *********/
        UserHistory::create([
            'names' => Session::get('names'),
            'operations' => 'Suppression courrier départ N° ==> '.$deletedFile->number,
            'user_id' => Session::get('user_id'),
        ]);

        //$deletedFile->delete();

        notify()->success('Suppression effectuée avec succès !');
        return redirect()->route('courriers-departs.index');
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
            DB::table('letters_outs')
            ->where('id', $id)
            ->update([
                'etat' => 'close'
            ]);

            $getData = DB::table('letters_outs')->where('id', $id)->get();

            /********* Historique utilisateur *********/
            UserHistory::create([
                'names' => Session::get('names'),
                'operations' => 'Classification courrier départ ID ==> '.$getData[0]->number,
                'user_id' => Session::get('user_id'),
            ]);
        }

        notify()->success('Décharge éffectuée avec succès !');
        return redirect()->route('courriers-departs.index');
    }
}
