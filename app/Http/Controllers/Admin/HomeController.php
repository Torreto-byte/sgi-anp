<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $nbreUser = DB::table('users')->get();

        $nbrLetterIns = DB::table('letters_ins')->whereNull('delete_at')->get();

        $nbrLetterNotImput = DB::table('letters_ins')->whereNull('code_instruction')->get();

        $nbrLetterNotRep = DB::table('letters_ins')->where('code_instruction', 'repondre')->whereNull('etat')->get();

        $items  = DB::table('imputations')
                ->join('letters_ins', 'letters_ins.id', '=', 'imputations.letter_id')
                ->join('chrono_ins', 'chrono_ins.id', '=', 'letters_ins.chrono_id')
                ->leftJoin('directions', 'directions.id', '=', 'imputations.direction_id')
                ->select('letters_ins.*', 'chrono_ins.numero', 'directions.sigle')
                ->whereNull('delete_at')
                ->whereNull('code_instruction')
                ->orderByDesc('created_at')
                ->get();


        return view('home.home', compact('items', 'nbreUser', 'nbrLetterIns', 'nbrLetterNotImput', 'nbrLetterNotRep'));
    }
}
