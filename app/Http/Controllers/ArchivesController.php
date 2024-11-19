<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArchivesController extends Controller
{

    public function arrives()
    {

        $items  = DB::table('imputations')
            ->join('letters_ins', 'letters_ins.id', '=', 'imputations.letter_id')
            ->join('chrono_ins', 'chrono_ins.id', '=', 'letters_ins.chrono_id')
            ->leftJoin('directions', 'directions.id', '=', 'imputations.direction_id')
            ->select('letters_ins.*', 'chrono_ins.numero', 'directions.sigle')
            ->whereNotNull('code_instruction')
            ->get();

        return view('archives.listingArrive', compact('items'));
    }


    public function arrivesDetails($id)
    {

        $item = DB::table('letters_ins')
            ->join('chrono_ins', 'chrono_ins.id', '=', 'letters_ins.chrono_id')
            ->join('users', 'users.id', '=', 'letters_ins.user_id')
            ->select('letters_ins.*', 'chrono_ins.numero', 'users.full_name')
            ->where('letters_ins.id', $id)
            ->whereNotNull('code_instruction')
            ->first();

        $itemImput = DB::table('imputations')
                ->join('letters_ins', 'letters_ins.id', '=', 'imputations.letter_id')
                ->join('directions', 'directions.id', '=', 'imputations.direction_id')
                ->select('imputations.name_agent', 'imputations.date_reception', 'directions.sigle')
                ->where('letter_id', $id)
                ->first();

        return view('archives.showArriveForm', compact('item', 'itemImput'));
    }


    public function departs()
    {

        $items = DB::table('letters_outs')
                ->join('chrono_outs', 'chrono_outs.id', '=', 'letters_outs.chrono_id')
                ->select('letters_outs.*', 'chrono_outs.numero')
                ->whereNull('delete_at')
                ->get();

        return view('archives.listingDepart', compact('items'));
    }


    public function departsDetails($id)
    {

        $item = DB::table('letters_outs')
                ->join('chrono_outs', 'chrono_outs.id', '=', 'letters_outs.chrono_id')
                ->join('users', 'users.id', '=', 'letters_outs.user_id')
                ->select('letters_outs.*', 'chrono_outs.numero', 'users.full_name')
                ->where('letters_outs.id', $id)
                ->first();

        return view('archives.showDepartForm', compact('item'));
    }


    public function publicArrives()
    {

        $items  = DB::table('imputations')
            ->join('letters_ins', 'letters_ins.id', '=', 'imputations.letter_id')
            ->join('chrono_ins', 'chrono_ins.id', '=', 'letters_ins.chrono_id')
            ->leftJoin('directions', 'directions.id', '=', 'imputations.direction_id')
            ->select('letters_ins.*', 'chrono_ins.numero', 'directions.sigle')
            ->whereNotNull('code_instruction')
            ->get();

        return view('archives.public.listingArrive', compact('items'));
    }


    public function publicArrivesDetails($id)
    {

        $item = DB::table('letters_ins')
            ->join('chrono_ins', 'chrono_ins.id', '=', 'letters_ins.chrono_id')
            ->join('users', 'users.id', '=', 'letters_ins.user_id')
            ->select('letters_ins.*', 'chrono_ins.numero', 'users.full_name')
            ->where('letters_ins.id', $id)
            ->whereNotNull('code_instruction')
            ->first();

        $itemImput = DB::table('imputations')
                ->join('letters_ins', 'letters_ins.id', '=', 'imputations.letter_id')
                ->join('directions', 'directions.id', '=', 'imputations.direction_id')
                ->select('imputations.name_agent', 'imputations.date_reception', 'directions.sigle')
                ->where('letter_id', $id)
                ->first();

        return view('archives.public.showArriveForm', compact('item', 'itemImput'));
    }


    public function publicDeparts()
    {

        $items = DB::table('letters_outs')
                ->join('chrono_outs', 'chrono_outs.id', '=', 'letters_outs.chrono_id')
                ->select('letters_outs.*', 'chrono_outs.numero')
                ->whereNull('delete_at')
                ->get();

        return view('archives.public.listingDepart', compact('items'));
    }


    public function publicDepartsDetails($id)
    {

        $item = DB::table('letters_outs')
                ->join('chrono_outs', 'chrono_outs.id', '=', 'letters_outs.chrono_id')
                ->join('users', 'users.id', '=', 'letters_outs.user_id')
                ->select('letters_outs.*', 'chrono_outs.numero', 'users.full_name')
                ->where('letters_outs.id', $id)
                ->first();

        return view('archives.public.showDepartForm', compact('item'));
    }
}
